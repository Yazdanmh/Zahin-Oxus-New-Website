<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\TrainingParticipants;
use Inertia\Inertia; 
use App\Mail\TrainingApplicationMail;
use Illuminate\Support\Facades\Mail;

class TrainingsController extends Controller
{
    public function index(){
        $trainings = Training::orderByDesc('created_at')
            ->paginate(4); // Call paginate only once
        return Inertia::render('Client/Trainings/Index', [
            'trainings' => $trainings,
        ]);
    }
    
    public function show($slug){
        $training = Training::where('slug', $slug)->firstOrFail();
        $trainings = Training::where('slug', '!=', $slug)
                            ->orderByDesc('created_at') 
                            ->paginate(10);
        return Inertia::render('Client/Trainings/Details', [
            'training' => $training,
            'trainings' => $trainings,
        ]);
    }
    public function apply($slug){
        $training = Training::where('slug', $slug)->firstOrFail();
        return Inertia::render('Client/Trainings/Apply', [
            'training' => $training,
        ]);
    }
  
    
    public function apply_store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:training_participants,email,NULL,id,training_id,' . $id,
            'organization' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'identity_card_id' => 'required|string|max:50|unique:training_participants,taskira_number,NULL,id,training_id,' . $id,
            'position' => 'required|string|max:255',
        ]);
    
        $validated = $request->all();

        $trainingName = $request->training_name ?? 'Unknown Training';
        // Create the participant entry
        TrainingParticipants::create([
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'organization' => $validated['organization'],
            'phone_number' => $validated['phone'],
            'address' => $validated['address'],
            'taskira_number' => $validated['identity_card_id'],
            'position' => $validated['position'],
            'training_id' => $id,
        ]);
    
        // Send the email to admin
        try {
            Mail::to('info@zahin-oxus.af')->send(new \App\Mail\TrainingApplicationMail(
                $validated['name'],
                $validated['email'],
                $validated['organization'],
                $validated['phone'],
                $validated['address'],
                $validated['identity_card_id'],
                $validated['position'],
                $trainingName // Pass the trainingName
            ));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'There was an issue sending the notification.');
        }
    
        return redirect()->back()->with('success', 'Your application has been submitted!');
    }
    

    
    
}

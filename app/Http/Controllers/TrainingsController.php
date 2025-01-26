<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\TrainingParticipants;
use Inertia\Inertia; 
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
        // return $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:training_participants,email,NULL,id,training_id,' . $id,
            'organization' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'address' => 'nullable|string|max:255',
            'identity_card_id' => 'required|string|max:50|unique:training_participants,taskira_number,NULL,id,training_id,' . $id,
            'position' => 'required|string|max:255',
        ]);
    
        TrainingParticipants::create([
            'full_name' => $request->input('name'),
            'email' => $request->input('email'),
            'organization' => $request->input('organization'),
            'phone_number' => $request->input('phone'),
            'address' => $request->input('address'),
            'taskira_number' => $request->input('identity_card_id'),
            'position' => $request->input('position'),
            'training_id' => $id,
        ]);
        return redirect()->back(); 
    }
    
}

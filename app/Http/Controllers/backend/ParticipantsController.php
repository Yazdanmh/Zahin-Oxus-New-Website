<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Training;
use App\Models\TrainingParticipants;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ParticipantsController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $selectedTraining = $request->input('training');
        
        $query = TrainingParticipants::with('training');

        if ($searchQuery) {
            $query->where('full_name', 'like', '%' . $searchQuery . '%');
        }

        if ($selectedTraining) {
            $query->where('training_id', $selectedTraining);
        }

        $participants = $query->orderBy('created_at', 'desc')->paginate(10);

        $trainings = Training::all();

        return Inertia::render('Admin/Participants/Index', [
            'participants' => $participants,
            'trainings' => $trainings
        ]);
    }
    public function create(){
        return Inertia::render('Admin/Participants/Create', [
            'trainings' => Training::all()
        ]);
    }
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:training_participants,email',
            'phone_number' => 'nullable|string|max:20',
            'taskira_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'training_id' => 'required|exists:trainings,id'
        ]);

        TrainingParticipants::create($validated);

        return redirect()->route('participants.index')->with('success', 'Participant added successfully!');
    }
    // Show the edit form
    public function edit($id)
    {
        // Fetch the participant data by ID
        $participant = TrainingParticipants::findOrFail($id);

        // Fetch trainings for the dropdown
        $trainings = Training::all();

        // Return the edit view with the participant and trainings data
        return inertia('Admin/Participants/Edit', [
            'participant' => $participant,
            'trainings' => $trainings,
        ]);
    }

    // Update the participant
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:15',
            'taskira_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'training_id' => 'required|exists:trainings,id',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Find the participant by ID and update the data
        $participant = TrainingParticipants::findOrFail($id);
        $participant->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'taskira_number' => $request->taskira_number,
            'address' => $request->address,
            'organization' => $request->organization,
            'position' => $request->position,
            'training_id' => $request->training_id,
        ]);

        // Redirect back to participants index with success message
        return redirect()->route('participants.index')->with('success', 'Participant updated successfully!');
    }

    public function destroy($id){
        $participant = TrainingParticipants::findOrFail($id); 
        $participant->delete(); 
        return redirect()->route('participants.index');
    }
    public function show($id)
    {
        // Fetch all participants with the specific training_id
        $participants = TrainingParticipants::where('training_id', $id)->get();

        return inertia('Admin/Participants/See', [
            'participants' => $participants,
        ]);
    }
    
}

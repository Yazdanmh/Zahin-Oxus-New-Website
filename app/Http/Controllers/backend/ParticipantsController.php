<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Training;
use App\Models\TrainingParticipants;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\Middleware;
class ParticipantsController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:training.view', only: ['index', 'show']),
            new Middleware('can:training.create', only: ['create', 'store']),
            new Middleware('can:training.edit', only: ['edit', 'update']),
            new Middleware('can:training.delete', only: ['destroy']),
        ];
    }

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

    public function create()
    {
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

    public function edit($id)
    {
        $participant = TrainingParticipants::findOrFail($id);
        $trainings = Training::all();

        return inertia('Admin/Participants/Edit', [
            'participant' => $participant,
            'trainings' => $trainings,
        ]);
    }

    public function update(Request $request, $id)
    {
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

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

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

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully!');
    }

    public function destroy($id)
    {
        $participant = TrainingParticipants::findOrFail($id);
        $participant->delete();
        return redirect()->route('participants.index');
    }

    public function show($id)
    {
        $participants = TrainingParticipants::where('training_id', $id)->get();

        return inertia('Admin/Participants/See', [
            'participants' => $participants,
        ]);
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training; 
use Inertia\Inertia; 
use Illuminate\Support\Facades\Redirect;
use Str; 
use Illuminate\Support\Facades\Storage;
class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::paginate(10); 
        return Inertia::render('Admin/Training/Index', [
            'trainings' => $trainings,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Training/Create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG',
            'description' => 'required|string',
            'has_form' => 'required|boolean'
        ]);

        $imagePath = $request->file('image')->store('trainings', 'public');

        Training::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'has_form' => $request->input('has_form'),
            'slug' => Str::slug($request->input('name')),
        ]);

        return redirect()->route('training.index');
    }
    
    public function edit($id)
    {
        $training = Training::findOrFail($id);
        
        return Inertia::render('Admin/Training/Edit', [
            'training' => $training, 
        ]);
    }
    public function update(Request $request, $id)
    {
        $training = Training::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // 1MB max size
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'has_form' => 'nullable|boolean',
        ]);

        // If there's a new image, delete the old one and store the new one
        if ($request->hasFile('image')) {
            if ($training->image) {
                Storage::disk('public')->delete($training->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('trainings', 'public');
        } else {
            // If no new image, keep the old image
            $validated['image'] = $training->image;
        }

        // Update the slug if the name changes
        $validated['slug'] = Str::slug($request->input('name'));

        // Update the training record
        $training->update($validated);

        return redirect()->route('training.index')->with('success', 'Training updated successfully!');
    }

    public function destroy($id){
        $training = Training::findOrFail($id);
        if($training->image){
            Storage::disk('public')->delete($training->image);
        }
        $training->delete(); 
        return redirect()->route('training.index');
    }

    public function show($id){
         $training = Training::findOrFail($id);
        
        return Inertia::render('Admin/Training/Details', [
            'training' => $training, 
        ]);
    }

}

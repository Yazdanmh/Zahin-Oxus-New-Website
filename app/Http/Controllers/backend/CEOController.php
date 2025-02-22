<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CEO;
use Illuminate\Support\Facades\Storage;
use Str; 

class CEOController extends Controller
{
    public function index()
    {
        $ceo = CEO::first(); // Retrieve the first CEO record
        return Inertia::render('Admin/CEO/Index', [
            'ceo' => $ceo,
        ]);
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string',
            'skills' => 'nullable|json',
        ]);
    
        // Check if a CEO record already exists
        $ceo = CEO::first();
    
        if ($ceo) {
            // If CEO exists, update the CEO's data
            $ceo->update([
                'name' => $validatedData['name'],
                'position' => $validatedData['position'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'description' => $validatedData['description'],
                'skills' => $validatedData['skills'] ?? null,
                'slug' => \Str::slug($validatedData['name']),
            ]);
        } else {
            // If no CEO record exists, create a new CEO
            $ceo = CEO::create([
                'name' => $validatedData['name'],
                'position' => $validatedData['position'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'description' => $validatedData['description'],
                'skills' => $validatedData['skills'] ?? null,
                'slug' => \Str::slug($validatedData['name']),
            ]);
        }
    
        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            // If a new image is uploaded, delete the old one
            if ($ceo->image) {
                Storage::disk('public')->delete($ceo->image);
            }
    
            // Store the new image and update the path
            $imagePath = $request->file('image')->store('ceo_images', 'public');
            $ceo->update(['image' => $imagePath]);
        }
        // Redirect back with a success message
        return redirect()->back()->with('success', $ceo->wasRecentlyCreated ? 'CEO information added successfully!' : 'CEO information updated successfully!');
    }
    
}

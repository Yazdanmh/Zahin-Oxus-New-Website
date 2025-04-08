<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\CEO;
use Illuminate\Support\Facades\Storage;
use Str;
use Illuminate\Routing\Controllers\Middleware;

class CEOController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
            new Middleware('can:site_data.edit', only: ['update']),
            new Middleware('can:site_data.create', only: ['update']),
        ];
    }

    public function index()
    {
        $ceo = CEO::first(); // Retrieve the first CEO record
        return Inertia::render('Admin/CEO/Index', [
            'ceo' => $ceo,
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
            'description' => 'required|string',
            'skills' => 'nullable|json',
        ]);
    
        $ceo = CEO::first();
    
        if ($ceo) {
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
    
        if ($request->hasFile('image')) {
            if ($ceo->image) {
                Storage::disk('public')->delete($ceo->image);
            }
    
            $imagePath = $request->file('image')->store('ceo_images', 'public');
            $ceo->update(['image' => $imagePath]);
        }

        return redirect()->back()->with('success', $ceo->wasRecentlyCreated ? 'CEO information added successfully!' : 'CEO information updated successfully!');
    }
}

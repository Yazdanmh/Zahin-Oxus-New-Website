<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage; 
class GalleriesController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Gallery/Index', [
            'galleries' => Gallery::paginate(8),
        ]); 
    }
    public function create(){
        return Inertia::render('Admin/Gallery/Create'); 
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg,webp|max:1024', 
        ]);
        $imagePath = $request->file('image')->store('gallery', 'public');
        
        // Create the gallery entry
        Gallery::create([
            'title' => $validated['title'],
            'image' => $imagePath,
        ]);
        return redirect()->route('galleries.index')->with('success', 'Gallery image added successfully.');
    }
    public function destroy($id){
        $gallery = Gallery::findOrFail($id); 
        if($gallery->image){
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete(); 
        return redirect()->route('galleries.index');
    }

}

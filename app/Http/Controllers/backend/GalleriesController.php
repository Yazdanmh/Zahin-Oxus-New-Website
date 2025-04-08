<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;

class GalleriesController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:gallery.view', only: ['index']),
            new Middleware('can:gallery.create', only: ['create', 'store']),
            new Middleware('can:gallery.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        return Inertia::render('Admin/Gallery/Index', [
            'galleries' => Gallery::paginate(8),
        ]);
    }

    public function create()
    {
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

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('galleries.index');
    }
}

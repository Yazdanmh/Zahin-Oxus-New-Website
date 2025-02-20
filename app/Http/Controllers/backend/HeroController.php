<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        return Inertia::render('Admin/Hero/Index', [
            'hero' => $hero,
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'button' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Get the first hero or handle if not found
        $hero = Hero::first();
        if (!$hero) {
            return redirect()->back()->withErrors('Settings not found.');
        }

        // Update hero fields (excluding image)
        $hero->update([
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'description' => $validatedData['description'],
            'button' => $validatedData['button'] ?? null,
            'link' => $validatedData['link'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $logoPath = $request->file('image')->store('home', 'public');
            $hero->update(['image' => $logoPath]);
        }

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }
}

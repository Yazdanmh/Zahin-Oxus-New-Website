<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;

class HeroController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
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
        $hero = Hero::first();
        return Inertia::render('Admin/Hero/Index', [
            'hero' => $hero,
        ]);
    }

    public function update(Request $request)
    {
        // return $request->all(); 
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'button' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $hero = Hero::first();
        if (!$hero) {
            $hero = new Hero();
        }

        $hero->title = $validatedData['title'];
        $hero->subtitle = $validatedData['subtitle'];
        $hero->description = $validatedData['description'];
        $hero->button = $validatedData['button'] ?? null;
        $hero->link = $validatedData['link'] ?? null;

        // Save initially to get an ID if new
        $hero->save();

        // Handle image uploads
        $imageFields = ['image_1', 'image_2', 'image_3'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($hero->$field) {
                    Storage::disk('public')->delete($hero->$field);
                }
                $imagePath = $request->file($field)->store('home', 'public');
                $hero->$field = $imagePath;
            }
        }

        // Save again if any image was updated
        $hero->save();

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }
}

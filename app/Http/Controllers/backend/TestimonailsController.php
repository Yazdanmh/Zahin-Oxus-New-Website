<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;

class TestimonailsController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
            new Middleware('can:site_data.create', only: ['create', 'store']),
            new Middleware('can:site_data.edit', only: ['edit', 'update']),
            new Middleware('can:site_data.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $testimonails = Testimonial::all();
        return Inertia::render('Admin/Testimonails/Index', [
            'testimonails' => $testimonails,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Testimonails/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'stars' => 'required|integer',
            'message' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('testimonails', 'public');

        Testimonial::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'stars' => $request->input('stars'),
            'message' => $request->input('message'),
            'image' => $imagePath,
        ]);

        return redirect()->route('testimonails.index');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return Inertia::render('Admin/Testimonails/Edit', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'stars' => 'required|integer',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];

        $validatedData = $request->validate($rules);

        $testimonial->name = $validatedData['name'];
        $testimonial->position = $validatedData['position'];
        $testimonial->stars = $validatedData['stars'];
        $testimonial->message = $validatedData['message'];

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $imagePath = $request->file('image')->store('testimonails', 'public');
            $testimonial->image = $imagePath;
        }

        $testimonial->save();

        return redirect()->route('testimonails.index');
    }

    public function destroy($id)
    {
        $testi = Testimonial::findOrFail($id);

        if ($testi->image) {
            Storage::disk('public')->delete($testi->image);
        }

        $testi->delete();

        return redirect()->route('testimonails.index');
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Trainer;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Str;
use Illuminate\Routing\Controllers\Middleware;

class TrainersController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
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
        $query = Trainer::with('service');

        if ($request->has('query') && $request->query !== '') {
            $query->where(function($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query . '%')
                      ->orWhere('position', 'like', '%' . $request->query . '%');
            });
        }

        if ($request->has('service_id') && $request->service_id !== '') {
            $query->where('service_id', $request->service_id);
        }

        $trainers = $query->paginate(10);

        return Inertia::render('Admin/Trainers/Index', [
            'trainers' => $trainers,
            'services' => Service::all(),
        ]);
    }

    public function create()
    {
        $services = Service::all();
        return Inertia::render('Admin/Trainers/Create', [
            'services' => $services,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|unique:trainers,email',
            'phone' => 'nullable|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'description' => 'required|string',
            'skills' => 'nullable|json',
            'service_id' => 'required|integer',
            'show_on_home' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trainers', 'public');
        }

        Trainer::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imagePath ?? null,
            'description' => $request->description,
            'skills' => $request->skills,
            'service_id' => $request->service_id,
            'slug' => Str::slug($request->name),
            'show_on_home' => $request->show_on_home,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer created successfully.');
    }

    public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        $services = Service::all();
        return Inertia::render('Admin/Trainers/Edit', [
            'trainer' => $trainer,
            'services' => $services,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|unique:trainers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'description' => 'required|string',
            'skills' => 'nullable|json',
            'service_id' => 'required|integer',
            'show_on_home' => 'required|boolean',
        ]);

        $trainer = Trainer::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($trainer->image) {
                Storage::disk('public')->delete($trainer->image);
            }
            $imagePath = $request->file('image')->store('trainers', 'public');
        } else {
            $imagePath = $trainer->image;
        }

        $trainer->update([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imagePath,
            'description' => $request->description,
            'skills' => $request->skills,
            'slug' => Str::slug($request->name),
            'service_id' => $request->service_id,
            'show_on_home' => $request->show_on_home,
        ]);

        return redirect()->route('trainers.index')->with('success', 'Trainer updated successfully.');
    }

    public function show($id)
    {
        $trainer = Trainer::with('service')->findOrFail($id);
        return Inertia::render('Admin/Trainers/Show', [
            'trainer' => $trainer,
        ]);
    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        if ($trainer->image) {
            Storage::disk('public')->delete($trainer->image);
        }

        $trainer->delete();

        return redirect()->route('trainers.index');
    }
}

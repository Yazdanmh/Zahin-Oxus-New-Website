<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Services;
use Illuminate\Support\Facades\Storage;
use Str; 
class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::paginate(10);
        return Inertia::render('Admin/Services/Index', [
            'services' => $services
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Services/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('services', 'public');

        Services::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'image' => $imagePath,
            'icon' => $request->input('icon'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('title')),
        ]);

        return redirect()->route('services.index');
    }
    public function show($id)
    {
        $service = Services::findOrFail($id);

        return Inertia::render('Admin/Services/Details', [
            'service' => $service
        ]);
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $service = Services::findOrFail($id);

        // Base validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ];

        // Add image validation only if a file is uploaded
        if ($request->hasFile('image')) {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Update fields
        $service->title = $validatedData['title'];
        $service->subtitle = $validatedData['subtitle'] ?? $service->subtitle;
        $service->description = $validatedData['description'] ?? $service->description;
        $service->icon = $validatedData['icon'] ?? $service->icon;
        $service->slug = Str::slug($validatedData['title']);
        // Handle image upload
        if ($request->hasFile('image')) {
            
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            // Store new image and update the path
            $imagePath = $request->file('image')->store('services', 'public');
            $service->image = $imagePath;
        }

        // Save the updated service
        $service->save();

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    

    public function destroy($id)
    {
        $service = Services::findOrFail($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\Middleware;

class ServicesController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index', 'show']),
            new Middleware('can:site_data.create', only: ['create', 'store']),
            new Middleware('can:site_data.edit', only: ['edit', 'update']),
            new Middleware('can:site_data.delete', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $query = Service::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        $services = $query->paginate(9);
        $categories = ServiceCategory::all();

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return Inertia::render('Admin/Services/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:service_categories,id',
        ]);

        $imagePath = $request->file('image')->store('services', 'public');

        $slug = Str::slug($request->input('title'));
        if (Service::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
        }

        Service::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'image' => $imagePath,
            'icon' => $request->input('icon'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'service_category_id' => $request->input('category'),
        ]);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function show($id)
    {
        $service = Service::with('category')->findOrFail($id);
        return Inertia::render('Admin/Services/Details', [
            'service' => $service
        ]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $categories = ServiceCategory::all();

        return Inertia::render('Admin/Services/Edit', [
            'service' => $service,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $rules = [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'category' => 'nullable|exists:service_categories,id',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        }

        $validatedData = $request->validate($rules);

        $service->title = $validatedData['title'];
        $service->subtitle = $validatedData['subtitle'] ?? $service->subtitle;
        $service->description = $validatedData['description'] ?? $service->description;
        $service->icon = $validatedData['icon'] ?? $service->icon;
        $service->service_category_id = $validatedData['category'] ?? $service->service_category_id;

        if ($service->title !== $validatedData['title']) {
            $slug = Str::slug($validatedData['title']);
            if (Service::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug .= '-' . uniqid();
            }
            $service->slug = $slug;
        }

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $request->file('image')->store('services', 'public');
        }

        $service->save();

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}

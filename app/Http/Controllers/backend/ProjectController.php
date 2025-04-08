<?php

namespace App\Http\Controllers\backend;
use App\Models\Project;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Str;
use Illuminate\Routing\Controllers\Middleware;

class ProjectController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:projects.view', only: ['index', 'show']),
            new Middleware('can:projects.create', only: ['create', 'store']),
            new Middleware('can:projects.edit', only: ['edit', 'update']),
            new Middleware('can:projects.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $projects = Project::with('category')->paginate(5);
        return Inertia::render('Admin/Projects/Index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Projects/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,gif,PNG,svg,webp',
        ]);
        $imagePath = $request->file('image')->store('projects', 'public');
        Project::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image' => $imagePath,
            'slug' => Str::slug($request->input('name')),
        ]);
        return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Admin/Projects/Edit', [
            'project' => $project,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,gif,PNG,svg,webp',
        ]);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->category_id = $request->category_id;
        $project->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
            $project->image = $imagePath;
        }
        $project->save();
        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Admin/Projects/Details', [
            'project' => $project,
            'categories' => $categories
        ]);
    }
}

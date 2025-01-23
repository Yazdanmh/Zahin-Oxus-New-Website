<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; 
use App\Models\Category; 
use Inertia\Inertia;
class ProjectsController extends Controller
{
    public function index(){
        $projects = Project::paginate(4);
        $categories = Category::all();
        return Inertia::render('Client/Projects/Index',[
            'projects' => $projects,
            'categories' => $categories,
        ]);
    }
    public function show($slug){
        $project = Project::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return Inertia::render('Client/Projects/Details', [
            'project' => $project,
            'categories' => $categories,
        ]);
    }
}

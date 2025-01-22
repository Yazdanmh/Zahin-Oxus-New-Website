<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\Hero; 
use App\Models\Friend; 
use App\Models\Services;  
use App\Models\Counter;  
use App\Models\Project;  
use App\Models\Category;  
use App\Models\Testimonial;  

class HomeController extends Controller
{
    public function index(){
        $hero = Hero::first(); 
        $friends = Friend::all();
        $services = Services::paginate(4); 
        $counter = Counter::first(); 
        $projects = Project::paginate(4);
        $categories = Category::all(); 
        $testimonials = Testimonial::all(); 
        return Inertia::render('Client/Home/Index', [
            'hero' => $hero,
            'friends' => $friends,
            'services' => $services,
            'counter' => $counter, 
            'projects' => $projects,
            'categories' => $categories,
            'testimonials' => $testimonials, 
        ]); 
    }
}

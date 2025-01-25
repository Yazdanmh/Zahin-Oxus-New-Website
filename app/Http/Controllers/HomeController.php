<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Hero;
use App\Models\Friend;
use App\Models\Services;
use App\Models\Counter;
use App\Models\Project;
use App\Models\Training;
use App\Models\Category;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $friends = Friend::all();
        $services = Services::paginate(4);
        $counter = Counter::first();
        $projects = Project::paginate(4);
        $categories = Category::all();
        $testimonials = Testimonial::all();
        $about = About::first();
        $trainings = Training::paginate(4);

        return Inertia::render('Client/Home/Index', [
            'hero' => $hero,
            'friends' => $friends,
            'services' => $services,
            'counter' => $counter,
            'projects' => $projects,
            'categories' => $categories,
            'testimonials' => $testimonials,
            'about' => $about,
            'trainings' => $trainings, 
        ]);
    }
    public function about()
    {
        $about = About::first();
        $counter = Counter::first();
        $testimonials = Testimonial::all();
        $friends = Friend::all();
        return Inertia::render('Client/About/Index', [
            'about' => $about,
            'counter' => $counter,
            'testimonials' => $testimonials,
            'friends' => $friends,
        ]);
    }
}

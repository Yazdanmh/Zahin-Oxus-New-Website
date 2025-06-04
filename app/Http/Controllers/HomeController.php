<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Hero;
use App\Models\Friend;
use App\Models\Service;
use App\Models\Counter;
use App\Models\Project;
use App\Models\Training;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\OurMission;
use App\Models\OurVision;
use App\Models\Newsletter;
use App\Models\History;
use App\Models\Trainer;
use App\Models\CEO;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::select('title', 'subtitle', 'description', 'image_1', 'image_2', 'image_3', 'button', 'link')->first();
        $friends = Friend::all();
        $services = Service::select('title', 'subtitle', 'description', 'image', 'icon', 'slug')->paginate(5);
        $counter = Counter::first();
        $projects = Project::paginate(4);
        $categories = Category::all();
        $testimonials = Testimonial::all();
        $about = About::first();
        $trainings = Training::where('start_date', '>', now())
            ->orderBy('start_date')
            ->paginate(4);
        $history = History::first();
        $teams = Trainer::where('show_on_home', 1)->get();

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
            'history' => $history,
            'teams' => $teams,
        ]);
    }
    public function about()
    {
        $about = About::first();
        $counter = Counter::first();
        $testimonials = Testimonial::all();
        $friends = Friend::all();
        $teams = Trainer::where('show_on_home', 1)->get();
        $ceo = CEO::first();
        return Inertia::render('Client/About/Index', [
            'about' => $about,
            'counter' => $counter,
            'testimonials' => $testimonials,
            'friends' => $friends,
            'teams' => $teams,
            'ceo' => $ceo,
        ]);
    }
    public function OurMission()
    {
        return Inertia::render('Client/About/Mission', [
            'our_mission' => OurMission::first(),
        ]);
    }
    public function OurVision()
    {
        return Inertia::render('Client/About/Vision', [
            'our_vision' => OurVision::first(),
        ]);
    }
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $validated['email'],
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}

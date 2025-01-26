<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\OurMission;
use App\Models\OurVision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return Inertia::render('Admin/About/Index', [
            'about' => $about,
        ]);
    }
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_one' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'image_two' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'features' => 'nullable|string',
        ]);

        $about = About::firstOrNew([]);

        $about->title = $request->title;
        $about->description = $request->description;
        $about->features = $request->features;

        if ($request->hasFile('image_one')) {
            if ($about->image_one) {
                Storage::disk('public')->delete($about->image_one);
            }

            $about->image_one = $request->file('image_one')->store('abouts', 'public');
        }

        if ($request->hasFile('image_two')) {
            if ($about->image_two) {
                Storage::disk('public')->delete($about->image_two);
            }
            $about->image_two = $request->file('image_two')->store('abouts', 'public');
        }

        $about->save();

        return redirect()->route('about.index');
    }

    public function mission(){
        $our_mission = OurMission::first(); 
        return Inertia::render('Admin/About/Mission', [
            'our_mission' => $our_mission,
        ]);
    }
    public function mission_store(Request $request)
    {
        $request->validate([
            'our_mission' => 'required|string',
        ]);
        
        $ourmission = OurMission::first();
        
        if (!$ourmission) {
            $ourmission = new OurMission();
        }

        $ourmission->our_mission = $request->our_mission; 
        
        $ourmission->save(); 
        
        return redirect()->back()->with('success', 'Mission statement saved successfully!');
    }
    public function vision(){
        $our_vision = OurVision::first(); 
        return Inertia::render('Admin/About/Vision', [
            'our_vision' => $our_vision,
        ]);
    }
    public function vision_store(Request $request)
    {

        $request->validate([
            'our_vision' => 'required|string',
        ]);
        
        $ourvision = OurVision::first();
        
        if (!$ourvision) {
            $ourvision = new OurVision();
        }

        $ourvision->our_vision = $request->our_vision; 
        
        $ourvision->save(); 
        
        return redirect()->back()->with('success', 'Vision statement saved successfully!');
    }

}

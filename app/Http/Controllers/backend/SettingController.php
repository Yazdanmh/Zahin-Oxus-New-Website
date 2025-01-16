<?php

namespace App\Http\Controllers\backend;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return Inertia::render('Admin/Settings/Index', [
            'settings' => $settings,
        ]);
    }
    public function update(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'site' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'facebook' => 'nullable|string',
        'instagram' => 'nullable|string',
        'youtube' => 'nullable|string',
        'twitter' => 'nullable|string',
        'about' => 'nullable|string',
        'logo' => 'nullable|image|mimes:jpeg,png,gif|max:800', // Validate logo image
    ]);

    // If logo is uploaded, handle it
    if ($request->hasFile('logo')) {
        // Store the file in the public directory and get the path
        $path = $request->file('logo')->store('logos', 'public');
    }

    // Update settings with new values
    // Assuming you have a settings model to update
    $settings = Setting::first(); // Retrieve the settings from the DB (you can adjust this as needed)

    $settings->update([
        'site_name' => $request->site,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'facebook_url' => $request->facebook,
        'instagram_url' => $request->instagram,
        'youtube_url' => $request->youtube,
        'twitter_url' => $request->twitter,
        'about' => $request->about,
        'site_logo' => $path ?? $settings->site_logo, // If no new logo, keep the old one
    ]);

    return redirect()->back();
}

}

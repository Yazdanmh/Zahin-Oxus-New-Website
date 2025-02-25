<?php

namespace App\Http\Controllers\backend;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // Validate the request data
        $validatedData = $request->validate([
            'website_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|regex:/^\+?[0-9\s]+$/|max:15',
            'address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'about' => 'nullable|string|max:1000',
        ]);

        // Retrieve the first settings record
        $settings = Setting::first();

        if (!$settings) {
            return redirect()->back()->withErrors('Settings not found.');
        }

      
        $settings->update([
            'site_name' => $validatedData['website_name'],
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'facebook_url' => $validatedData['facebook_url'] ?? null,
            'twitter_url' => $validatedData['twitter_url'] ?? null,
            'instagram_url' => $validatedData['instagram_url'] ?? null,
            'youtube_url' => $validatedData['youtube_url'] ?? null,
            'about' => $validatedData['about'] ?? null,
        ]);

        // Handle the logo upload if provided
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($settings->site_logo) {
                Storage::disk('public')->delete($settings->site_logo);
            }

            // Store the new logo and update the path
            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->update(['site_logo' => $logoPath]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}

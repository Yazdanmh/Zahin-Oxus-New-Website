<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\History; 
use Illuminate\Support\Facades\Storage; 

class HistoryController extends Controller
{
    public function index(){
        $history = History::first(); 
        return Inertia::render('Admin/History/Index',[
            'history' => $history,
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image_one' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
            'image_two' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
            'progress_items' => 'nullable|json',
        ]);
        $history = History::firstOrNew([]);
        $history->title = $request->title;
        $history->subtitle = $request->subtitle;
        $history->description = $request->description;
        $history->progress_items = $request->progress_items ? json_decode($request->progress_items, true) : null;

        if ($request->hasFile('image_one')) {
            if ($history->image_one) {
                Storage::disk('public')->delete($history->image_one);
            }
            $history->image_one = $request->file('image_one')->store('history', 'public');
        }
        if ($request->hasFile('image_two')) {
            if ($history->image_two) {
                Storage::disk('public')->delete($history->image_two);
            }
            $history->image_two = $request->file('image_two')->store('history', 'public');
        }
        $history->save();
        return redirect()->route('history.index');
    }
}

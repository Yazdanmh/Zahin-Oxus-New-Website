<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\News; 

class EventsController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('search', '');
    
        // Get all events, applying the search filter if a query is provided
        $events = News::orderByDesc('created_at')->paginate(5);
        $news = News::orderByDesc('created_at')
                    ->where('title', 'like', '%' . $searchQuery . '%')  // Filter by title or any other attribute you want
                    ->take(5)
                    ->get();
            
        return Inertia::render('Client/Events/Index', [
            'events' => $events,
            'recent' => $news,  
        ]);
    }
    
    public function show(Request $request, $slug)
    {
        $searchQuery = $request->input('search', '');  // Get search query from the request
    
        // Fetch the specific event based on the slug
        $event = News::where('slug', $slug)->firstOrFail();
    
        // Get the recent events, applying the search query filter
        $news = News::orderByDesc('created_at')
                    ->where('title', 'like', '%' . $searchQuery . '%')  // Filter by title or other attributes
                    ->take(5)
                    ->get();
            
        return Inertia::render('Client/Events/Event', [
            'event' => $event,
            'recent' => $news,  
        ]);
    }
    

}

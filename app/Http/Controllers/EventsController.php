<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\News;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search', '');
    
        // Pagination for events
        $events = News::where('is_published', 1)
                      ->orderByDesc('created_at')
                      ->paginate(5);

        // News query with search functionality
        $news = News::where('is_published', 1)
                    ->orderByDesc('created_at')
                    ->where('title', 'like', '%' . $searchQuery . '%')
                    ->take(5)
                    ->get();
            
        return Inertia::render('Client/Events/Index', [
            'events' => $events,
            'recent' => $news,  
        ]);
    }
    
    public function show(Request $request, $slug)
    {
        $searchQuery = $request->input('search', '');  

        // Fetch the specific event
        $event = News::where('slug', $slug)->firstOrFail();
    
        // News query with search functionality
        $news = News::where('is_published', 1)
                    ->orderByDesc('created_at')
                    ->where('title', 'like', '%' . $searchQuery . '%')
                    ->take(5)
                    ->get();
            
        return Inertia::render('Client/Events/Event', [
            'event' => $event,
            'recent' => $news,  
        ]);
    }
}

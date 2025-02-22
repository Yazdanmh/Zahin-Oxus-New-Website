<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; 
use App\Models\ServiceCategory; 
use Inertia\Inertia; 
use App\Models\Trainer;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all(); 
        return Inertia::render('Client/Service/Index',[
            'services' => $services, 
        ]); 
    }
    public function show($slug)
    {
        
        $service = Service::with('category')->where('slug', $slug)->firstOrFail();
        $trainers = Trainer::where('service_id', $service->id)->get();
        $services = Service::where('slug', '!=', $slug)
                            ->orderByDesc('created_at')
                            ->paginate(6);
    
        return Inertia::render('Client/Service/Details', [
            'service' => $service,
            'services' => $services,
            'trainers' => $trainers
        ]);
    }
    
    public function category($slug) {
        $category = ServiceCategory::where('slug', $slug)->first(); 
        if (!$category) {
            abort(404); 
        }
        $services = Service::where('service_category_id', $category->id)->get(); // Add `get()`
    
        return Inertia::render('Client/Service/Index', [
            'services' => $services, 
            'category' => $category
        ]); 
    }
    
    

}

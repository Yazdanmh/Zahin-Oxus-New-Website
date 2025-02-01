<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services; 
use Inertia\Inertia; 

class ServiceController extends Controller
{
    public function index(){
        $services = Services::all(); 
        return Inertia::render('Client/Service/Index',[
            'services' => $services, 
        ]); 
    }
    public function show($slug)
    {
        $service = Services::where('slug', $slug)->firstOrFail();
        $services = Services::where('slug', '!=', $slug)
                            ->orderByDesc('created_at') 
                            ->paginate(6);
    
        return Inertia::render('Client/Service/Details', [
            'service' => $service,
            'services' => $services,
        ]);
    }
    
    

}

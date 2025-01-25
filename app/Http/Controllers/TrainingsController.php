<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use Inertia\Inertia; 
class TrainingsController extends Controller
{
    public function index(){
        $trainings = Training::orderByDesc('created_at')
            ->paginate(4); // Call paginate only once
        return Inertia::render('Client/Trainings/Index', [
            'trainings' => $trainings,
        ]);
    }
    
    public function show($slug){
        $training = Training::where('slug', $slug)->firstOrFail();
        $trainings = Training::where('slug', '!=', $slug)
                            ->orderByDesc('created_at') 
                            ->paginate(10);
        return Inertia::render('Client/Trainings/Details', [
            'training' => $training,
            'trainings' => $trainings,
        ]);
    }
}

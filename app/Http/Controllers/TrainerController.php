<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Trainer;
use App\Models\CEO;
use Illuminate\Http\Response;


class TrainerController extends Controller
{
    public function index(){
        return Inertia::render('Client/Trainers/Index',[
            'trainers' => Trainer::paginate(50), 
        ]);
    }

    public function show($slug)
    {
        $trainer = Trainer::with('service')->where('slug', $slug)->first();
        return Inertia::render('Client/Trainers/Details', [
            'trainer' => $trainer
        ]);
    }

    public function getCEO($slug)
    {
        // Find the CEO by slug
        $trainer = CEO::where('slug', $slug)->first();
    
        // If the trainer is not found, return a 404 response
        if (!$trainer) {
            abort(404, 'CEO not found');
        }
    
        // If the trainer is found, render the view with the trainer data
        return Inertia::render('Client/Trainers/CEO', [
            'trainer' => $trainer
        ]);
    }
    
}

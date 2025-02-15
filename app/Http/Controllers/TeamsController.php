<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\Member; 

class TeamsController extends Controller
{
    public function show($slug)
    {
        $team = Member::where('slug', $slug)->first();
        return Inertia::render('Client/Teams/Show', [
            'team' => $team
        ]);
    }
}

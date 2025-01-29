<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 

class AcademicController extends Controller
{
    public function index(){
        return Inertia::render('Client/Calendar/Index');
    }
}

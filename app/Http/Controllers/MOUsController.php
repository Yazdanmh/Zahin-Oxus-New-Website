<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\MOU; 
class MOUsController extends Controller
{
    public function index(){
        $mous  = MOU::all(); 
        return Inertia::render('Client/MOU/Index',[
            'mous' => $mous, 
        ]);
    }
}

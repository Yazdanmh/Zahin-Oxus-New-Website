<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter; 
use Inertia\Inertia;

class CounterController extends Controller
{
    public function index(){
        $counter = Counter::first(); 

        return Inertia::render('Admin/Counter/Index', [
            'counter' => $counter,
        ]);
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([ // Fix typo here
            'happy_users' => 'required|integer', 
            'case_complete' => 'required|integer', 
            'years_of_experience' => 'required|integer', 
            'professional_advisor' => 'required|integer', 
        ]);

        $counter = Counter::first();
        $counter->update($validatedData);

        return redirect()->back()->with('success', 'Counter updated successfully.');
    }

}

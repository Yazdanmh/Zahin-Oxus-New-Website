<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactForm; 
class ContactController extends Controller
{
    public function index(){
        return Inertia::render('Client/Contact/Index'); 
    }
    public function store(Request $request)
    {
        // Step 1: Validate the incoming data
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        // Step 2: Create the contact form entry
        ContactForm::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'message' => $validated['message'],
        ]);
    
        
        return redirect()->back(); 
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
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
        
        // Step 2: Create the contact form entry in the database
        ContactForm::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Step 3: Send the email using Laravel’s Mailable system
        try {
            Mail::to('mohammadiy207@gmail.com')->send(new ContactFormMail(
                $validated['name'],
                $validated['email'],
                $validated['message']
            ));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'There was an issue sending your message.');
        }

        // Step 4: Return a response to Inertia to redirect back or show success
        return redirect()->back()->with('success', 'Your message has been sent!');
       

    }
}

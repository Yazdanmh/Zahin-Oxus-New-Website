<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia; 
use App\Models\ContactForm;
class NotificationController extends Controller
{
    public function index(){
        $messages = ContactForm::all(); 
        return Inertia::render('Admin/Notifications/Index', [
            'messages' => $messages, 
        ]); 
    }
}

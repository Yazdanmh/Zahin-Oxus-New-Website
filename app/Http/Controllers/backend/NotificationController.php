<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ContactForm;
use Illuminate\Routing\Controllers\Middleware;
class NotificationController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
        ];
    }

    public function index()
    {
        $messages = ContactForm::all(); 
        return Inertia::render('Admin/Notifications/Index', [
            'messages' => $messages, 
        ]);
    }
}

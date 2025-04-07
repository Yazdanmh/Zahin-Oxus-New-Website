<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Service;
use App\Models\Training;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            // Apply the 'can:site_data.view' middleware to the 'index' method.
            new Middleware('can:site_data.view', only: ['index']),
            // Add other middlewares here if needed, for example:
            // new Middleware('log', only: ['index']),
            // new Middleware('subscribed', except: ['store']),
        ];
    }

    public function index()
    {
        $services = Service::all();
        $news = News::all();
        $trainings = Training::all();
        $gallery = Gallery::all();
        $messages = ContactForm::take(2)->get();

        return Inertia::render('Admin/Dashboard', [
            'services' => $services,
            'news' => $news,
            'trainings' => $trainings,
            'gallery' => $gallery,
            'messages' => $messages
        ]);
    }
}

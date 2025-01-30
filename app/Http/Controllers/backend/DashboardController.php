<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Services;
use App\Models\Training;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $services = Services::all();
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

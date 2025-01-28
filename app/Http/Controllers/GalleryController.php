<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Gallery;; 

class GalleryController extends Controller
{
 

    public function index()
    {
        $gallery = Gallery::all(['id', 'title', 'image']);
        return Inertia::render('Client/Gallery/Index', [
            'gallery' => $gallery,
        ]);
    }

}

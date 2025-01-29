<?php

namespace App\Http\Controllers;

use App\Models\AcademicCalendar;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcademicController extends Controller
{
    public function index()
    {
        $calendars = AcademicCalendar::all();
        return Inertia::render('Client/Calendar/Index', [
            'calendars' => $calendars,
        ]);
    }
}

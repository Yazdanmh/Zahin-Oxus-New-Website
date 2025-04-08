<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter; 
use Inertia\Inertia;
use Illuminate\Routing\Controllers\Middleware;

class CounterController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:site_data.view', only: ['index']),
            new Middleware('can:site_data.edit', only: ['update']),
            new Middleware('can:site_data.create', only: ['update']),
        ];
    }

    public function index()
    {
        $counter = Counter::first();

        return Inertia::render('Admin/Counter/Index', [
            'counter' => $counter,
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
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

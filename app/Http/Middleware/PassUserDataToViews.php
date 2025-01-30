<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;
use App\Models\Setting; 
use Illuminate\Support\Facades\Auth;

class PassUserDataToViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $settings = Setting::first();
    
            Inertia::share([
                'user' => $user,
                'setting' => $settings,
            ]);
        }
    
        return $next($request);
    }
}

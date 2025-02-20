<?php

// app/Http/Middleware/ShareGlobalData.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
use App\Models\ServiceCategory; 

class ShareGlobalData
{
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first(); 
        $services = ServiceCategory::all(); 
        Inertia::share([
            'setting' => $setting, 
            'service_categories' => $services
        ]);

        return $next($request);
    }
}

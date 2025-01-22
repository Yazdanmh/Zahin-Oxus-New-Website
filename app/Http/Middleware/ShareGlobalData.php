<?php

// app/Http/Middleware/ShareGlobalData.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
class ShareGlobalData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first(); 

        Inertia::share([
            'setting' => $setting, 
        ]);

        return $next($request);
    }
}

<?php

// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Assuming you are checking if the authenticated user is an admin
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;
use Auth;
use Illuminate\Support\Facades\Route;
use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if (Auth::Check()) {
            return $next($request);
        } else {
            return redirect('admin/login');
        }
    }
}

// Middleware đóng vai trò như là 1 lễ tân
// Khi vô văn phòng => gặp lễ tân => Nếu lễ tân cho mình vô văn hòng => mới dô,
        // lễ tân ko cho thì ra ngoài
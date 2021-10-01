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
            // $user=Auth::user();
            // if ($user->) {
            //     // code...
            // }
            return $next($request);
        }else{
            return redirect('/login');
        }
        
    }
}

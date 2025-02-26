<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {

            if(auth()->user()->role ==='admin'){
                return redirect()->route('admin.dashboard')->with(['message'=> 'Admin login successfully','class' => 'alert alert-success text-center  mt-2']);
            }
            return redirect()->route('login')->with(['message'=> 'Please longin first','class' => 'alert alert-warning text-center  mt-2']);
        }
        return $next($request);
    }
}

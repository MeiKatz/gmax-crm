<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        $usertype = auth()->user()->usertype;   
        if($usertype!=1)
        {
            return redirect()->route('dashboard');
        }
        else
        {
        return $next($request);
        }
    }
}

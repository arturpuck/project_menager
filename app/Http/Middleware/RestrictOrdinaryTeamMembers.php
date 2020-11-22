<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictOrdinaryTeamMembers
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
        if(\Auth::user()->is_ordinary_team_member){
            return back();
        }
        return $next($request);
    }
}

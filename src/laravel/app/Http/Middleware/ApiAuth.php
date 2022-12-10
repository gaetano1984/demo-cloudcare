<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserToken;
use App\Exceptions\TokenNotFound;

class ApiAuth
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
        if(UserToken::where('token', $request->header('token'))->count()==0){
            throw new TokenNotFound('token not found');
        }
        return $next($request);
    }
}

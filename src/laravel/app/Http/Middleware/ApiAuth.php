<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserToken;
use App\Exceptions\TokenNotFound;
use App\Services\UserTokenService;

class ApiAuth
{
    public $userTokenService;

    public function __construct(UserTokenService $userTokenService){
        $this->userTokenService = $userTokenService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $check = $this->userTokenService->search($request->header('token'));
        if($check->count()==0){
            throw new TokenNotFound('token not found');
        }
        return $next($request);
    }
}

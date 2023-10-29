<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Classes\UserClass;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $userClass = new UserClass($request);
        $userType = $request->session()->get('user_type');

        if ($userClass->isAuthenticated() && $userType == 0) {
            return $next($request);
        }


        return response('Unauthorized', 401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Classes\UserClass;

class AuthCustom
{
    public function handle(Request $request, Closure $next): Response
    {
        $userClass = new UserClass($request);


        if ($userClass->isAuthenticated()) {
            return $next($request);
        }


        return response('Unauthorized', 401);
    }
}

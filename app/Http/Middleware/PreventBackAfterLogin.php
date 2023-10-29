<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Classes\UserClass;

class PreventBackAfterLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userClass = new UserClass($request);

        if ($userClass->isAuthenticated()) {
            $userType = $request->session()->get('user_type');
            return redirect($userClass->redirectToDashboard($userType));
        }

        return $next($request);
    }
}

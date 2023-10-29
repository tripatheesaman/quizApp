<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Classes\UserClass;

class AuthController extends BaseController
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function registerHandle(Request $request)
    {
        $request->validate(
            [
                'firstname' => 'required|max:20|alpha',
                'lastname' => 'required|max:30|alpha',
                'email' => 'required|email|max:100|',
                'password' => 'required'
            ]
        );
        $requestArray = $request->toArray();
        $result = $this->user->createUser($requestArray);
        $result == 1 ? $status = 1 : $status = 2;
        if ($status == 1) {
            return redirect('/login?status=1');
        } else {
            return redirect()->back()->with('status', $status);
        }
    }
    public function loginHandle(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|max:100|',
                'password' => 'required'
            ]
        );
        $requestArray = $request->toArray();
        $userClass = new UserClass($request, $this->user);
        $userType = $userClass->login($requestArray);
        if ($userType === '2') {
            return redirect('/login?status=2');
        } else {
            session()->put('user_type', $userType);
            return redirect($userClass->redirectToDashboard($userType));
        }
    }
    public function logoutHandle(Request $request)
    {

        $userClass = new UserClass($request, $this->user);

        return redirect($userClass->logout());
    }
}

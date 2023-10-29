<?php

namespace App\Classes;

use App\Interfaces\UserInterface;
use Illuminate\Http\Request;
use App\Models\User;


class UserClass implements UserInterface
{

    protected $request;
    protected $user;


    public function __construct(Request $request, User $user = null)
    {
        $this->request = $request->toArray();

        $this->user = $user;
    }
    public function redirectToDashboard($userType)
    {

        if ($userType == 0) {
            session()->put('User Data', 'admin');
            return '/admin/dashboard';
        } elseif ($userType == 1) {
            session()->put('User Data', 'user');

            return '/user/dashboard';
        } else {
            return redirect('/');
        }
    }
    public function login($userDetails)
    {

        $result = $this->user->getUserDetails($userDetails['email'], $userDetails['password']);
        if ($result != NULL) {
            session()->put('user_id', $result['user_id']);

            return  $result['user_type'];
        } else {
            return '2';
        }
    }
    public function logout()
    {
        session()->flush();
        return ('/');
    }
    public function isAuthenticated()
    {
        if (session()->has('user_type')) {
            if (session()->get('user_type') == 0 || session()->get('user_type') == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

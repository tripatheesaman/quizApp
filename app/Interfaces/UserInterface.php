<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\User;

interface UserInterface
{
    public function __construct(Request $request, User $user);

    public function login($userDetails);

    public function redirectToDashboard($userType);
    public function logout();
}

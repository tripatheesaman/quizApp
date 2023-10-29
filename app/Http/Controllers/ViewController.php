<?php

namespace App\Http\Controllers;

use App\Classes\QuizClass;

class ViewController
{

    public function index()
    {
        return view('welcome');
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function adminDashboard()
    {
        return view('admin-home');
    }
    public function createQuiz()
    {
        return view('create-quiz');
    }
    public function userDashBoard()
    {
        $quizClass = new QuizClass();
        $quizzes = $quizClass->getAllQuiz();
        return view('user-home', compact('quizzes'));
    }
}

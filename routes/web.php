<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['no-cache'])->group(function () {
    Route::middleware(['prevent-back'])->group(function () {
        Route::any('/', [ViewController::class, "index"]);
        Route::get('/login', [ViewController::class, "login"]);
        Route::post('/login', [AuthController::class, "loginHandle"]);
        Route::get('/register', [ViewController::class, "register"]);
        Route::post('/register', [AuthController::class, "registerHandle"]);
    });
    Route::middleware(['auth-custom'])->group(function () {
        Route::middleware(['admin-auth'])->group(function () {
            Route::get('/admin/dashboard', [ViewController::class, "adminDashboard"])->name('admin-home');
            Route::get('/admin/createquiz', [ViewController::class, "createQuiz"]);
            Route::post('/admin/createquiz', [QuizController::class, "createQuizHandle"])->name('quiz.create');
            Route::get('/admin/getquiz', [QuizController::class, "displayQuiz"])->name('quiz.list');
            Route::delete('/quizzes/{quiz}', [QuizController::class, "deleteQuiz"])->name('quizzes.destroy');
            Route::get('/quizzes/{id}/edit', [QuizController::class, "editQuiz"])->name('quizzes.edit');
            Route::put('/quizzes/{id}', [QuizController::class, "updateQuiz"])->name('quizzes.update');
            Route::delete('/quizzes/delete/{id}', [QuizController::class, "deleteQuiz"])->name('quizzes.delete');
            Route::get('/admin/reportlist', [ReportsController::class, "displayReportList"])->name('report-list');
            Route::get('/admin/report/{id}', [ReportsController::class, "individualReport"])->name('individual-report');
            Route::get('/admin/playQuiz', [ViewController::class, "userDashBoard"])->name('admin-play');
        });


        Route::get('/logout', [AuthController::class, "logoutHandle"])->name('logout');
        Route::get('/user/dashboard', [ViewController::class, "userDashBoard"])->name('user-home');
        Route::get('/startquiz/{id}', [QuizController::class, "startQuiz"])->name('start-quiz');
        Route::post('/submitquiz', [QuizController::class, "submitQuiz"])->name('submit-quiz');
    });
});

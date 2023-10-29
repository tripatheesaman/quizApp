<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface QuizInterface
{
    public function __construct(Request $request);


    public function createQuiz();

    public function updateQuiz($request, $quizId, $deletedIds);
    public function deleteQuiz($id);
    public function getQuiz($quizId);
}

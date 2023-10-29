<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Questions;
use App\Classes\QuizClass;
use App\Classes\ReportsClass;


class QuizController extends Controller
{
    protected $reportsClass;
    public function __construct()
    {
        $this->reportsClass = new ReportsClass();
    }
    public function createQuizHandle(Request $request)
    {
        $quizClass = new QuizClass($request);
        $quizClass->createQuiz();
        return redirect()->back()->with('success', 'Quiz created successfully.');
    }

    public function getQuizHandle($quizId)
    {
        $quizClass = new QuizClass();
        $quizClass->getQuiz($quizId);
    }
    public function displayQuiz()
    {
        $quizClass = new QuizClass();
        $quizzes = $quizClass->getAllQuiz();
        return view('quiz-list', compact('quizzes'));
    }
    public function deleteQuiz($id)
    {
        $quizClass = new QuizClass();
        $quizClass->deleteQuiz($id);
        return redirect()->back()->with('success', 'Quiz and associated questions deleted successfully.');
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::find($id);
        $questions = Questions::where('quiz_id', $id)->get();

        return view('edit-quiz', compact('quiz', 'questions'));
    }
    public function updateQuiz(Request $request, $quizId)
    {
        $deletedIds = json_decode($request->input('deleted_ids'));

        try {
            $quizClass = new QuizClass();
            $quizClass->updateQuiz($request, $quizId, $deletedIds);
            return redirect('/admin/getquiz');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating quiz and questions'], 500);
        }
    }
    public function startQuiz($id)
    {
        $quiz = Quiz::find($id);
        $questions = Questions::where('quiz_id', $id)->get();
        return view('quiz-start', compact('questions', 'quiz'));
    }
    public function submitQuiz(Request $request)
    {

        $quizId = $request->input('quiz_id');

        $questions = Questions::where('quiz_id', $quizId)->get();
        $this->reportsClass->createReport($request, $quizId);

        $userAnswers = $request->input('answers');
        $score = 0;
        $feedback = [];

        foreach ($questions as $question) {
            $questionId = $question->question_id;
            $correctAnswer = $question->correct_answer;
            $isCorrect = $userAnswers[$questionId] == $correctAnswer;

            $feedback[$questionId] = [
                'is_correct' => $isCorrect,
                'correct_answer' => $question->correct_answer,
            ];

            if ($isCorrect) {
                $score++;
            }
        }
        return view('quiz-result', [
            'questions' => $questions,
            'userAnswers' => $userAnswers,
            'feedback' => $feedback,
            'score' => $score,
        ]);
    }
}

<?php

namespace App\Classes;

use App\Interfaces\QuizInterface;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Questions;



class QuizClass implements QuizInterface
{

    protected $request;
    protected $user;
    protected $quiz;
    protected $question;


    public function __construct(Request $request = null)
    {
        $this->request = $request;
        $this->quiz = new Quiz();
        $this->question = new Questions();
    }
    public function createQuiz()
    {
        $this->quiz->quiz_title = $this->request->input('title');
        $this->quiz->status = 1;
        $this->quiz->save();
        $quizId = $this->quiz->quiz_id;
        $questions = $this->request->input('questions');
        foreach ($questions as $questionData) {
            $this->question->quiz_id = $quizId;
            $this->question->question_title = $questionData['question'];
            $this->question->options = json_encode($questionData['options']);
            $this->question->correct_answer = $questionData['correct_answer'];
            $this->question->status = 1;
            $this->question->save();
        }
    }
    public function updateQuiz($request, $quizId, $deletedIds)
    {
        if (!empty($deletedIds)) {
            Questions::whereIn('question_id', $deletedIds)->delete();
        }

        $quiz = Quiz::find($quizId);
        $quiz->quiz_title = $request->input('title');
        $quiz->status = $request->input('quiz_status');
        $quiz->save();


        foreach ($request->input('questions') as $questionData) {
            $questionId = $questionData['question_id'];
            $question = Questions::find($questionId);

            if ($question) {

                $question->question_title = $questionData['question'];
                $question->options = json_encode($questionData['options']);
                $question->correct_answer = $questionData['correct_answer'];
                $question->status = $questionData['status'];
                $question->save();
            } else {
                $question = new Questions;
                $question->quiz_id = $quizId;
                $question->question_title = $questionData['question'];
                $question->options = json_encode($questionData['options']);
                $question->correct_answer = $questionData['correct_answer'];
                $question->status = 1;
                $question->save();
            }
        }
    }
    public function deleteQuiz($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'Quiz not found.');
        }


        $questions = Questions::where('quiz_id', $id)->get();
        foreach ($questions as $question) {
            $question->delete();
        }

        $quiz->delete();
    }
    public function getQuiz($quizId)
    {
        $this->quiz->getQuizWithQuestions($quizId);
        $formattedData = [
            'title' => $this->quiz->quiz_title,
            'questions' => $this->quiz->questions->map(function ($question) {
                return [
                    'question' => $question->question_title,
                    'options' => json_decode($question->options),
                    'correct_answer' => $question->correct_answer,
                ];
            })->toArray(),
        ];
        return $formattedData;
    }
    public function getAllQuiz()
    {
        $result = $this->quiz->getAllQuiz();
        return $result;
    }
}

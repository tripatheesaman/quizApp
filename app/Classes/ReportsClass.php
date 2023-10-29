<?php

namespace App\Classes;

use App\Interfaces\ReportsInterface;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Quiz;
use App\Models\Questions;
use App\Models\User;


class ReportsClass implements ReportsInterface
{
    protected $reports;
    protected $user;
    protected $quizModel;
    public function __construct()
    {
        $this->reports = new Reports();
        $this->quizModel = new Quiz();
        $this->user = new User();
    }
    public function createReport(Request $request, $quizId)
    {
        $data = array();
        $data['quiz_id'] = $quizId; //1
        $quiz = $this->quizModel->getQuizWithQuestions($quizId);
        $quiz = $quiz->toArray();
        $questions = Questions::where('quiz_id', $quizId)->get();
        $userAnswers = $request->input('answers');
        $userId = session()->get('user_id');
        $currentUser = User::where('user_id', $userId)->get();
        $currentUser = $currentUser->toArray();
        $currentUser = $currentUser[0];
        $data['user_id'] = $currentUser['user_id'];
        $data['user_type'] = $currentUser['user_type'];
        $data['user_name'] = $currentUser['first_name'] . " " . $currentUser['last_name']; // 2
        $data['quiz_title'] = $quiz['quiz_title'];
        $score = 0;
        $i = 0;

        foreach ($questions as $question) {
            $options = json_decode($question->options);
            $data['question-answers'][$i]['question_id'] = $question->question_id;
            $data['question-answers'][$i]['question_title'] = $question->question_title;
            $data['question-answers'][$i]['correct_answer'] = $options[$question->correct_answer];
            $data['question-answers'][$i]['options'] = $options;
            $data['question-answers'][$i]['selected_answer'] = json_decode($question->options)[$userAnswers[$data['question-answers'][$i]['question_id']]];
            $isCorrect = $userAnswers[$data['question-answers'][$i]['question_id']] == $question->correct_answer;

            $data['question-answers'][$i]['isCorrect'] = [
                'is_correct' => $isCorrect,
                'correct_answer' => $options[$question->correct_answer],
            ];
            $i++;

            if ($isCorrect) {
                $score++;
            }
        }
        $data['score'] = $score . "/" . count($questions);
        $this->reports->createReport($data);
    }
    public function displayReportList()
    {
        $data = Reports::all();
        $data = json_decode($data, true);
        return $data;
    }
    public function getIndividualReport($reportId)
    {
        $report = Reports::where('report_id', $reportId)->get();
        $report = json_decode($report, true);
        return $report;
    }
}

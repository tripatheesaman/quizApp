<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;

class Quiz extends Model
{

    use HasFactory;
    protected $table = "quiz";
    protected $primaryKey = "quiz_id";
    protected $guarded = [];
    public function questions()
    {
        return $this->hasMany(Questions::class, "quiz_id", "quiz_id");
    }

    public function getQuizWithQuestions($quizId)
    {
        $quiz = Quiz::with('questions')->find($quizId);
        return $quiz;
    }
    public function getAllQuiz()
    {
        $quizzes = Quiz::all();
        return $quizzes;
    }
}

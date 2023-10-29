<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class Questions extends Model
{

    use HasFactory;
    protected $table = "questions";
    protected $primaryKey = "question_id";
    protected $guarded = [];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
    }
    public function getQuestionsById($id)
    {
        $question = Questions::find($id);
        return $question;
    }
}

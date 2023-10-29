<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $table = "reports";
    protected $primaryKey = "report_id";
    protected $report;
    protected $guarded = [];

    public function createReport($data)
    {
        $report = new Reports();
        $report->quiz_id = $data['quiz_id'];
        $report->quiz_title = $data['quiz_title'];
        $report->user_id = $data['user_id'];
        $data['user_type'] = $data['user_type'] == 0 ? "Admin" : "User";
        $report->user_type = $data['user_type'];
        $report->user_name = $data['user_name'];
        $report->score = $data['score'];
        $report->question_answers = json_encode($data['question-answers']);
        $report->save();
    }
}

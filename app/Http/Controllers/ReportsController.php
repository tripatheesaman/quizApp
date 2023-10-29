<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Classes\ReportsClass;

class ReportsController
{
    protected $reportsClass;
    public function __construct()
    {
        $this->reportsClass = new ReportsClass();
    }
    public function createReport(Request $request, $quizId)
    {
        $this->reportsClass->createReport($request, $quizId);
    }
    public function displayReportList()
    {
        $data = $this->reportsClass->displayReportList();

        return view('report-list', compact('data'));
    }
    public function individualReport($reportId)
    {
        $report = $this->reportsClass->getIndividualReport($reportId);
        return view('individual-report', compact('report'));
    }
}

<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\User;


interface ReportsInterface
{
    public function createReport(Request $request, $userId);
}

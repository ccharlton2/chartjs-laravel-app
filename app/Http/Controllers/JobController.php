<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest();

        $currentWorkloadChart = app()->chartjs
            ->name('currentWorkLoad')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Current Production Breakdown'])
            ->datasets([
                [
                    "label" => "Available Work Hours",
                    'backgroundColor' => ['#99FF99'],
                    'hoverBackgroundColor' => ['#89E589', '#36A2EB'],
                    'data' => [69, 59]
                ],
                [
                    "label" => "Assigned Work Hours",
                    'backgroundColor' => ['#FF6364', '#36A2EB'],
                    'data' => [65, 12]
                ]
            ])
            ->options([]);

        return view('jobs.index', compact('currentWorkloadChart'), [
            'jobs' => $jobs
        ]);
    }
}

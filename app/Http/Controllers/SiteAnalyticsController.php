<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class SiteAnalyticsController extends Controller
{
    /**
     * Displays information about the website user-base
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $selectedYear = ["year" => 2021])
    {
        // check if year value was passed
        if ($request->only('year')) {
            $selectedYear = $request->only('year');
        }

        $months = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];

        $users = User::select('id', 'date_joined')
            ->whereYear('date_joined', $selectedYear)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_joined)->format('m'); // grouping by years
            });

        $usermcount = [];

        // for each year count the number users
        foreach ($users as $year => $value) {
            $usermcount[(int)$year] = count($value);
        }

        // set user count to 0 for months that had no user sign-ups
        foreach ($months as $key => $value) {
            if (!array_key_exists($key, $usermcount)) {
                $usermcount[$key] = 0;
            }
        }

        $months = [];

        // sort by year ascending
        $usermcount = collect($usermcount)->sortKeys();

        // Create month labels for chart
        foreach ($usermcount as $key => $value) {
            array_push($months, DateTime::createFromFormat('!m', $key)->format('F'));
        }

        // charts start
        $userRegistrationChart = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($months)
            ->datasets([
                [
                    "label" => "New User Registrations",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => array_values($usermcount->toArray()),
                ],
            ])
            ->options([]);
        // charts end

        return view('charts.site-analysis', compact('userRegistrationChart'), ['year' => $selectedYear]);
    }
}

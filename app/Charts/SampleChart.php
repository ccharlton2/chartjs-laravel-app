<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Sport;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleChart extends BaseChart
{
    public ?string $name = 'my_chart';
    public ?string $routeName = 'my_chart';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $sports = DB::table('sports')->get();
        $labels = [];
        $count = [];
        foreach ($sports as $sport){
            array_push($labels,$sport->name);
        }
        $values = Sport::with('users')->get();
        foreach ($values as $item) {
            array_push($count,$item->users->count());
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $count);
    }
}

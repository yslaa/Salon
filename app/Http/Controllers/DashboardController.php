<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Charts\UserChart;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    private function getRandomColors($count)
    {
        $bgColors = [];

        for($i=0; $i<$count; $i++)
        {
            $bgColors[] = 'rgba('.rand(0,255).', '.rand(0,255).', '.rand(0,255).', 0.58)';
        }

        return $bgColors;
    }

    public function userRole()
    {
        $users = DB::table('users')
            ->select(DB::raw('count(*) as total, role'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->all();

        $UserChart = new UserChart;

        $dataset = $UserChart->labels(array_keys($users));

        $dataset= $UserChart->dataset('User Roles', 'pie', array_values($users));

        $dataset= $dataset->backgroundColor($this->getRandomColors(count($users)));

        $UserChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scaleBeginAtZero' =>true,
            'scales' => [
                'yAxes'=> [[
                    'display'=>true,
                    'type'=>'linear',
                    'ticks'=> [
                        'beginAtZero'=> true,
                        'autoSkip' => true,
                        'maxTicksLimit' => 10,
                        'stepSize' => 1,
                        'max' => 10
                    ]
                ]]
            ]
        ]);

        return view('dashboard.userRole',compact('UserChart'));
    }
}
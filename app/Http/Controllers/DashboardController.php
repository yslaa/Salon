<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Charts\UserChart;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function __construct(){
        $this->bgcolor = collect(['rgba(166, 8, 8, 0.56)','rgba(166, 160, 8, 0.58)', 'rgba(60, 8, 166, 0.58)',"rgba(166, 74, 8, 0.58)", "rgba(8, 102, 166, 0.58)", "rgba(8, 166, 105, 0.58)", "rgba(8, 42, 166, 0.58)", "rgba(8, 145, 166, 0.58)", "rgba(116, 8, 166, 0.58)", "#01FF70", "#85144b", "rgba(166, 89, 8, 0.58)", "rgba(8, 166, 97, 0.58)", "rgba(8, 166, 134, 0.58)", "rgba(8, 95, 166, 0.58)"]);
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

        $dataset= $dataset->backgroundColor($this->bgcolor);

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
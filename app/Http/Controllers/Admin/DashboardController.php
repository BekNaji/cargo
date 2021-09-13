<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Shippings by day',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Shipping',
            'group_by_field' => 'created_at',
            'group_by_field_format' => 'm-d-Y',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];

        $chart_options2 = [
            'chart_title' => 'Shippings by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Shipping',
            'group_by_field' => 'created_at',
            'group_by_field_format' => 'm-d-Y',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];

        $day = new LaravelChart($chart_options);
        $month = new LaravelChart($chart_options2);

        return view('admin.index',compact('day','month'));
    }
}

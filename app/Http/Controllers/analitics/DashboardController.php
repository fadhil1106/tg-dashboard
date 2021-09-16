<?php

namespace App\Http\Controllers\analitics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getAllChart()
    {
        $production = DB::table('production_cart')->select('*')->get();
        $breakdown = DB::table('breakdown_cart')->select('*')->get();
        $sales = DB::table('sales_cart')->select('*')->get();
        $data = [
            'production' => $production->pluck('value'),
            'breakdown' => $breakdown->pluck('value'),
            'sales' => $sales->pluck('value'),
            'label' => $production->pluck('label'),
            'labelType' => 'Bulan',
        ];
        return view('custom_statistic.dashboard_statistic')->with('data', $data);
    }

    public function getDailyProductionVsSales()
    {
        $totalDays = date('t', mktime(0, 0, 0, date('m'), 1, date('Y')));

        $production = DB::table('production_daily_cart')->select('*')->get();
        $sales = DB::table('sales_daily_cart')->select('*')->get();

        $data = [
            'production' => array(),
            'sales' => array(),
            'label' => array(),
            'labelType' => 'Tanggal',
        ];

        $indexProduction = 0;
        $indexSales = 0;

        for ($day = 1; $day <= $totalDays; $day++) {
            array_push($data['label'], $day);

            if (!empty($production)) {
                if ($production[$indexProduction]->label == $day) {
                    array_push($data['production'], $production[$indexProduction]->value);
                    $indexProduction++;
                } else {
                    array_push($data['production'], 0);
                }
            } else {
                array_push($data['production'], 0);
            }

            if (!empty($sales)) {
                if ($sales[$indexSales]->label == $day) {
                    array_push($data['sales'], $production[$indexSales]->value);
                    $indexSales++;
                } else {
                    array_push($data['sales'], 0);
                }
            } else {
                array_push($data['production'], 0);
            }

            if ($production->last()->label < $day) {
                break;
            }
        }
        return view('custom_statistic.chart_production_vs_sales_daily')->with('data', $data);
    }
}

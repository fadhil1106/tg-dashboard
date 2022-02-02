<?php

namespace App\Http\Controllers\analitics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class DashboardController extends Controller
{
    public function getAllChart()
    {
        $id = CRUDBooster::myId();
        if ($id == null) {
            abort(404);
        }

        $production = DB::table('master_production')
					->select(DB::raw('DATE_FORMAT(production_date, "%M-%Y") as label, sum(production_ti + production_tm) as value'))
					// ->where(DB::raw('DATE_FORMAT(production_date, "%m-%Y")'), '>', date('m-Y', strtotime('-12 month')))
					->groupBy(DB::raw('label'))
					->orderByDesc('production_date')
					->limit(12)
					->get();

				$sales = DB::table('master_sales')
					->select(DB::raw('DATE_FORMAT(sales_date, "%M %Y") as label, sum(sales_quantity_ti) as ti, sum(sales_quantity_tm) as tm, sum(sales_quantity_ti + sales_quantity_tm) as value'))
					->where(DB::raw('DATE_FORMAT(sales_date, "%Y%m")'), '>=', date('Ym',strtotime($production->last()->label)))
					->groupBy(DB::raw('label'))
					->orderByDesc('sales_date')
					->limit(12)
					->get();

        $breakdown = DB::table('master_breakdown')
					->select(DB::raw('DATE_FORMAT(breakdown_date, "%M %Y") as label, floor(breakdown_ti) as ti, floor(breakdown_tm) as tm, floor(breakdown_ti + breakdown_tm) as value'))
					->where(DB::raw('DATE_FORMAT(breakdown_date, "%Y%m")'), '>=', date('Ym',strtotime($production->last()->label)))
					->groupBy(DB::raw('label'))
					->orderByDesc('breakdown_date')
					->limit(12)
					->get();

        $data = [
            'production' => array_reverse($production->pluck('value')->toArray()),
            'breakdown' => array_reverse($breakdown->pluck('value')->toArray()),
            'sales' => array_reverse($sales->pluck('value')->toArray()),
            'label' => array_reverse($production->pluck('label')->toArray()),
            'labelType' => 'Bulan',
        ];
        return view('custom_statistic.dashboard_statistic')->with('data', $data);
    }

    public function getAllData()
    {
        $id = CRUDBooster::myId();
        if ($id == null) {
            abort(404);
        }

        $production = DB::table('master_production')
					->select(DB::raw('DATE_FORMAT(production_date, "%M-%Y") as label, sum(production_ti + production_tm) as value'))
					// ->where(DB::raw('DATE_FORMAT(production_date, "%m-%Y")'), '>', date('m-Y', strtotime('-12 month')))
					->groupBy(DB::raw('label'))
					->orderByDesc('production_date')
					->limit(12)
					->get();

				$breakdown = DB::table('master_breakdown')
					->select(DB::raw('DATE_FORMAT(breakdown_date, "%M %Y") as label, floor(breakdown_ti) as ti, floor(breakdown_tm) as tm, floor(breakdown_ti + breakdown_tm) as value'))
					->where(DB::raw('DATE_FORMAT(breakdown_date, "%Y%m")'), '>=', date('Ym',strtotime($production->last()->label)))
					->groupBy(DB::raw('label'))
					->orderByDesc('breakdown_date')
					->limit(12)
					->get();

				$sales = DB::table('master_sales')
					->select(DB::raw('DATE_FORMAT(sales_date, "%M %Y") as label, sum(sales_quantity_ti) as ti, sum(sales_quantity_tm) as tm, sum(sales_quantity_ti + sales_quantity_tm) as value'))
					->where(DB::raw('DATE_FORMAT(sales_date, "%Y%m")'), '>=', date('Ym',strtotime($production->last()->label)))
					->groupBy(DB::raw('label'))
					->orderByDesc('sales_date')
					->limit(12)
					->get();

        $label = [];
        if ($breakdown->count() > $sales->count()) {
            $label = array_reverse($breakdown->pluck('label')->toArray());
        }else{
            $label = array_reverse($sales->pluck('label')->toArray());
        }

        $data = [
            'production' => array_reverse($production->pluck('value')->toArray()),
            'breakdown' => array_reverse($breakdown->pluck('value')->toArray()),
            'sales' => array_reverse($sales->pluck('value')->toArray()),
            'label' => array_reverse($production->pluck('label')->toArray()),
            'labelType' => 'Bulan',
        ];
        return $data;
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

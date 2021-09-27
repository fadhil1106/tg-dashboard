<?php

namespace App\Http\Controllers\analitics;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class SalesVsBreakdownController extends Controller
{
    public function getMonthlyBreakdownVsSales()
    {
        $id = CRUDBooster::myId();
        if ($id == null) {
            abort(404);
        }

        $sales = DB::table('master_sales')
            ->select(DB::raw('monthname(sales_date) as label, sum(sales_quantity_ti) as ti, sum(sales_quantity_tm) as tm, sum(sales_quantity_ti + sales_quantity_tm) as total'))
            ->where(DB::raw('year(sales_date)'), date("Y"))
            ->groupBy(DB::raw('month(sales_date)'))
            ->orderByDesc('sales_date')
            ->get();

        $breakdown = DB::table('master_breakdown')
            ->select(DB::raw('monthname(breakdown_date) as label, floor(breakdown_ti) as ti, floor(breakdown_tm) as tm, floor(breakdown_ti + breakdown_tm) as total'))
            ->where(DB::raw('year(breakdown_date)'), date("Y"))
            ->groupBy(DB::raw('month(breakdown_date)'))
            ->orderByDesc('breakdown_date')
            ->get();

        // dd($breakdown);
        if (count($sales) > count($breakdown)) {
            $label = $sales;
        } else {
            $label = $breakdown;
        }
        $data = [
            'breakdown_ti' => $breakdown->pluck('ti'),
            'breakdown_tm' => $breakdown->pluck('tm'),
            'breakdown_total' => $breakdown->pluck('total'),
            'sales_ti' => $sales->pluck('ti'),
            'sales_tm' => $sales->pluck('tm'),
            'sales_total' => $sales->pluck('total'),
            'label' => $label->pluck('label'),
            'labelType' => 'Bulan',
        ];
        return view('custom_statistic.sale_vs_breakdown.cart_sale_vs_breakdown')->with('data', $data);
    }
}

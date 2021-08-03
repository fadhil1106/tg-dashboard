<?php

namespace App\Http\Controllers\analitics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesVsBreakdownController extends Controller
{
    public function getMonthlyBreakdownVsSales()
    {
        $sales = DB::table('sales_cart')->select('*')->get();
        $breakdown = DB::table('breakdown_cart')->select('*')->get();
        if (count($sales) > count($breakdown)) {
            $label = $sales;
        } else {
            $label = $breakdown;
        }
        $data = [
            'breakdown' => $breakdown->pluck('value'),
            'sales' => $sales->pluck('value'),
            'label' => $label->pluck('label'),
            'labelType' => 'Bulan',
        ];
        return view('custom_statistic.sale_vs_breakdown.cart_sale_vs_breakdown')->with('data', $data);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    if (DB::connection()->getDatabaseName()) {
        echo "conncted sucessfully to database " . DB::connection()->getDatabaseName();
    }
    return view('welcome');
});

Route::get('chart/productionvssales', function () {
    $production = DB::table('production_cart')->select('*')->get();
    $sales = DB::table('sales_cart')->select('*')->get();
    $salesIdr = DB::table('sales_cart_idr')->select('*')->get();
    $data = [
        'production' => $production->pluck('value'),
        'sales' => $sales->pluck('value'),
        'salesIdr' => $salesIdr->pluck('value'),
        'label' => $production->pluck('label'),
    ];
    return view('custom_statistic.custom_horizontal_table')->with('data', $data);
})->name('customchart.productionvssales');

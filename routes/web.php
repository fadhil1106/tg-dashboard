<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\analitics\DashboardController;
use App\Http\Controllers\analitics\SalesVsBreakdownController;

Route::get('/', function () {
    if (DB::connection()->getDatabaseName()) {
        echo "conncted sucessfully to database " . DB::connection()->getDatabaseName();
    }
    return view('welcome');
});

Route::get('chart/production-vs-sales', [DashboardController::class, 'getMonthlyProductionVsSales'])
    ->name('customchart.production.vs.sales');
Route::get('chart/production-vs-sales-daily', [DashboardController::class, 'getDailyProductionVsSales'])
    ->name('customchart.production.vs.sales.daily');
Route::get('chart/sales-vs-breakdown', [SalesVsBreakdownController::class, 'getMonthlyBreakdownVsSales'])
    ->name('customchart.breakdown.vs.sales');

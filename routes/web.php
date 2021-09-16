<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\analitics\DashboardController;
use App\Http\Controllers\analitics\ProductionVsSalesController;
use App\Http\Controllers\analitics\SalesVsBreakdownController;
use App\Http\Controllers\analitics\RitaseVsPopulationWorkmanController;

Route::get('/', function () {
    // if (DB::connection()->getDatabaseName()) {
    //     echo "conncted sucessfully to database " . DB::connection()->getDatabaseName();
    // }
    // return view('welcome');
    return redirect('/admin/login');
});

Route::get('chart/main-dashboard', [DashboardController::class, 'getAllChart'])
    ->name('customchart.main.dashboard');
Route::get('chart/production-vs-sales', [ProductionVsSalesController::class, 'getMonthlyProductionVsSales'])
    ->name('customchart.production.vs.sales');
Route::get('chart/production-vs-sales-daily', [ProductionVsSalesController::class, 'getDailyProductionVsSales'])
    ->name('customchart.production.vs.sales.daily');
Route::get('chart/sales-vs-breakdown', [SalesVsBreakdownController::class, 'getMonthlyBreakdownVsSales'])
    ->name('customchart.breakdown.vs.sales');
Route::get('chart/ritase-vs-population-workman', [RitaseVsPopulationWorkmanController::class, 'getMonthlyChart'])
    ->name('customchart.ritase.vs.population.workman');

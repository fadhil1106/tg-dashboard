<?php

namespace App\Http\Controllers\analitics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class RitaseVsPopulationWorkmanController extends Controller
{
    public function getMonthlyChart()
    {
        $id = CRUDBooster::myId();
        if ($id == null) {
            abort(404);
        }

        $ritase = DB::table('ritase_cart')->select('*')->get();
        $population = DB::table('population_cart')->select('*')->get();
        $workman = DB::table('workman_cart')->select('*')->get();

        if (count($ritase) > count($population)) {
            $label = $ritase;
        } else {
            $label = $population;
        }
        $data = [
            'population' => $population->pluck('value'),
            'ritase' => $ritase->pluck('value'),
            'workman' => $workman->pluck('value'),
            'label' => $label->pluck('label'),
            'labelType' => 'Bulan',
        ];
        return view('custom_statistic.ritase_vs_population_workman.chart_ritase_vs_population_workman')->with('data', $data);
    }
}

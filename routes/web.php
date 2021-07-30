<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    if (DB::connection()->getDatabaseName()) {
        echo "conncted sucessfully to database " . DB::connection()->getDatabaseName();
    }
    return view('welcome');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessClearanceController;
use App\Http\Controllers\BarangayController;

Route::get('/', function () {
    return redirect()->route('business-clearances.index');
});

Route::resource('business-clearances', BusinessClearanceController::class);
Route::resource('barangays', BarangayController::class);
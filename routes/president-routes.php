<?php

use App\Http\Controllers\President\FarmerController;
use App\Http\Controllers\President\FarmLandController;
use App\Http\Controllers\President\Reports\FarmerController as ReportsFarmerController;
use App\Http\Controllers\President\Reports\LandController;
use App\Http\Controllers\President\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('president')->middleware(['auth:web'])->group( function () {
    Route::resource('users', UserController::class);
    Route::resource('farmers', FarmerController::class);
    Route::resource('farms', FarmLandController::class);

    Route::prefix('reports')->group( function () {
        Route::resource('lands', LandController::class);
        Route::resource('farmers', ReportsFarmerController::class);
    });
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\President\UserController;
use App\Http\Controllers\President\FarmerController;
use App\Http\Controllers\President\FarmLandController;
use App\Http\Controllers\President\ConsultationController;
use App\Http\Controllers\President\GeographicController;
use App\Http\Controllers\President\Reports\LandController;
use App\Http\Controllers\President\Reports\FarmerController as ReportsFarmerController;

Route::prefix('president')->middleware(['auth:web'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('farmers', FarmerController::class);
    Route::resource('farms', FarmLandController::class);
    Route::resource('consultations', ConsultationController::class);
    Route::resource('geographics', GeographicController::class);

    Route::prefix('reports')->group(function () {
        Route::resource('lands', LandController::class);
        Route::resource('farmers', ReportsFarmerController::class);
    });
});

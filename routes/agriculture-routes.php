<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agriculturist\UserController;
use App\Http\Controllers\Reports\AvailableLandController;
use App\Http\Controllers\Agriculturist\GeographicController;
use App\Http\Controllers\Agriculturist\ConsultationController;
use App\Http\Controllers\Reports\ConsultationController as ConsultationReport;

Route::prefix('agriculturist')->middleware(['auth:web'])->group(function () {
    Route::resource('consultations', ConsultationController::class);
    Route::resource('geographics', GeographicController::class);
    Route::resource('users', UserController::class);

    Route::prefix('reports')->group( function () {
        Route::resource('available-lands', AvailableLandController::class);
        Route::resource('report-consultations', ConsultationReport::class);
    });
});

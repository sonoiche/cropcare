<?php

use App\Http\Controllers\Admin\AgricultureController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PresidentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:web'])->group( function () {
    Route::resource('users', UserController::class);
    Route::resource('presidents', PresidentController::class);
    Route::resource('agricultures', AgricultureController::class);
    Route::resource('listings', ListingController::class);
    Route::resource('associations', AssociationController::class);
});
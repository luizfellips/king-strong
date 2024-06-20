<?php

use App\Http\Controllers\Api\CompoundController;
use App\Http\Controllers\Api\WorkoutController;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::group([
        'prefix' => 'compounds',
        'as' => 'compounds.',
    ], function () {
        Route::get('{compound}', [CompoundController::class, 'show'])->name('show');
    });

    Route::group([
        'prefix' => 'workoutsapi',
        'as' => 'workoutsapi.',
    ], function () {
        Route::get('/', [WorkoutController::class, 'index'])->name('index');
        Route::get('{workout}', [WorkoutController::class, 'show'])->name('show');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OneRepMaxController;
use App\Http\Middleware\OneRepMax\CheckCurrentLifterMiddleware;

Route::get('/', [HomeController::class, 'index'])->name('home');

/** One Rep Max */
Route::prefix('onerepmax')->name('onerepmax.')->group(function () {
    Route::get('/', [OneRepMaxController::class, 'step1'])->name('step1');
    Route::post('process-step-1', [OneRepMaxController::class, 'processStep1'])->name('processStep1');

    Route::middleware(CheckCurrentLifterMiddleware::class)->group(function () {
        Route::get('step2/{lifterSlug}', [OneRepMaxController::class, 'step2'])->name('step2');
        Route::get('step3/{lifterSlug}', [OneRepMaxController::class, 'step3'])->name('step3');
        Route::get('step4/{lifterSlug}/{compoundSlug}', [OneRepMaxController::class, 'step4'])->name('step4');
    });

    Route::get('finalstep/{lifterSlug}/{compoundSlug}', [OneRepMaxController::class, 'finalStep'])->name('finalStep');
    Route::post('process-step-2', [OneRepMaxController::class, 'processStep2'])->name('processStep2');
    Route::post('process-step-3', [OneRepMaxController::class, 'processStep3'])->name('processStep3');
    Route::post('process-step-4', [OneRepMaxController::class, 'processStep4'])->name('processStep4');
});

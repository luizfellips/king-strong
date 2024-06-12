<?php

use App\Http\Controllers\OneRepMaxController;
use Illuminate\Support\Facades\Route;

Route::prefix('onerepmax')->name('onerepmax.')->group(function() {
    Route::get('/', [OneRepMaxController::class, 'step1'])->name('step1');
    Route::post('physical-attributes', [OneRepMaxController::class, 'step2'])->name('step2');
    Route::post('exercises', [OneRepMaxController::class, 'step3'])->name('step3');
    Route::post('gather-informations', [OneRepMaxController::class, 'step4'])->name('step4');
    Route::post('results', [OneRepMaxController::class, 'process'])->name('process');
});

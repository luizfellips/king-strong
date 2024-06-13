<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OneRepMaxController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('onerepmax')->name('onerepmax.')->group(function() {
    Route::get('/', [OneRepMaxController::class, 'step1'])->name('step1');
    Route::post('physical-attributes', [OneRepMaxController::class, 'step2'])->name('step2');
    Route::post('exercises', [OneRepMaxController::class, 'step3'])->name('step3');
    Route::post('gather-informations', [OneRepMaxController::class, 'step4'])->name('step4');
    Route::post('results', [OneRepMaxController::class, 'process'])->name('process');
});

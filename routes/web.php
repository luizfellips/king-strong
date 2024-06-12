<?php

use App\Http\Controllers\PowerMarombaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PowerMarombaController::class, 'step1'])->name('step1');
Route::post('/physical-attributes', [PowerMarombaController::class, 'step2'])->name('step2');
Route::post('/exercise-informations', [PowerMarombaController::class, 'step3'])->name('step3');
Route::post('/calculator', [PowerMarombaController::class, 'step4'])->name('step4');
Route::post('/results', [PowerMarombaController::class, 'process'])->name('process');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompoundController;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::group([
        'prefix' => 'compounds',
        'as' => 'compounds.',
    ], function () {
        Route::get('{compound}', [CompoundController::class, 'show'])->name('show');
    });
});

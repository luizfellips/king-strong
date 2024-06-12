<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompoundController;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::apiResource('compounds', CompoundController::class);
});

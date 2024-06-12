<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompoundController;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::get('compounds', [CompoundController::class, 'index'])->name('compounds.index');
    Route::get('compounds/{compound}', [CompoundController::class, 'show'])->name('compounds.show');
});

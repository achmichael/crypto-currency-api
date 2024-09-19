<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return 'hello';
});

// Route::middleware('api')->group(function () {
//     Route::get('/exchanges', [ExchangeController::class, 'index']);
//     Route::get('/exchanges/{id}', [ExchangeController::class, 'show']);
//     Route::delete('/exchanges/{id}', [ExchangeController::class, 'destroy']);
//     Route::put('/exchanges/{id}', [ExchangeController::class, 'update']);
//     Route::get('/exchanges/{id}/tickers', [ExchangeController::class, 'tickers']);
// });
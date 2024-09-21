<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ExchangeDetailController;
use App\Http\Controllers\TickerController;

// Route::middleware('api')->group(function () {
//     Route::get('/items', [ItemController::class, 'index']);
//     Route::post('/items', [ItemController::class, 'store']);
//     Route::get('/items/{id}', [ItemController::class, 'show']);
//     Route::put('/items/{id}', [ItemController::class, 'update']);
//     Route::delete('/items/{id}', [ItemController::class, 'destroy']);
// });

// Route::middleware('api')->group(function () {
    Route::resource('/exchanges', ExchangeController::class);
// });

// Route::middleware('api')->group(function () {
    Route::resource('/exchanges/{id}/exchange-details', ExchangeDetailController::class);
// });

// Route::middleware('api')->group(function () {
    Route::resource('/exchange-tickers', TickerController::class);
// });

// Route::middleware('api')->prefix('/exchange-details')->group(function () {
//     Route::get('/', [ExchangeDetailController::class, 'index']);
//     Route::post('/', [ExchangeDetailController::class, 'store']);
//     Route::get('/{id}', [ExchangeDetailController::class, 'show']);
//     Route::put('/{id}', [ExchangeDetailController::class, 'update']);
//     Route::delete('/{id}', [ExchangeDetailController::class, 'destroy']);
// });

// Route::middleware('api')->prefix('/exchange-tickers')->group( function () {
//     Route::get('/', [TickerController::class, 'index']);
//     Route::post('/', [TickerController::class, 'store']);
//     Route::get('/{id}', [TickerController::class, 'show']);
//     Route::put('/{id}', [TickerController::class, 'update']);
//     Route::delete('/{id}', [TickerController::class, 'destroy']);
// });






<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\CardRegisterController;
use App\Http\Controllers\PosnetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prime', [PrimeController::class, 'checkPrime']);
Route::post('/card-register', [CardRegisterController::class, 'cardRegister']);
Route::post('/card-pay', [PosnetController::class, 'doPayment']);

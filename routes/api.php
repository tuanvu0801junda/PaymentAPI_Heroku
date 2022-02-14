<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PayParamController;
use App\Http\Controllers\PayBRRController;

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

Route::post('/ver2/onlinePay',[PayBRRController::class, 'onlinePay']);
Route::post('/onlinePay',[PayParamController::class, 'onlinePay']);
Route::post('/validate',[PaymentController::class, 'validateBeforePay']);

Route::post('/subtractNumber',[ProductController::class,'subtractNumber']);
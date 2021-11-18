<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::resource('web_configs', App\Http\Controllers\API\WebConfigAPIController::class);


Route::resource('special_instructions', App\Http\Controllers\API\SpecialInstructionAPIController::class);


Route::resource('items', App\Http\Controllers\API\ItemAPIController::class);


Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class);


Route::resource('users', App\Http\Controllers\API\UserAPIController::class);

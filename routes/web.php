<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('webConfigs', App\Http\Controllers\WebConfigController::class);


Route::resource('specialInstructions', App\Http\Controllers\SpecialInstructionController::class);


Route::resource('items', App\Http\Controllers\ItemController::class);


Route::resource('orders', App\Http\Controllers\OrderController::class);


Route::resource('users', App\Http\Controllers\UserController::class);

Route::get('/pdf/{id}', [App\Http\Controllers\OrderController::class, 'pdf'])->name('pdf');


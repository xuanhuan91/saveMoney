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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/income', [App\Http\Controllers\IncomeController::class, 'index'])->name('income');
Route::resource("income", \App\Http\Controllers\IncomeController::class);
Route::post('search',[App\Http\Controllers\IncomeController::class,'search'])->name('search');

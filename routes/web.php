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


Route::get('/report/month', [App\Http\Controllers\ReportController::class, 'reportByMonth'])->name('report-month');
Route::get('/report/week', [App\Http\Controllers\ReportController::class, 'reportByWeek'])->name('report-week');
//Route::get('/categoryExpense', 'CategoryExpenseController@index');

Route::get('/login', function (){return view('auth.login')->name('login');});
Route::get('/register',function (){return view('auth.register');})->name('register');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', \App\Http\Controllers\userController::class);
//Route::resource("CategoryExpense", App\Http\Controllers\categoryExpenseController::class);
//Route::get('/categoryExpense', 'App\Http\Controllers\CategoryExpenseController@index');
Route::resource("CategoryExpense", App\Http\Controllers\categoryExpenseController::class);
Route::resource("expense", App\Http\Controllers\ExpenseController::class);

Route::resource("income", \App\Http\Controllers\IncomeController::class);
Route::post('search',[App\Http\Controllers\IncomeController::class,'search'])->name('search');


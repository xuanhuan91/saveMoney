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

Route::get('/login', function (){return view('auth.login')->name('login');});
Route::get('/register',function (){return view('auth.register');})->name('register');

Auth::routes();

Route::get('/', [App\Http\Controllers\dashboardController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\dashboardController::class, 'index']);

Route::resource('user', \App\Http\Controllers\userController::class);
Route::resource("CategoryExpense", App\Http\Controllers\categoryExpenseController::class);
Route::resource("CategoryIncome",App\Http\Controllers\categoryIncomeController::class);
Route::put('CategoryIncome/{id}','categoryIncomecontroller@update')->name('CategoryIncome.update');
Route::get('getIncome/{id}', [\App\Http\Controllers\CategoryIncomeController::class, 'getIncomeTest']);
Route::resource("expense", App\Http\Controllers\ExpenseController::class);
Route::resource("dashboard", App\Http\Controllers\dashboardController::class);
Route::resource("expenseLimit", App\Http\Controllers\ExpenseLimitController::class);
Route::get('checkStartDate',[App\Http\Controllers\ExpenseLimitController::class,'checkStartDate'])->name('checkStartDate');



Route::resource("income", \App\Http\Controllers\IncomeController::class);
Route::post('search',[App\Http\Controllers\IncomeController::class,'search'])->name('search');


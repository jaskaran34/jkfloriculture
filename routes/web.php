<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/eticket', [App\Http\Controllers\EticketController::class, 'index'])->name('eticket');

Route::post('/division/view', [App\Http\Controllers\DivisionController::class, 'view_records'])->name('division_view');
Route::post('/division', [App\Http\Controllers\DivisionController::class, 'index'])->name('division');
Route::delete('/division/delete', [App\Http\Controllers\DivisionController::class, 'delete'])->name('division_delete');


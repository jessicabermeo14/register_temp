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

Route::get('/home', [App\Http\Controllers\VisitorController::class, 'home'])->name('visitantes.home')->middleware(middleware: 'auth');
//Route::get('/principal', [VisitorController::class, 'home'])->name('visitantes.home')->middleware(middleware: 'auth');
Route::post('/visitantes/search', [App\Http\Controllers\VisitorController::class, 'search'])->name('visitantes.search')->middleware(middleware: 'auth');
Route::resource('visitantes', '\App\Http\Controllers\VisitorController')->middleware(middleware: 'auth');
Route::resource('registros', '\App\Http\Controllers\RecordController')->middleware(middleware: 'auth');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

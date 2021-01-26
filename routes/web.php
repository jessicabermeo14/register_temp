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

Route::get('/home', function () {
    return view('home');
})->middleware(middleware: 'auth');

//Route::get('/home', [VisitorController::class, 'home'])->name('visitantes.home')->middleware(middleware: 'auth');
//Route::get('/principal', [VisitorController::class, 'home'])->name('visitantes.home');
Route::post('/visitantes/search', [VisitorController::class, 'search'])->name('visitantes.search');
Route::resource('visitantes', '\App\Http\Controllers\VisitorController');
Route::resource('registros', '\App\Http\Controllers\RecordController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

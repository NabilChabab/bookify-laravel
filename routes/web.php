<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('/home',HomeController::class)->names('home');
Route::resource('/dashboard',UserController::class)->names('dashboard');
Route::resource('/books',BooksController::class)->names('books');
Route::resource('/reservations',ReservationsController::class)->names('reservations');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
Route::resource('home', ReservationsController::class);
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/dashboard', UserController::class)->names('dashboard');
    Route::resource('/books', BooksController::class)->names('books');
    Route::resource('/reservations', DashboardController::class)->names('reservations');
});


Route::get('logout', [LoginController::class, 'logout']);



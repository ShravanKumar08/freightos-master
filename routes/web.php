<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
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

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('bookings',[BookingController::class,'index']);
Route::post('bookings',[BookingController::class,'store']);
Route::get('booking_options',[BookingController::class,'options']);
Route::get('cancellation',[BookingController::class,'cancellation']);
// Route::resource('bookings', BookingController::class);

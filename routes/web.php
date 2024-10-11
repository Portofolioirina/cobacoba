<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
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

//Route::get('/', [HomeController::class, 'index'])->name('index');
//Route::post('/',[HomeController::class, 'store']);

//Route::get('/guest/{id}/{serial_number?}',[HomeController::class, 'getGuest'])->name('guest-detail');

//Route::get('/', function(){
//    return view('welcome');
//});
Route::get('/', function(){
    return view('home');
})->name('home');

Route::resource('/guest', GuestController::class);

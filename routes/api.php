<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthenticateController::class, 'login'])->middleware('cors')->name('login');
Route::get('/get-email', [AuthenticateController::class, 'getEmail'])->name('getEmail');
Route::get('/get-all', [AuthenticateController::class, 'getAllUser'])->name('getAllUser');
// Route::get('/userinfo', [AuthenticateController::class, 'getUserInfo'])->name('userinfo');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment');

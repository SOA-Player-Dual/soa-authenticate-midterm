<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionHistoryController;

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
Route::get('/get-user', [AuthenticateController::class, 'getUser'])->name('getUser');
Route::get('/get-surplus', [AuthenticateController::class, 'getSurplus']);
// Route::get('/userinfo', [AuthenticateController::class, 'getUserInfo'])->name('userinfo');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment');

//get all transaction history
Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction-history');

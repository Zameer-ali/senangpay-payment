<?php

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


use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'checkout']);
Route::get('/callback', [TransactionController::class, 'callback']);

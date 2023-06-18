<?php

use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;

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

// Route::resource('/items', ItemController::class)->middleware('auth');

Route::resource('items', ItemController::class);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/transactionHistory', [TransactionController::class, 'showTransactionHistory'])->middleware('auth');


Route::post('/transaction/addcart/{item}', [TransactionController::class, 'addCart'])->middleware('auth');
Route::post('/transaction/ordernow/{item}', [TransactionController::class, 'orderNow'])->middleware('auth');
Route::get('/transaction/indexcart', [TransactionController::class, 'indexCart'])->middleware('auth');
Route::get('/transaction/checkout/{transaction}', [TransactionController::class, 'checkout'])->middleware('auth');
Route::post('/transaction/deletecart/{transactionDetail}', [TransactionController::class, 'deleteCart'])->middleware('auth');

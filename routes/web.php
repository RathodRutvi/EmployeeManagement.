<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookContoller;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/cart/{bookId}',[HomeController::class,'addToCart'])->name('cart.add');
    Route::get('/cart', [HomeController::class,'showCart'])->name('cart.show');
    
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [BookContoller::class, 'index'])->name('admin.home');
    Route::get('/admin/delete/{id}', [BookContoller::class, 'delete'])->name('book.delete');
    Route::resource('book',BookContoller::class);
});
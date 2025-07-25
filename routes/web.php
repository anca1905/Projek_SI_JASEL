<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use Faker\Guesser\Name;
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

// -- Auth --
Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('login/proses', [LoginController::class, 'proses'])->name('login.proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'authrole:admin'], 'as' => 'admin'], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('user', UsersController::class);
});

Route::group(['prefix' => 'teknisi', 'middleware' => ['auth', 'authrole:teknisi'], 'as' => 'teknisi'], function () {
    Route::get('dashboard', [ServicesController::class, 'index'])->name('service.index');
});


Route::view('daftar_pesanan', 'daftar');
Route::view('pelanggan', 'pelanggan.index')->name('pelanggan.index');
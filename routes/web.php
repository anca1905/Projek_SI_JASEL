<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\KelolaJasaController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\teknisi\ServicesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\costumer\CostumerController;

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

// Authentication Routes
Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'proses'])->name('auth.proses');
Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'store'])->name('auth.register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

// Admin Routes
Route::middleware(['auth', 'authrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.show');

    // User Management
    Route::resource('user', UsersController::class)->names([
        'index' => 'adminuser.index',
        'create' => 'adminuser.create',
        'store' => 'adminuser.store',
        'show' => 'adminuser.show',
        'edit' => 'adminuser.edit',
        'update' => 'adminuser.update',
        'destroy' => 'adminuser.destroy',
    ]);

    // Service Management
    Route::resource('kelola_jasa', KelolaJasaController::class)->names([
        'index' => 'adminkelola_jasa.index',
        'create' => 'adminkelola_jasa.create',
        'store' => 'adminkelola_jasa.store',
        'show' => 'adminkelola_jasa.show',
        'edit' => 'adminkelola_jasa.edit',
        'update' => 'adminkelola_jasa.update',
        'destroy' => 'adminkelola_jasa.destroy',
    ]);

    // Report Routes
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', [ReportController::class, 'report'])->name('index');
        Route::get('/orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        Route::get('/technicians', [ReportController::class, 'technicians'])->name('technicians');
        Route::get('/popular-services', [ReportController::class, 'popularServices'])->name('popular_services');
    });
});

// Teknisi Routes
Route::middleware(['auth', 'authrole:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('/incoming-orders', [ServicesController::class, 'incomingOrders'])->name('incoming_orders');
    Route::get('/my-orders', [ServicesController::class, 'myOrders'])->name('my_orders');
    Route::get('/show/{id}', [ServicesController::class, 'show'])->name('show');
    Route::get('/take/{id}', [ServicesController::class, 'takeOrder'])->name('take');
});

// Pelanggan Routes (Contoh, sesuaikan jika sudah ada)
Route::middleware(['auth', 'authrole:pelanggan'])->prefix('costumer')->name('costumer.')->group(function () {
    Route::get('/make_an_order', [CostumerController::class, 'index'])->name('make_an_order');
    Route::post('/make_an_order', [CostumerController::class, 'store'])->name('store_order');
    Route::get('/order_history', [CostumerController::class, 'orderHistory'])->name('order_history');
    Route::get('/order_detail/{id}', [CostumerController::class, 'show'])->name('order_detail');
});
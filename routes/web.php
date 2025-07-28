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
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

// Admin Routes
Route::middleware(['auth', 'authrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

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
        Route::get('/', [ReportController::class, 'index'])->name('index');
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
    // Tambahkan route untuk aksi "Ambil Pesanan", "Selesai", "Batalkan", "Detail" jika diperlukan
    // Route::post('/orders/{order}/take', [ServicesController::class, 'takeOrder'])->name('take_order');
    // Route::post('/orders/{order}/complete', [ServicesController::class, 'completeOrder'])->name('complete_order');
    // Route::post('/orders/{order}/cancel', [ServicesController::class, 'cancelOrder'])->name('cancel_order');
    // Route::get('/orders/{order}/detail', [ServicesController::class, 'orderDetail'])->name('order_detail');
});

// Pelanggan Routes (Contoh, sesuaikan jika sudah ada)
Route::middleware(['auth', 'authrole:pelanggan'])->prefix('costumer')->name('costumer.')->group(function () {
    Route::get('/make-an-order', [CostumerController::class, 'index'])->name('make_an_order');
    Route::get('/order-history', [CostumerController::class, 'orderHistory'])->name('order_history');
    // Tambahkan route untuk aksi "Buat Pesanan" jika diperlukan
    // Route::get('/buat-pesanan', [PelangganController::class, 'createOrder'])->name('create_order');
    // Route::get('/riwayat-pesanan', [PelangganController::class, 'orderHistory'])->name('order_history');
});
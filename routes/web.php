<?php

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


/**
 * Route Guest
 */

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login.proses');
});


/**
 * Route Auth
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::redirect('/', 'dashboard');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    
    /**
     * 
     * Admin
     * 
     */
    Route::group(['middleware' => 'thisAdmin'], function () {
        // Dashboard

        Route::post('logs/filter', [\App\Http\Controllers\LogController::class, 'filter'])->name('logs.filter');

        Route::prefix('user')->group(function () {
            Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('user');
            Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
            Route::get('{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::put('{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
            Route::delete('{user}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
        });

        Route::prefix('kelola')->name('kelola.')->group(function(){
            Route::get('laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
        });
    });

    /**
     * End Admin
     */

    /**
     * 
     * Staff Gudang
     */
    Route::group(['middleware' => 'thisGudang'], function () {
        // Gudang
        Route::prefix('gudang')->name('gudang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\GudangController::class, 'index'])->name('index');
        });
        // End Gudang

        // Barang
        Route::prefix('barang')->name('barang.')->group(function(){
            Route::post('store', [App\Http\Controllers\BarangController::class, 'store'])->name('store');
            Route::get('{barang}/edit', [App\Http\Controllers\BarangController::class, 'edit'])->name('edit');
            Route::put('{barang}/update', [App\Http\Controllers\BarangController::class, 'update'])->name('update');
            Route::delete('{barang}/delete', [App\Http\Controllers\BarangController::class, 'destroy'])->name('destroy');
        });
    });

    /**
     * End Staff Gudang
     */

    /**
     * 
     * Staff Kasir
     * 
     */
    Route::group(['middleware' => 'thisKasir'], function () {
        // Kasir
        Route::prefix('kasir')->name('kasir.')->group(function () {
            Route::get('/', [\App\Http\Controllers\KasirController::class, 'index'])->name('index');
        });

        Route::prefix('transaksi')->name('transaksi.')->group(function(){
            Route::post('store', [App\Http\Controllers\TransaksiController::class, 'store'])->name('store');
            Route::post('print', [App\Http\Controllers\TransaksiController::class, 'print'])->name('print');
            Route::post('keranjang', [App\Http\Controllers\TransaksiController::class, 'keranjang'])->name('keranjang');
            Route::delete('keranjang/{keranjang}/delete', [App\Http\Controllers\TransaksiController::class, 'keranjangDelete'])->name('keranjang.delete');
        });
        // End Kasir
    });
});

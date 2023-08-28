<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlokController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\HargaRefController;
use App\Http\Controllers\KaratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\KotakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

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

route::get('/', [LoginController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
route::post('auth/login', [LoginController::class, 'auth'])->name('auth.login');
route::get('auth/logout', [LoginController::class, 'logout'])->name('auth.logout');
route::get('login', [LoginController::class, 'index'])->name('login');


Route::prefix('store')->as('store.')->group(function () {
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori');
    Route::post('cabang', [CabangController::class, 'store'])->name('cabang');
    Route::post('user', [UserController::class, 'store'])->name('user');
    Route::post('supplier', [SupplierController::class, 'store'])->name('supplier');
    Route::post('member', [MemberController::class, 'store'])->name('member');
    Route::get('blok', [BlokController::class, 'store'])->name('blok');
    Route::post('kotak', [KotakController::class, 'store'])->name('kotak');
    Route::post('karat', [KaratController::class, 'store'])->name('karat');
    Route::post('harga_ref', [HargaRefController::class, 'store'])->name('harga_ref');
    Route::post('kondisi', [KondisiController::class, 'store'])->name('kondisi');
    Route::post('produk', [ProdukController::class, 'store'])->name('produk');
});

Route::prefix('update')->as('update.')->group(function () {
    Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori');
    Route::put('cabang/{cabang}', [CabangController::class, 'update'])->name('cabang');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user');
    Route::put('supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier');
    Route::put('member/{member}', [MemberController::class, 'update'])->name('member');
    Route::put('blok/{blok}', [BlokController::class, 'update'])->name('blok');
    Route::put('kotak/{kotak}', [KotakController::class, 'update'])->name('kotak');
    Route::put('karat/{karat}', [KaratController::class, 'update'])->name('karat');
    Route::put('harga_ref/{harga_ref}', [HargaRefController::class, 'update'])->name('harga_ref');
    Route::get('harga_ref/status/{harga_ref}', [HargaRefController::class, 'updateStatus'])->name('harga_ref.status');
    Route::put('kondisi/{kondisi}', [KondisiController::class, 'update'])->name('kondisi');
    Route::put('produk/{produk}', [ProdukController::class, 'update'])->name('produk');
});

Route::prefix('delete')->as('destroy.')->group(function () {
    Route::get('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori');
    Route::get('cabang/{cabang}', [CabangController::class, 'destroy'])->name('cabang');
    Route::get('user/{user}', [UserController::class, 'destroy'])->name('user');
    Route::get('supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier');
    Route::get('member/{member}', [MemberController::class, 'destroy'])->name('member');
    Route::get('blok/{blok}', [BlokController::class, 'destroy'])->name('blok');
    Route::get('kotak/{kotak}', [KotakController::class, 'destroy'])->name('kotak');
    Route::get('karat/{karat}', [KaratController::class, 'destroy'])->name('karat');
    Route::get('harga_ref/{harga_ref}', [HargaRefController::class, 'destroy'])->name('harga_ref');
    Route::get('kondisi/{kondisi}', [KondisiController::class, 'destroy'])->name('kondisi');
    Route::get('produk/{produk}', [ProdukController::class, 'destroy'])->name('produk');
});

Route::prefix('produk')->as('produk.')->middleware(['auth', 'role:1'])->group(function () {
    route::get('tambah', [ProdukController::class, 'index'])->name('tambah');
});

Route::prefix('master-data')->as('master-data.')->middleware(['auth', 'role:1'])->group(function () {

    route::get('user', [UserController::class, 'index'])->name('user.index');
    route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');

    route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    route::get('supplier/edit/{supplier}', [SupplierController::class, 'edit'])->name('supplier.edit');

    route::get('member', [MemberController::class, 'index'])->name('member.index');
    route::get('member/edit/{member}', [MemberController::class, 'edit'])->name('member.edit');

    route::get('cabang', [CabangController::class, 'index'])->name('cabang.index');
    route::get('cabang/edit/{cabang}', [CabangController::class, 'edit'])->name('cabang.edit');

    Route::prefix('barang')->as('barang.')->group(function () {

        route::get('blok', [BlokController::class, 'index'])->name('blok.index');
        route::get('blok/edit/{blok}', [BlokController::class, 'edit'])->name('blok.edit');

        route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
        route::get('kategori/edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');

        route::get('kotak', [KotakController::class, 'index'])->name('kotak.index');
        route::get('kotak/detail/{kategoriId}', [KotakController::class, 'show'])->name('kotak.detail');
        route::get('kotak/edit/{kategori}/{kotak}', [KotakController::class, 'edit'])->name('kotak.edit');

        route::get('karat', [KaratController::class, 'index'])->name('karat.index');
        route::get('karat/edit/{karat}', [KaratController::class, 'edit'])->name('karat.edit');
        route::get('karat/detail/harga/{karat}', [KaratController::class, 'show'])->name('karat.detail');

        route::get('kondisi', [KondisiController::class, 'index'])->name('kondisi.index');
        route::get('kondisi/edit/{kondisi}', [KondisiController::class, 'edit'])->name('kondisi.edit');
    });
});

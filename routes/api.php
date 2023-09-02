<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('model/{kategori}/{search?}', [ApiController::class, 'searchModel'])->middleware(['auth:web', 'role:1'])->name('searchModel');
Route::get('kotak/{kategori}/{search?}', [ApiController::class, 'searchKotak'])->middleware(['auth:web', 'role:1'])->name('searchKotak');
Route::get('produk/{kodeProduk}', [ApiController::class, 'searchProduk'])->middleware(['auth:web', 'role:1'])->name('searchProduk');
Route::get('member/{member}', [ApiController::class, 'searchMember'])->middleware(['auth:web', 'role:1'])->name('searchMember');

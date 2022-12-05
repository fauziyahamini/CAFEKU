<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;

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


//Routing bagian fitur admin&owner
Route::middleware(['auth'])->group(function () {

// Routing halaman beranda
Route::get('/', [BerandaController::class, 'index']);
Route::resource('beranda',BerandaController::class);

// Routing halaman dashboard
Route::resource('dashboard', DashboardController::class);

// Routing halaman kategori
Route::resource('kategori',KategoriController::class);
Route::get('kategori/delete/{id}', [KategoriController::class, 'destroy']);

// Routing halaman menu
Route::resource('menu',MenuController::class);
Route::get('menu/delete/{id}', [MenuController::class, 'destroy']);
});

// Routing bagian fitur owner saja
Route::middleware(['auth', 'Owner'])->group(function () {

// Routing halaman user
Route::resource('user',UserController::class);
Route::get('user/delete/{id}', [UserController::class, 'destroy']);

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

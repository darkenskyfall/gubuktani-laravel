<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginAdminController;
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


Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout',[AuthController::class, 'logout'])->name('login.logout');

Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'createRegister'])->name('register.create');

Route::prefix('ads')->group(function () {
    Route::get('/list',[AdsController::class, 'index'])->name('ads');    
    Route::get('/create',[AdsController::class, 'create'])->name('ads.create');
    Route::post('/create',[AdsController::class, 'store'])->name('ads.store');
    Route::get('/detail/{id}',[AdsController::class, 'show'])->name('ads.show'); 
});

Route::middleware(['web'])->group(function () {
    Route::get('/admin',[DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/admin/logout',[LoginAdminController::class, 'logout'])->name('logout'); 
});

////

Route::get('/admin/login',[LoginAdminController::class, 'index'])->name('admin.login'); 
Route::post('/admin/login',[LoginAdminController::class, 'authenticate'])->name('admin.authenticate'); 

Route::middleware(['admin'])->group(function () {
    Route::get('/admin',[DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/admin/logout',[LoginAdminController::class, 'logout'])->name('logout'); 
});
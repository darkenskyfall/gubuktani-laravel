<?php

use App\Http\Controllers\AdsAdminController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
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

Route::get('/admin/login',[LoginAdminController::class, 'index'])->name('admin.login'); 
Route::post('/admin/login',[LoginAdminController::class, 'authenticate'])->name('admin.authenticate'); 

Route::middleware(['admin'])->group(function () {
    Route::get('/admin',[DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/admin/logout',[LoginAdminController::class, 'logout'])->name('logout'); 

    Route::get('/admin/kategori',[CategoryController::class, 'index'])->name('category');
    Route::get('/admin/kategori/tambah',[CategoryController::class, 'create'])->name('category.create'); 
    Route::post('/admin/kategori/tambah',[CategoryController::class, 'store'])->name('category.store'); 
    Route::get('/admin/kategori/{id}',[CategoryController::class, 'show'])->name('category.show'); 
    Route::get('/admin/kategori/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit'); 
    Route::post('/admin/kategori/edit/{id}',[CategoryController::class, 'update'])->name('category.update');
    Route::post('/admin/kategori/hapus/{id}',[CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('/admin/iklan',[AdsAdminController::class, 'index'])->name('ads.admin');
    Route::get('/admin/iklan/{id}',[AdsAdminController::class, 'show'])->name('ads.admin.detail');
    Route::post('/admin/iklan/edit/{id}',[AdsAdminController::class, 'update'])->name('ads.admin.update');
    Route::post('/admin/iklan/hapus/{id}',[AdsAdminController::class, 'destroy'])->name('ads.admin.delete');

    Route::get('/admin/pemilik',[CustomerController::class, 'index'])->name('customer');
    Route::get('/admin/pemilik/{id}',[CustomerController::class, 'show'])->name('customer.show'); 
    Route::post('/admin/pemilik/hapus/{id}',[CustomerController::class, 'destroy'])->name('customer.delete');

});
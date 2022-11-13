<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdsAdminController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackControler;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentController;
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


Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'createRegister'])->name('register.create');

Route::get('lupa-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('lupa-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/kebijakan-privasi', function () {
    return view('ui.policy');
})->name('policy');

Route::get('/bantuan', function () {
    return view('ui.help');
})->name('help');

Route::get('/kontak',[FeedbackControler::class, 'contact'])->name('contact');
Route::post('/kontak',[FeedbackControler::class, 'store'])->name('contact.store');

Route::prefix('ads')->group(function () {
    Route::get('/cari',[AdsController::class, 'search'])->name('ads.search');    
    Route::get('/list',[AdsController::class, 'index'])->name('ads');    
    Route::get('/create',[AdsController::class, 'create'])->name('ads.create');
    Route::post('/create',[AdsController::class, 'store'])->name('ads.store');
    Route::get('/detail/{id}',[AdsController::class, 'show'])->name('ads.show'); 
});

Route::middleware(['web'])->group(function () {
    Route::prefix('ads')->group(function () {
        Route::get('/create',[AdsController::class, 'create'])->name('ads.create');
        Route::post('/create',[AdsController::class, 'store'])->name('ads.store');
        Route::get('/edit/{id}',[AdsController::class, 'edit'])->name('ads.edit');
        Route::post('/update/{id}',[AdsController::class, 'update'])->name('ads.update');
        Route::post('/wishlist/{id}',[AdsController::class, 'updateWishlist'])->name('ads.update.wishlist');
        Route::post('/booking/{id}',[AdsController::class, 'updateBooking'])->name('ads.update.booking');
    });
    Route::get('/profil',[ProfileController::class, 'index'])->name('profile');
    Route::prefix('profil')->group(function () {
        Route::get('/edit/{id}',[ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/edit/{id}',[ProfileController::class, 'update'])->name('profile.update');
        Route::get('/ganti-password/{id}',[ProfileController::class, 'changePassword'])->name('profile.change.password');
        Route::post('/ganti-password/{id}',[ProfileController::class, 'updatePassword'])->name('profile.change.password.update');
        Route::post('/booking/{id}',[ProfileController::class, 'updateBooking'])->name('profile.update.booking');
        Route::post('/wishlist/{id}',[ProfileController::class, 'updateWishlist'])->name('profile.update.wishlist');
    });
    Route::prefix('sewa')->group(function () {
        Route::get('/form/{id}',[RentController::class, 'form'])->name('rent'); 
        Route::post('/form/{id}',[RentController::class, 'store'])->name('rent.store'); 
        Route::get('/detail/{id}',[RentController::class, 'show'])->name('rent.show'); 
        Route::get('/detail/ads/{id}',[RentController::class, 'showFromAdsDetail'])->name('rent.show.fromAds'); 
        Route::post('/update/{id}',[RentController::class, 'update'])->name('rent.update'); 
    });
    Route::post('/hapus/{id}',[AdsController::class, 'destroy'])->name('ads.delete');
    Route::get('/logout',[AuthController::class, 'logout'])->name('login.logout');
});

Route::get('/admin/login',[LoginAdminController::class, 'index'])->name('admin.login'); 
Route::post('/admin/login',[LoginAdminController::class, 'authenticate'])->name('admin.authenticate'); 

Route::middleware(['admin'])->group(function () {
    Route::get('/admin',[DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/admin/logout',[LoginAdminController::class, 'logout'])->name('logout'); 

    Route::get('/admin/admin',[AdminController::class, 'index'])->name('admin.list');
    Route::get('/admin/admin/tambah',[AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/admin/tambah',[AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/admin/edit/{id}',[AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/admin/edit/{id}',[AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/admin/hapus/{id}',[AdminController::class, 'destroy'])->name('admin.delete');

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

    Route::get('/admin/umpan-balik',[FeedbackControler::class, 'index'])->name('feedback');

});
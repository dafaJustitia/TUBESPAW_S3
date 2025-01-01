<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Landing\HomeController as LandingHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Dashboard\RegionController;
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

Route::get('/', [LandingHomeController::class, 'index'])->name('landing.home.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
    Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('auth.redirectToGoogle');
    Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.handleGoogleCallback');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::redirect('/', '/dashboard/home');
    Route::resource('articles', ArticleController::class)->except('create');
    
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('auth.change-password');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('auth.update-password');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('products', ProductController::class)->except('create');
     Route::resource('regions', RegionController::class);
     Route::resource('regions', RegionController::class)->except(['show']);
});

Route::get('/products/{product}/click', [ProductController::class, 'handleClick'])->name('products.handleClick');
Route::get('/articles/{article}/click', [ArticleController::class, 'handleClick'])->name('articles.handleClick');;
Route::get('/cities/{province_id}', [CityController::class, 'getCitiesByProvince'])->name('cities.byProvince');
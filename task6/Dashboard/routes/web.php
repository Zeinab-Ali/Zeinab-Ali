<?php

use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::group(['prefix'=>'products','as'=>'products.'], function () {
        Route::get('/',[ProductController::class,'index'])->name('index');
        Route::get('/create',[ProductController::class,'create'])->name('create');
        Route::post('/store',[ProductController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[ProductController::class,'update'])->name('update');
        Route::post('/destroy/{id}',[ProductController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix'=>'users','as'=>'users.'], function () {
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::get('/destroy/{id}',[UserController::class,'destroy'])->name('destroy');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

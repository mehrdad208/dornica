<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\smallProvinceController;

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


Route::prefix('user')->group(function () {

    Route::get('index/{user}', [UserController::class, 'index'])->name('user.index');
    
    Route::get('login', [UserController::class, 'show'])->name('user.login.show');
    Route::post('login', [UserController::class, 'login'])->name('user.login');

    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');

    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update');

    Route::get('/verification/show/{user}', [UserController::class, 'showVerification'])->name('user.verification.show');
    Route::post('/verification/store/{user}', [UserController::class, 'verification'])->name('user.verification.store');

    Route::get('/giveSmallProvice/{id}', [UserController::class, 'giveSmallProvice'])->name('user.giveSmallProvice');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});


Route::prefix('admin')->group(function () {

  
        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/show', [AdminController::class, 'show'])->name('admin.show');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/delete/{user}', [AdminController::class, 'destroy'])->name('admin.delete');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    

    Route::prefix('province')->group(function () {
        Route::get('/', [ProvinceController::class, 'index'])->name('admin.province.index');
        Route::get('/create', [ProvinceController::class, 'create'])->name('admin.province.create');
        Route::post('/store', [ProvinceController::class, 'store'])->name('admin.province.store'); //cheack
        Route::get('/edit/{id}', [ProvinceController::class, 'edit'])->name('admin.province.edit');
        Route::put('/update/{id}', [ProvinceController::class, 'update'])->name('admin.province.update');
        Route::delete('/delete/{id}', [ProvinceController::class, 'destroy'])->name('admin.province.destroy');
        Route::get('/smallProvince/{id}', [ProvinceController::class, 'show'])->name('admin.province.smallProvince');
        Route::get('/barCharts/{id}', [ProvinceController::class, 'barcharts'])->name('admin.province.barCharts');

    });

    //small_province
    Route::prefix('smallProvince')->group(function () {
        Route::get('/create/{id}', [smallProvinceController::class, 'create'])->name('admin.smallProvince.create');
        Route::post('/store/{id}', [smallProvinceController::class, 'store'])->name('admin.smallProvince.store');
        Route::get('/edit/{id}', [smallProvinceController::class, 'edit'])->name('admin.smallProvince.edit');
        Route::put('/update/{id}', [smallProvinceController::class, 'update'])->name('admin.smallProvince.update');
        Route::delete('/delete/{id}', [smallProvinceController::class, 'destroy'])->name('admin.smallProvince.destroy');
     
    });

    //user
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'all'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    });


    //post
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [PostController::class, 'create'])->name('admin.post.create');
        Route::post('/store', [PostController::class, 'store'])->name('admin.post.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.post.edit');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.post.update');
        Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');

    });

    //report
    Route::prefix('report')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('admin.report.index');
        Route::post('/users', [ReportController::class, 'users'])->name('admin.report.users');
        Route::get('users/export/', [ReportController::class, 'export']);

        // Route::post('/store', [PostController::class, 'store'])->name('admin.post.store');
        // Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.post.edit');
        // Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.post.update');
        // Route::delete('/delete/{post}', [PostController::class, 'destroy'])->name('admin.post.destroy');

    });
});
Route::post('/captcha/load',[CaptchaController::class,'load'])->name('captcha.load');

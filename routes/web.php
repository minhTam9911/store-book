<?php
use App\Http\Controllers\Servers\DashboardController;
use App\Http\Controllers\Servers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auths\LoginController;
use App\Http\Controllers\Auths\RegisterController;
use App\Http\Controllers\Auths\ForgotPasswordController;
use App\Http\Controllers\Auths\ResetPasswordController;
use App\Http\Controllers\TestController;
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/',[
// DashboardController::class,
// 'index'
// ]);
// Route::prefix('admin')->name('admin.')->group(function () {
// Route::resource('product', ProductController::class);
// });
Route::group(['prefix' => 'api'], function() {
    Route::get('/products/search', [ProductController::class, 'search'])->name('api.products.search');
    Route::post('/products/getSelected', [ProductController::class, 'getSelected'])->name('api.products.getSelected');
});

Route::post('/products/storeSelected', [ProductController::class, 'storeSelected'])->name('products.storeSelected');Route::get('/auth/login',[LoginController::class,'create'])->name('auth.login.create');
Route::get('/auth/register',[RegisterController::class,'create'])->name('auth.register.create');
Route::get('/auth/forgot-password',[ForgotPasswordController::class,'create'])->name('auth.forgot.create');
Route::get('/auth/reset-password',[ResetPasswordController::class,'create'])->name('auth.reset.create');
Route::resource('test', TestController::class);

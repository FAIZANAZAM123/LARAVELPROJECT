<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
 
use App\Http\Controllers\DataController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;


 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'register'])->name('register');
    Route::post('/', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::get('/displaycustomers', [DataController::class, 'index'])->name('index');
Route::get('/Addcustomer', [DataController::class, 'insert'])->name('insert');
Route::post('/Addcustomer', [DataController::class, 'create'])->name('create');
Route::get('/edit/{id}', [DataController::class, 'edit'])->name('edit');
Route::put('/edit/{id}', [DataController::class, 'update'])->name('update');
Route::get('/delete/{id}', [DataController::class, 'destroy'])->name('destroy');




Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');




Route::resource('orders', OrderController::class);




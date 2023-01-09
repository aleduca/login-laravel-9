<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(LoginController::class)->group(function () {
  Route::get('/login', 'index')->name('login.index');
  Route::post('/login', 'store')->name('login.store');
  Route::get('/logout', 'destroy')->name('login.destroy');
});

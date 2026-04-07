<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-api', [LoginController::class, 'authenticate']);


Route::get('/admin-dashboard', [LoginController::class, 'adminPage'])->middleware('auth');
// Route Halaman Terpisah
Route::get('/admin-home', [LoginController::class, 'adminPage'])->name('admin.home');
Route::get('/user-home', [LoginController::class, 'userPage'])->name('user.home');

// Route Logout
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/login');
});
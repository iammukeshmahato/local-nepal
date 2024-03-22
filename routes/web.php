<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('guest.login');
});

Route::get('/register', function () {
    return view('guest.register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('guest.index');
});

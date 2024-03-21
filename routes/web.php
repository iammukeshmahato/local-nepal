<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('guest.login');
});

Route::get('/register', function () {
    return view('guest.register');
});

Route::get('/', function () {
    return view('guest.index');
});

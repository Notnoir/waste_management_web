<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('warga.dashboard');
});
Route::get('/dashboard-pengelola', function () {
    return view('pengelola.dashboard');
});
Route::get('/dashboard-admin', function () {
    return view('admin.dashboard');
});



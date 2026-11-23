<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', function () {
    return view('auth');
});

Route::get('/seleksi', function () {
    return view('seleksi');
});

Route::get('/daftarulang', function () {
    return view('daftarulang');
});

Route::get('/cek', function () {
    return view('cek');
});
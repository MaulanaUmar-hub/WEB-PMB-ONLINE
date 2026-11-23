<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

Route::get('/lulus', function () {
    return view('lulus');
});

use App\Http\Controllers\CRUD_Pendaftaran;
Route::get('/pendaftaran', [CRUD_Pendaftaran::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [CRUD_Pendaftaran::class, 'store'])->name('pendaftaran.store');
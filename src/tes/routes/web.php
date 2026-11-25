<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD_Pendaftaran;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth', function () {
    return view('auth');
});



Route::get('/daftarulang', function () {
    return view('daftarulang');
});

Route::get('/cek', [CRUD_Pendaftaran::class, 'cekkelulusan'])->name('kelulusan.cek');

Route::get('/seleksi',  [CRUD_Pendaftaran::class, 'show'])->name('seleksi.show');
Route::post('/seleksi', [CRUD_Pendaftaran::class, 'store'])->name('seleksi.store');
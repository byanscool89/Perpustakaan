<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;


Route::get('/', function () {
    return view('login');
});

Route::group([
'middleware' => 'guest'],function(){
 Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'registerpost'])->name('register');
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'loginpost'])->name('login');
    }
);


Route::group([
'middleware' => 'auth'],function(){
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::delete('/logout', [AuthController::class,'logout'])->name('logout');


Route::get('/buku', [BukuController::class, 'index'])->name('buku.index'); // Untuk menampilkan daftar buku
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create'); // Untuk menampilkan form tambah buku
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
//----------------------------------------
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
//-----------------------------------------
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');


Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

//-----------------------------------------

    }
);










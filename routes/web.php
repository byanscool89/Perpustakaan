<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RakController;

Route::get('/', function () {
    return view('login');
});

Route::group(
    [
        'middleware' => 'guest'
    ],
    function () {
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerpost'])->name('registerpost');
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'loginpost'])->name('loginpost');
        Route::get('/buku/lihatbuku', [BukuController::class, 'lihatbuku'])->name('bukus.lihatbuku');
        Route::get('/buku/history', [BukuController::class, 'history'])->name('buku.history');
        Route::get('/buku/historysearch', [BukuController::class, 'historysearch'])->name('buku.historysearch');
        Route::get('/buku/caribuku', [BukuController::class, 'caribuku'])->name('buku.caribuku');
    }
);
//-----------------------------------------
Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
        //-----------------------------------------
        Route::get('/buku', [BukuController::class, 'index'])->name('buku.index'); // Untuk menampilkan daftar buku
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create'); // Untuk menampilkan form tambah buku
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

        // Route::post('/buku/scan', [BukuController::class, 'store'])->name('buku.scan');
        //----------------------------------------
        Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
        Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
        //-----------------------------------------
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/lap_peminjaman', [PeminjamanController::class, 'lapPeminjaman'])->name('lappeminjaman.index');
        Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
        Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
        Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/filter',[PeminjamanController::class,'filter']);
        Route::get('/lap_peminjaman/print', [PeminjamanController::class, 'print'])->name('peminjaman.print');

        // -----------------------------------------
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/filter',[PengembalianController::class,'filter']);
        Route::get('/lap_pengembalian', [PengembalianController::class, 'lapPengembalian'])->name('lappengembalian.index');
        Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
        Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
        Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
        Route::get('/lap_pengembalian/print', [PengembalianController::class, 'print'])->name('pengembalian.print');
        Route::get('/lap_pengembalian/filter', [PengembalianController::class, 'filter'])->name('filter.pengembalian');

        // Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
        //-----------------------------------------
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

        //-----------------------------------------
        Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
        Route::get('/denda/create', [DendaController::class, 'create'])->name('denda.create');
        Route::post('/denda', [DendaController::class, 'store'])->name('denda.store');
        Route::get('/denda/{id}/edit', [DendaController::class, 'edit'])->name('denda.edit');
        Route::put('/denda/{id}', [DendaController::class, 'update'])->name('denda.update');
        Route::delete('/denda/{id}', [DendaController::class, 'destroy'])->name('denda.destroy');
        Route::get('/denda/{id}', [DendaController::class, 'show'])->name('denda.show');
        //-----------------------------------------
        Route::get('/rak', [RakController::class, 'index'])->name('rak.index');
        Route::get('/rak/create', [RakController::class, 'create'])->name('rak.create');
        Route::post('/rak', [RakController::class, 'store'])->name('rak.store');
        Route::get('/rak/{id}', [RakController::class, 'show'])->name('rak.show');
        Route::get('/rak/{id}/edit', [RakController::class, 'edit'])->name('rak.edit');
        Route::put('/rak/{id}', [RakController::class, 'update'])->name('rak.update');
        Route::delete('/rak/{id}', [RakController::class, 'destroy'])->name('rak.destroy');
        //-----------------------------------------
    }
);

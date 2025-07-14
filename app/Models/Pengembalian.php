<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'tb_pengembalian';
    protected $primaryKey = 'id_pengembalian';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    public function denda()
    {
        return $this->belongsTo(Denda::class, 'id_denda', 'id_denda');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_petugas');
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    // public function peminjaman()
    // {
    //     return $this->hasOne(Pengembalian::class, 'id_peminjaman','id_peminjaman');
    // }
    public function anggota()
{
    return $this->hasOneThrough(Anggota::class, Peminjaman::class, 'id_peminjaman', 'id_anggota', 'id_peminjaman', 'id_anggota');
}

}

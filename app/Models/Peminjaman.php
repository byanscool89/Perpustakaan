<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tb_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [
    //     'id_peminjaman',
    //     'tgl_pinjam',
    //     'tgl_kembali',
    // ];
    protected $guarded = [];
}

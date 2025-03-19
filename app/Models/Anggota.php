<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'tb_anggota';
    protected $primaryKey = 'id_anggota';
    public $incrementing = false;
    protected $keyType = 'string';
    // protected $fillable = [
    //     'id_anggota', 'nama_anggota', 'jk_kelamin', 'alamat_anggota', 'no_telp', 'status_anggota'
    // ];
    protected $guarded = [];
}

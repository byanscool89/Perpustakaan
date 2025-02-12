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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $table = 'tb_rak';
    protected $primaryKey = 'id_rak';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_rak', 'id_rak');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;
    protected $table = 'tb_denda';
    protected $primaryKey = 'id_denda';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_denda', 'kategori_denda', 'biaya'];


public function pengembalian()
{
    return $this->hasOne(Pengembalian::class, 'id_denda', 'id_denda');
}

}



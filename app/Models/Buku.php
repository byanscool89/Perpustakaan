<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the model name
    protected $table = 'tb_buku';

    // Specify the primary key if it is not 'id'
    protected $primaryKey = 'id_buku';

    // Disable auto-incrementing as 'id_buku' is not an integer
    public $incrementing = false;

    // Specify the data type for the primary key
    protected $keyType = 'string';

    // Specify the fillable fields
    protected $guarded = [];

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak', 'id_rak');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

}

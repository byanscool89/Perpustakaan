<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the model name
    protected $table = 'tb_kategori';

    // Specify the primary key if it is not 'id'
    protected $primaryKey = 'id_kategori';

    // Disable auto-incrementing as 'id_kategori' is not an integer
    public $incrementing = false;

    // Specify the data type for the primary key
    protected $keyType = 'string';

    // Specify the fillable fields
    protected $guarded = [

    ];

    // Define the relationship with Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kategori', 'id_kategori');
    }
}

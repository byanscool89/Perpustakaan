<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

                // Retrieve the last inserted Kategori based on id_kategori
                $lastKategori = Kategori::where('id_kategori', 'LIKE', 'KTGR%')
                ->orderBy('id_kategori', 'desc')
                ->first();

// Generate a new id_kategori
if ($lastKategori) {
// Extract the number part from the last id_kategori and increment it
$lastIdNumber = (int) substr($lastKategori->id_kategori, 4);
$newIdNumber = $lastIdNumber + 1;
$newIdKategori = 'KTGR' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
} else {
// If no kategori exists, start with KTGR001
$newIdKategori = 'KTGR001';
}

// Insert new Kategori
Kategori::create([
'id_kategori' => $newIdKategori,
'nama_kategori' => 'Novel'
]);

// Add more categories if necessary
Kategori::create([
'id_kategori' => 'KTGR002',
'nama_kategori' => 'Science Fiction'
]);
// You can add more categories as needed
    }
}
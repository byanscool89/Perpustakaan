<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rak;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve the last inserted Rak based on id_rak
        $lastRak = Rak::where('id_rak', 'LIKE', 'RAK%')
                      ->orderBy('id_rak', 'desc')
                      ->first();

        // Generate a new id_rak
        if ($lastRak) {
            // Extract the number part from the last id_rak and increment it
            $lastIdNumber = (int) substr($lastRak->id_rak, 3);
            $newIdNumber = $lastIdNumber + 1;
            $newIdRak = 'RAK' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // If no rak exists, start with RAK001
            $newIdRak = 'RAK001';
        }

        // Insert new RAKs
        Rak::create([
            'id_rak' => $newIdRak,
            'nama_rak' => 'Rak Fiksi',
            'lokasi_rak' => 'Lantai 1'
        ]);

        // Optionally, add more RAKs
        Rak::create([
            'id_rak' => 'RAK002',
            'nama_rak' => 'Rak Sains',
            'lokasi_rak' => 'Lantai 2'
        ]);

        Rak::create([
            'id_rak' => 'RAK003',
            'nama_rak' => 'Rak Teknologi',
            'lokasi_rak' => 'Lantai 3'
        ]);

        // Add more categories as needed
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pengembalian', function (Blueprint $table) {
            $table->string('id_pengembalian')->primary();  // Primary key
            $table->string('id_peminjaman');
            $table->string('id_denda');
            $table->string('id_petugas');
            $table->date('tgl_dikembalikan')->nullable();
            $table->double('biaya_denda')->nullable();
            $table->string('id_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengembalian');
    }
};
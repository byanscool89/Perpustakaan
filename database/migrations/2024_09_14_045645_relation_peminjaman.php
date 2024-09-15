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
        //
        Schema::table('tb_peminjaman', function (Blueprint $table) {
            $table->foreign('id_buku')->references('id_buku')->on('tb_buku');
            $table->foreign('id_anggota')->references('id_anggota')->on('tb_anggota');
            $table->foreign('id_petugas')->references('id_petugas')->on('tb_petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

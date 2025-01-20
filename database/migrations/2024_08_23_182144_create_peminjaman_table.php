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
        Schema::create('tb_peminjaman', function (Blueprint $table) {
            $table->string('id_peminjaman')->primary();
            $table->string('id_buku');
            $table->string('id_anggota');
            $table->string('id_petugas');
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan'])->nullable();
            $table->timestamps();

            // $table->foreign('id_buku')->references('id_buku')->on('tb_buku');
            // $table->foreign('id_anggota')->references('id_anggota')->on('tb_anggota');
            // $table->foreign('id_petugas')->references('id_petugas')->on('tb_petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
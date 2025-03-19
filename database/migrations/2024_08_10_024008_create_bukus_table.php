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
        Schema::create('tb_buku', function (Blueprint $table) {
            $table->string('id_buku', 15)->primary();
            $table->string('judul', 100)->nullable();
            $table->string('isbn', 100)->nullable();
            $table->string('penulis', 100)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->integer('stok')->nullable();
            $table->string('id_kategori');
            $table->string('id_rak');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->nullable();
            // $table->string('barcode')->nullable()->after('isbn');
            // $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

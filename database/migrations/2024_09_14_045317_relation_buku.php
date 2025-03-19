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
        Schema::table('tb_buku', function(Blueprint $table){
            $table->foreign('id_kategori')->references('id_kategori')->on('tb_kategori');
            $table->foreign('id_rak')->references('id_rak')->on('tb_rak');

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

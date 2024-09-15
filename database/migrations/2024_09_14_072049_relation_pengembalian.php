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
        Schema::table('tb_pengembalian', function (Blueprint $table) {
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('tb_peminjaman');
            $table->foreign('id_denda')->references('id_denda')->on('tb_denda');
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

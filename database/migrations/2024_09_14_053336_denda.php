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
        Schema::create('tb_denda', function (Blueprint $table) {
            $table->string('id_denda', 15)->primary();
            $table->enum('kategori_denda', ['Tepat Waktu', 'Terlambat', 'Rusak', 'Hilang'])->nullable();
            $table->double('biaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_denda');
    }
};

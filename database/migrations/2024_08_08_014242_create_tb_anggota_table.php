<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anggota', function (Blueprint $table) {
            $table->string('id_anggota', 15)->primary();
            $table->string('nama_anggota', 100)->nullable();
            $table->enum('jk_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('alamat_anggota', 100)->nullable();
            $table->string('no_telp', 15)->nullable();
            $table->enum('status_anggota', ['siswa', 'karyawan'])->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_anggota');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigInteger('peminjaman_id');
            $table->integer('peminjaman_buku');
            $table->integer('peminjaman_anggota');
            $table->date('peminjaman_tanggal_mulai');
            $table->date('peminjaman_tanggal_sampai');
            $table->integer('peminjaman_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}

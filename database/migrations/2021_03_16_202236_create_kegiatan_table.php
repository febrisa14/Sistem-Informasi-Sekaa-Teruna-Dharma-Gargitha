<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('kegiatan_id');
            $table->string('nama_kegiatan', 100);
            $table->unsignedInteger('jenis_kegiatan_id');
            $table->string('tgl_kegiatan', 10);
            $table->string('jam_kegiatan', 10);
            $table->string('lokasi', 100);
            $table->timestamps();

            $table->foreign('jenis_kegiatan_id')->references('jenis_kegiatan_id')->on('jenis_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}

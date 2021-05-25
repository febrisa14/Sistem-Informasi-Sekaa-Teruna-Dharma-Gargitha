<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->increments('kas_id');
            $table->unsignedInteger('pengurus_id');
            $table->string('type');
            $table->string('tgl_transaksi');
            $table->string('nominal');
            $table->string('deskripsi');
            $table->timestamps();

            $table->foreign('pengurus_id')->references('pengurus_id')->on('pengurus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas');
    }
}

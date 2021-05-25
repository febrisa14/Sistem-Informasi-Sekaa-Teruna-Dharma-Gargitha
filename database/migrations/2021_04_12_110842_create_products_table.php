<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBajuOgohOgohTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baju_ogoh_ogoh', function (Blueprint $table) {
            $table->increments('baju_id');
            $table->string('nama_baju');
            $table->text('deskripsi');
            $table->string('foto_baju');
            $table->string('harga');
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
        Schema::dropIfExists('baju_ogoh_ogoh');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments('anggota_id');
            $table->unsignedInteger('anggota_user_id');
            $table->string('tgl_lahir', 10);
            $table->string('jenis_kelamin', 12);
            $table->string('tempekan', 10);
            $table->string('umur', 3);
            $table->string('alamat');
            $table->timestamps();

            $table->foreign('anggota_user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}

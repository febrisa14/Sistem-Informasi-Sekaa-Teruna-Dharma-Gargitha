<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->increments('pengurus_id');
            $table->unsignedInteger('pengurus_user_id');
            $table->string('tgl_lahir', 10);
            $table->string('jenis_kelamin', 12);
            $table->unsignedInteger('pengurus_jabatan_id');
            $table->string('umur', 3);
            $table->string('alamat');
            $table->timestamps();

            $table->foreign('pengurus_user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pengurus_jabatan_id')->references('jabatan_id')->on('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengurus');
    }
}

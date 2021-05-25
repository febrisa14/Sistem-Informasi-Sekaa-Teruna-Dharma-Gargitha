<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->increments('no_pesanan',30);
            $table->unsignedInteger('anggota_id');
            $table->unsignedInteger('baju_id');
            $table->string('size',10);
            $table->string('tgl_pesanan',10);
            $table->string('total');
            $table->timestamps();

            $table->foreign('anggota_id')->references('anggota_id')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('baju_id')->references('baju_id')->on('baju_ogoh_ogoh')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

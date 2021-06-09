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
            $table->string('no_pesanan',30)->primary();
            $table->unsignedInteger('anggota_id');
            $table->string('baju_id',20);
            $table->string('size',10);
            $table->string('tgl_pesanan',20);
            $table->string('tgl_bayar',20);
            $table->string('total');
            $table->string('status',30);
            $table->timestamps();

            $table->foreign('anggota_id')->references('anggota_id')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('baju_id')->references('baju_id')->on('baju')->onDelete('cascade')->onUpdate('cascade');
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

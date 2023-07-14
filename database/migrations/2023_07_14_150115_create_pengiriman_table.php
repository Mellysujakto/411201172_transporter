<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_pengiriman', 15)->unique();
            $table->date('tanggal');
            $table->integer('lokasi_id')->nullable();
            $table->string('barang_id')->nullable();
            $table->string('jumlah_barang');
            $table->string('harga_barang')->nullable();
            $table->integer('kurir_id')->nullable();
            $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('pengiriman');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas__masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kas_masuk',10);
            $table->date('tanggal');
            $table->string('penanggung_jawab',50);
            $table->string('keterangan',150);
            $table->integer('jumlah');
            $table->string('bukti',10);
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
        Schema::dropIfExists('kas__masuks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->string('tempat_lahir',30);
            $table->date('tanggal_lahir');
            $table->string('alamat',150);
            $table->string('no_telepon',12);
            $table->string('jenis_kelamin',10);
            $table->string('foto',150);
            $table->string('tandatangan',150);
            $table->foreignId('users_id')->constrained();
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
        Schema::dropIfExists('profiles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mhs');
            $table->string('ip_addres',20);
            $table->date('tgl_aktif');
            $table->time('jam_aktif');
            $table->time('jam_selesai');
            $table->string('status',5);
            $table->timestamps();

            $table->foreign('id_mhs')->references('id')->on('mhs')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktif');
    }
}

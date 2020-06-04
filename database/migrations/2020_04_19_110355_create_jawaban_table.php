<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_soal');
            $table->unsignedBigInteger('id_mhs');
            $table->text('jawaban');
            $table->time('waktu_jawab');
            $table->timestamps();

            $table->foreign('id_soal')->references('id')->on('soal')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');

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
        Schema::dropIfExists('jawaban');
    }
}

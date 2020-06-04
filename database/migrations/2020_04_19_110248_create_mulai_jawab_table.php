<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMulaiJawabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mulai_jawab', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mhs');
            $table->date('tgl');
            $table->time('mulai');
            $table->time('seles');
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
        Schema::dropIfExists('mulai_jawab');
    }
}

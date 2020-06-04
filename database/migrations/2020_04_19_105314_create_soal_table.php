<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_soal',15);
            $table->text('pertanyaan');
            $table->string('gambar',100);
            $table->string('pilihan_a',120);
            $table->string('pilihan_b',120);
            $table->string('pilihan_c',120);
            $table->string('pilihan_d',120);
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
        Schema::dropIfExists('soal');
    }
}

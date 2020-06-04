<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatkulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matkul', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kd_matkul',10)->unique();
            $table->unsignedBigInteger('id_prodi');
            $table->string('nm_matkul',100);
            $table->integer('sks');
            $table->integer('semester');
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi')
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
        Schema::dropIfExists('matkul');
    }
}

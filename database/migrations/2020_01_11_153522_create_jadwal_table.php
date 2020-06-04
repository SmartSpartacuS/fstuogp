<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_matkul');
            $table->unsignedBigInteger('id_ruang');
            $table->unsignedBigInteger('id_dosen');
            $table->string('hari',10);
            $table->time('jam_mulai');
            $table->time('jam_seles');
            $table->string('semester_ak',7);
            $table->year('tahun_ak');
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('id_matkul')->references('id')->on('matkul')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('id_ruang')->references('id')->on('ruang')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            $table->foreign('id_dosen')->references('id')->on('dosen')
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
        Schema::dropIfExists('jadwal');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NIDN',18)->unique();
            $table->string('nm_dosen',100);
            $table->unsignedBigInteger('id_prodi');
            $table->string('password',30);
            $table->string('jenkel',11);
            $table->string('status', 5);
            $table->string('jabatan', 13)->nullable();
            $table->text('alamat');
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
        Schema::dropIfExists('dosen');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stafs', function (Blueprint $table) {
            $table->id();
            $table->string('nm_staf',100);
            $table->unsignedBigInteger('id_prodi');
            $table->string('username',100)->unique();
            $table->string('password',30);
            $table->string('jenkel',11);
            $table->text('alamat');
            $table->string('foto_staf',100);
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
        Schema::dropIfExists('stafs');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\prodi;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class prodiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        prodi::create(
            [
            'kd_prodi'=>'SI',
            'id_fakultas'=>1,
            'nm_prodi'=>'SISTEM INFORMASI',
            ]
        );
        prodi::create(
            [
            'kd_prodi'=>'TG',
            'id_fakultas'=>1,
            'nm_prodi'=>'TEKNIK GEOLOGI',
            ]
        );
        prodi::create(
            [
            'kd_prodi'=>'BI',
            'id_fakultas'=>1,
            'nm_prodi'=>'BIOLOGI',
            ]
        );
    }
}

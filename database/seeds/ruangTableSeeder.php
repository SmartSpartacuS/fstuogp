<?php

use Illuminate\Database\Seeder;
use App\ruang;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ruangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ruang::create(
            [
            'kd_ruang'=>'LAB-SI-A',
            'nm_ruang'=>'Laboratorium SI A',
            ]
        );
        ruang::create(
            [
            'kd_ruang'=>'LAB-SI-B',
            'nm_ruang'=>'Laboratorium SI B',
            ]
        );
        ruang::create(
            [
            'kd_ruang'=>'RK-1',
            'nm_ruang'=>'Ruang Kuliah 1',
            ]
        );
        ruang::create(
            [
            'kd_ruang'=>'RK-2',
            'nm_ruang'=>'Ruang Kuliah 2',
            ]
        );
    }
}

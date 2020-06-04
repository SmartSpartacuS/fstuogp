<?php

use Illuminate\Database\Seeder;
use App\fakultas;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class fakultasTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        fakultas::create(
            [
            'kd_fakultas'=>'FST',
            'nm_fakultas'=>'Fakultas Sains & Teknologi',
            ]
        );

    }
}

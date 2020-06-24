<?php

use Illuminate\Database\Seeder;
use App\matkul;
use App\prodi;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class matkulTableSeeder extends Seeder
{
    protected $matkul;
    protected $faker;

    public function __construct(matkul $matkul, Faker $faker)
    {
        $this->matkul=$matkul;
        $this->faker=$faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,50) as $fk) {
            $this->matkul->create([
                'kd_matkul' => Str::random(10),
                'nm_matkul'=>$this->faker->sentence(2),
                'sks'=>rand(1,6),
                'semester'=>rand(1,8),
            ]);
        }
    }
}

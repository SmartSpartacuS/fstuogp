<?php

use Illuminate\Database\Seeder;
use App\dosen;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class dosenTableSeeder extends Seeder
{
    protected $dosen;
    protected $faker;

    public function __construct(dosen $dosen, Faker $faker)
    {
        $this->dosen=$dosen;
        $this->faker=$faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,15) as $fk) {
            $this->dosen->create([
                'NIDN' => rand(),
                'nm_dosen'=>$this->faker->name(),
                'jenkel'=>$this->faker->randomElement(['Laki-laki','Perempuan']),
                'status'=>$this->faker->randomElement(['Tetap','Luar']),
                'alamat'=>$this->faker->address(),
            ]);
        }
    }
}

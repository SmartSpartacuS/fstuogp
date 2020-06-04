<?php

use App\dosen;
use App\jadwal;
use App\matkul;
use App\prodi;
use App\ruang;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class jadwalTableSeeder extends Seeder
{
    protected $jadwal;
    protected $faker;

    public function __construct(jadwal $jadwal, Faker $faker)
    {
        $this->jadwal=$jadwal;
        $this->faker=$faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,100) as $fk) {
            $this->jadwal->create([
                'id_prodi' => prodi::inRandomOrder()->first()->id,
                'id_matkul' => matkul::inRandomOrder()->first()->id,
                'id_ruang' => ruang::inRandomOrder()->first()->id,
                'id_dosen' => dosen::inRandomOrder()->first()->id,
                'hari'=>$this->faker->randomElement(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']),
                'jam_mulai'=>$this->faker->time($format = 'H:i:s', $max = '15:00:00'),
                'jam_seles'=>$this->faker->time($format = 'H:i:s', $max = '18:00:00'),
                'semester'=>$this->faker->randomElement(['GANJIL','GENAP']),
                'tahun_ak'=>rand(2018,2020),
            ]);
        }
    }
}

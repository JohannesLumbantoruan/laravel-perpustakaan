<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++)
        {
            Anggota::insert([
                'nama'      => $faker->name(),
                'nik'       => $faker->randomNumber($nbDigits = 5, $strict = false),
                'alamat'    => $faker->address(),
            ]);
        }
    }
}

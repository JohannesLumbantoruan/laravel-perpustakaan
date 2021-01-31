<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Buku;

class BukuSeeder extends Seeder
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
            Buku::insert([
                'judul'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'tahun'     => $faker->numberBetween($min = 1990, $max = 2021),
                'penulis'   => $faker->name(),
                'status'    => 1,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Transport::create([
            'name' => 'SSTC',
            'gst_id' => '27AMZPP95541ZF',
            'address' => $faker->address(),
            'number'  => $faker->randomNumber(),
            'email' => 'shreeshakti@gmail.com',
        ]);
        Transport::create([
            'name' => 'Mungippa',
            'gst_id' => '27AMZPP95541ZF',
            'address' => $faker->address(),
            'number'  => $faker->randomNumber(),
            'email' => 'mumgippa@gmail.com',
        ]);
    }
}

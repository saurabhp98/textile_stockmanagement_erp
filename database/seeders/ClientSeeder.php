<?php

namespace Database\Seeders;

use App\Models\Client;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        foreach (range(1, 5) as  $value) {
            
            Client::create([
                'name' => $faker->company(),
                'gst_id' =>$faker->companySuffix(),
                'address' =>$faker->address(),
                'number' =>$faker->randomNumber(),
                'email' =>$faker->email(),
    
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        Purchase::create([
            'inv_no' => '2021-22/045',
            'inv_date' => $faker->date(),
            'challan_no' => '2021-22/050',
            'challan_date' => $faker->date(),
            'lr_no' => '055465',
            'client_id' => 2,
            'item_id' => 1,
            'transport_id' => 1,
        ]);


    }
}

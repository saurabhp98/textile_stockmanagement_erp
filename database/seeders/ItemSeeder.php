<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            
            $faker = Faker::create();
            Item::create([
                'item_name' => '2101',
                'width' => 76,
                'shade' => 'INDIGO',
            ]);
        
    }
}

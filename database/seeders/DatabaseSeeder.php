<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ClientSeeder::class,
            ItemSeeder::class,
            TransportSeeder::class,
            PurchaseSeeder::class,
        ]);

    }
}

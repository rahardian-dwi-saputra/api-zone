<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//$this->call(UserSeeder::class);
        //$this->call(ProvinsiSeeder::class);
        // \App\Models\User::factory(10)->create();
        Customer::factory(10)->create();
    }
}

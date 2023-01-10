<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);

        User::create([
        	'name' => 'User',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'password' => bcrypt('user'),
            'is_admin' => false,
        ]);
    }
}

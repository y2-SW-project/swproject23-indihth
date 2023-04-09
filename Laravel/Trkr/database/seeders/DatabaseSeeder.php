<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        // $this->call(InterestUserSeeder::class);
    }
}

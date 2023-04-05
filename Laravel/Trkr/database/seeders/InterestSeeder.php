<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::create(['name' => 'Music']);
        Interest::create(['name' => 'Sport']);
        Interest::create(['name' => 'Art']);
        Interest::create(['name' => 'Animals']);
        Interest::create(['name' => 'Literature']);
        Interest::create(['name' => 'Politics']);
    }
}

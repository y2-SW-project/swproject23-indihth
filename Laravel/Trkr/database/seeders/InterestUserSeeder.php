<?php

namespace Database\Seeders;

use App\Models\InterestUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InterestUser::factory()
        ->times(10)
        ->create();
    }
}

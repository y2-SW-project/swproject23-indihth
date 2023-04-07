<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Austria',
            'image' => 'austria_flag.png'
        ]);
        Country::create([
            'name' => 'France',
            'image' => 'france_flag.png'
        ]);
        Country::create([
            'name' => 'Ireland',
            'image' => 'ireland_flag.png'
        ]);
        Country::create([
            'name' => 'Italy',
            'image' => 'italy_flag.png'
        ]);
        Country::create([
            'name' => 'Sweden',
            'image' => 'sweden_flag.png'
        ]);
        Country::create([
            'name' => 'Ukraine',
            'image' => 'ukraine_flag.png'
        ]);
    }
}

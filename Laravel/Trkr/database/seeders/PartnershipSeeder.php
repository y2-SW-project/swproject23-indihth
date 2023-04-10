<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        // Gives each user a random other user as partner
        // Should improve so that all users are paired with each other
        // Resulting in 5 partnerships between 10 users
        $users->each(function ($user) use ($users){
            $randomUser = $users->random();
                $user->addPartner($randomUser);
                // $user->partners()->attach($user->random(1)->id);
        });
    }
}

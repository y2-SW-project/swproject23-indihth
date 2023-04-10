<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Interest;
use App\Models\InterestUser;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Enumerable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Gets the admin and user from the role table
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        //  Creates one new admin 
        $admin = new User();
        $admin->name = 'Glenn Sturgis';
        $admin->email = 'glenn@cloud9.ie';
        $admin->password = Hash::make('password');     // Hash creates an encrypted password that's accepted by breeze from the db
        $admin->save();    // save() inserts the new record to the db
        $admin->roles()->attach($role_admin);  // attaches the admin role to the new user

        // Interests are seeded before Users so they can be accessed and attached here
        $interests = Interest::all();

        // Creates multiple new users
        User::factory(10)
            // ->hasInterests(2)  //MUST FIX
            // ->has(InterestUser::factory(2))  //MUST FIX
            ->has(Goal::factory(1)
                ->has(Task::factory(8)))
            
            ->create()->each(function ($user) use($interests) {
                // Attaches two random Interests to each User
                $user->interests()->attach($interests->random(2));  
            });

        
    }
}

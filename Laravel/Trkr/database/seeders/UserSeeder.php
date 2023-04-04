<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        //  Creates a new user with name, email, password 
         $admin = new User();
         $admin->name = 'Glenn Sturgis';
         $admin->email = 'glenn@cloud9.ie';
         $admin->password = Hash::make('password');     // Hash creates an encrypted password that's accepted by breeze from the db
         $admin->save();    // save() inserts the new record to the db

         $admin->roles()->attach($role_admin);  // attaches the admin role to the new user


         $user = new User();
         $user->name = 'Sandra Kaluiokalani';
         $user->email = 'sandra@email.ie';
         $user->password = Hash::make('password');
         $user->save();
         $user->roles()->attach($role_user);

        // User::factory()
        // ->times(1)
        // ->create();
    }
}

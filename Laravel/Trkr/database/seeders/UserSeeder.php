<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\Role;
use App\Models\Task;
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

        //  Creates one new admin 
        $admin = new User();
        $admin->name = 'Glenn Sturgis';
        $admin->email = 'glenn@cloud9.ie';
        $admin->password = Hash::make('password');     // Hash creates an encrypted password that's accepted by breeze from the db
        $admin->save();    // save() inserts the new record to the db
        $admin->roles()->attach($role_admin);  // attaches the admin role to the new user

        // Creates multiple new users
        User::factory(10)
            ->has(Goal::factory(1)
                ->has(Task::factory(3)))
            ->create();

        // User::factory()
        // ->times(10)
        // ->hasGoals()
        // ->create();


        //  $user = new User();
        //  $user->name = 'Sandra Kaluiokalani';
        //  $user->email = 'sandra@email.ie';
        //  $user->password = Hash::make('password');
        //  $user->save();
        //  $user->roles()->attach($role_user);

        // User::factory()
        // ->times(1)
        // ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Stores the User role in a variable
        $role_user = Role::where('name', 'user')->first();

        // Retrieves all of the users
        $users = User::all();

        // Loops through each user and assigns the User role
        foreach ($users as $user) {
            $user->roles()->attach($role_user);
        }
        
    }
}

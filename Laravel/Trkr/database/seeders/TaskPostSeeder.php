<?php

namespace Database\Seeders;

use App\Models\TaskPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskPost::factory()
        ->times(2)
        ->hasComment()
        ->create();
    }
}

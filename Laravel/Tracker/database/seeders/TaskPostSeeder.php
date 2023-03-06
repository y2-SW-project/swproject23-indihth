<?php

namespace Database\Seeders;

use App\Models\Task_post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task_post::factory()
        ->times(2)
        ->hasPostComments()
        ->create();
    }
}

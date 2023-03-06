<?php

namespace Database\Seeders;

use App\Models\Post_comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post_comment::factory()
        ->times(1)
        ->create();
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->numerify('Post comment ###'),
            'user_id' => $this->faker->numberBetween(1, 5),
            'task_post_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}

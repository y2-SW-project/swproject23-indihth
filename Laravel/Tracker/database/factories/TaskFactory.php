<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->numerify('Task ###'),
            'description' => $this->faker->sentences(3, true),
            'type' => $this->faker->randomElement(['Reading', 'Listening', 'Studying', 'Speaking']),
            'user_id' => $this->faker->numberBetween(1, 5),
            'goal_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}

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
    public function definition()
    {
        return [
            'title' => $this->faker->numerify('Task ###'),
            'description' => $this->faker->sentences(3, true),
            'type' => $this->faker->randomElement(['Reading', 'Listening', 'Studying', 'Speaking']),
            'status' => $this->faker->numberBetween(0, 1),
            'updated_at' => $this->faker->dateTimeBetween('-5 days', 'now'),
        ];
    }
}

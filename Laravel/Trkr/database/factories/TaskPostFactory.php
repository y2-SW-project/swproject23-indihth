<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskPost>
 */
class TaskPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->numerify('Task Post ###'),
            'content' => $this->faker->text(200),
            'user_id' => $this->faker->numberBetween(1, 5),
            'task_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}

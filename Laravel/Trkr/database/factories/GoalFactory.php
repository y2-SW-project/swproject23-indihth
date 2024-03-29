<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->numerify('Goal ###'),
            'description' => $this->faker->sentences(3, true),
            'language' => $this->faker->randomElement(['German', 'Spanish', 'French', 'Italian']),
            'user_id' => 1,
            // 'user_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}

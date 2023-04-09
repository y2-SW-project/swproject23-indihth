<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interest>
 */
class InterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $interestsArray = ['Music', 'Sport', 'Art', 'Animals', 'Literature', 'Politics'];
        
        $interests = Interest::createMany($interestsArray);

        return [
            //
        ];
    }
}

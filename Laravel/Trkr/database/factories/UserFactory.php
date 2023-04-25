<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $faker = \Faker\Factory::create();
        // $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        // // return a string that contains a url like 'https://picsum.photos/800/600/'
        // $faker->imageUrl($width = 200, $height = 200);

        // // download a properly sized image from picsum into a file with a file path like '/tmp/13b73edae8443990be1aa8f1a483bc27.jpg'
        // $filePath = $faker->image($dir = 'public/images', $width = 200, $height = 200);

        // Creates multiple new users
        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'about_me' => $this->faker->realText(),
            'country_id' => $this->faker->numberBetween(1, 6),
             // The file path can be returned by ommiting the 'false' as the 3rd parameter
            'user_image' => $this->faker->file($sourceDir = 'public/images/users/', $targetDir = 'public/storage/images/users/', false),
            'level' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

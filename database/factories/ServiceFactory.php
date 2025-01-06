<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'short_description' => $this->faker->sentence(10),
            'service_icon' => $this->faker->imageUrl(100, 100, 'abstract', true, 'icon'),
            'service_title' => $this->faker->words(3, true),
            'service_description' => $this->faker->sentence(3, true),
            'feature_description' => $this->faker->sentence(3, true),
            'featur_icon' => $this->faker->imageUrl(100, 100, 'abstract', true, 'icon'),
            'feature_title' => $this->faker->word(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

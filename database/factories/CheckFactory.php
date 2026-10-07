<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Check>
 */
class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => \App\Models\Item::factory(),
            'status' => fake()->randomElement([
                'pending',
                'likely authentic',
                'suspicious',
                'more images needed',
            ]),
            'confidence' => fake()->optional()->randomFloat(2, 0, 100),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'brand' => fake()->randomElement(['Chanel', 'Louis Vuitton', 'Gucci', 'Prada', 'Hermès']),
            'category' => fake()->randomElement(['Handbag', 'Wallet', 'Shoes', 'Clothing', 'Accessory']),
            'serial_number' => fake()->optional()->bothify('??#####'),
            'description' => fake()->optional()->sentence(),
        ];
    }
}

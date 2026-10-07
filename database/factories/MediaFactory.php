<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
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
            'path' => 'images/' . fake()->uuid() . '.jpg',
            'type' => fake()->randomElement([
                'overview',
                'logo',
                'serial',
                'hardware',
                'interior',
            ]),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}

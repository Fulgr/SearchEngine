<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = Type::all();
        $type_id = $types->random()->id;

        return [
            'url' => $this->faker->url,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type_id' => $type_id,
        ];
    }
}

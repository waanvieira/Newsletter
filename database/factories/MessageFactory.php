<?php

namespace Database\Factories;

use App\Models\NewsLetter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $newletter = NewsLetter::factory()->create();
        return [
            'newletter_id' => $newletter->id,
            'title' => fake()->name(),
            'message' => fake()->text(),
        ];
    }
}

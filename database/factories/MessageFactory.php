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
        $newsletter = NewsLetter::factory()->create();
        return [
            'newsletter_id' => $newsletter->id,
            'title' => fake()->name(),
            'message' => fake()->text(),
        ];
    }
}

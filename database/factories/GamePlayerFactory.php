<?php

namespace Database\Factories;

use App\Models\GamePlayer;
use App\Models\GameRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GamePlayer>
 */
class GamePlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_room_id' => GameRoom::factory(),
            'session_id' => fake()->uuid(),
            'nickname' => fake()->firstName(),
            'is_host' => false,
            'joined_at' => now(),
        ];
    }

    public function host(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_host' => true,
        ]);
    }
}

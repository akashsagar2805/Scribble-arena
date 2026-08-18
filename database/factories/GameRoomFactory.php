<?php

namespace Database\Factories;

use App\Models\GameRoom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<GameRoom>
 */
class GameRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::upper(Str::random(6)),
            'status' => 'waiting',
            'max_players' => 8,
            'rounds_total' => 3,
            'drawing_seconds' => 60,
        ];
    }
}

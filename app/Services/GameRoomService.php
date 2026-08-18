<?php

namespace App\Services;

use App\Models\GamePlayer;
use App\Models\GameRoom;
use App\Models\User;
use Illuminate\Support\Str;

class GameRoomService
{
    /**
     * @param  array{nickname: string, max_players: int, rounds_total: int, drawing_seconds: int}  $data
     */
    public function createRoom(array $data, string $sessionId, ?User $user = null): GameRoom
    {
        $room = GameRoom::create([
            'host_user_id' => $user?->id,
            'code' => $this->generateCode(),
            'max_players' => $data['max_players'],
            'rounds_total' => $data['rounds_total'],
            'drawing_seconds' => $data['drawing_seconds'],
        ]);

        $this->joinRoom($room, $data['nickname'], $sessionId, $user, true);

        return $room->load('players');
    }

    public function joinRoom(GameRoom $room, string $nickname, string $sessionId, ?User $user = null, bool $isHost = false): GamePlayer
    {
        $player = GamePlayer::firstOrNew([
            'game_room_id' => $room->id,
            'session_id' => $sessionId,
        ]);

        $player->fill([
            'user_id' => $user?->id,
            'nickname' => $nickname,
            'is_host' => $player->exists ? $player->is_host || $isHost : $isHost,
        ]);

        if (! $player->exists) {
            $player->joined_at = now();
        }

        $player->save();

        return $player;
    }

    private function generateCode(): string
    {
        do {
            $code = Str::upper(Str::random(6));
        } while (GameRoom::where('code', $code)->exists());

        return $code;
    }
}

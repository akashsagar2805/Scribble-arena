<?php

namespace Tests\Feature;

use App\Models\GamePlayer;
use App\Models\GameRoom;
use App\Services\GameRoomService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GameRoomTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_create_a_room_and_become_host(): void
    {
        $response = $this->post('/rooms', [
            'nickname' => 'Pixel Pro',
            'max_players' => 6,
            'rounds_total' => 3,
            'drawing_seconds' => 60,
        ]);

        $room = GameRoom::first();

        $this->assertNotNull($room);
        $response->assertRedirect(route('rooms.show', $room, absolute: false));
        $response->assertSessionHas('guest_player.nickname', 'Pixel Pro');

        $this->assertDatabaseHas('game_players', [
            'game_room_id' => $room->id,
            'nickname' => 'Pixel Pro',
            'is_host' => true,
        ]);
    }

    public function test_guest_can_join_an_existing_waiting_room(): void
    {
        $room = GameRoom::factory()->create(['code' => 'ABC123']);

        $response = $this->post('/rooms/join', [
            'nickname' => 'Sketchy',
            'room_code' => 'abc123',
        ]);

        $response->assertRedirect(route('rooms.show', $room, absolute: false));
        $response->assertSessionHas('guest_player.nickname', 'Sketchy');

        $this->assertDatabaseHas('game_players', [
            'game_room_id' => $room->id,
            'nickname' => 'Sketchy',
            'is_host' => false,
        ]);
    }

    public function test_guest_cannot_join_a_missing_room(): void
    {
        $response = $this->from('/')->post('/rooms/join', [
            'nickname' => 'Sketchy',
            'room_code' => 'ZZZ999',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors(['room_code' => 'Room not found.']);
        $this->assertDatabaseCount((new GamePlayer)->getTable(), 0);
    }

    public function test_rejoining_same_room_updates_player_without_duplication(): void
    {
        $room = GameRoom::factory()->create(['code' => 'ABC123']);
        $rooms = new GameRoomService;

        $rooms->joinRoom($room, 'Sketchy', 'same-session-id');
        $rooms->joinRoom($room, 'Sketch Pro', 'same-session-id');

        $this->assertDatabaseCount((new GamePlayer)->getTable(), 1);
        $this->assertDatabaseHas('game_players', [
            'game_room_id' => $room->id,
            'nickname' => 'Sketch Pro',
        ]);
    }

    public function test_lobby_shows_room_and_players(): void
    {
        $room = GameRoom::factory()
            ->has(GamePlayer::factory()->host()->state(['nickname' => 'Host One']), 'players')
            ->create(['code' => 'LOBBY1']);

        $response = $this->get(route('rooms.show', $room, absolute: false));

        $response
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Rooms/Show')
                ->where('room.code', 'LOBBY1')
                ->where('room.players.0.nickname', 'Host One')
                ->where('room.players.0.isHost', true));
    }
}

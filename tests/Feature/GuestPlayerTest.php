<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GuestPlayerTest extends TestCase
{
    public function test_play_screen_can_be_rendered_without_login(): void
    {
        $response = $this->get('/play');

        $response
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Game/Index')
                ->where('pendingRoomCode', null));
    }

    public function test_guest_player_can_set_nickname_for_created_room(): void
    {
        $response = $this->post('/guest-player', [
            'nickname' => 'Pixel Pro',
            'intent' => 'create',
        ]);

        $response->assertRedirect(route('play', absolute: false));
        $response->assertSessionHas('guest_player.nickname', 'Pixel Pro');
        $response->assertSessionMissing('pending_room_code');
    }

    public function test_guest_player_can_set_nickname_and_room_code_for_joining(): void
    {
        $response = $this->post('/guest-player', [
            'nickname' => 'Sketchy',
            'intent' => 'join',
            'room_code' => 'abcd12',
        ]);

        $response->assertRedirect(route('play', absolute: false));
        $response->assertSessionHas('guest_player.nickname', 'Sketchy');
        $response->assertSessionHas('pending_room_code', 'ABCD12');
    }

    public function test_joining_requires_a_room_code(): void
    {
        $response = $this->from('/')->post('/guest-player', [
            'nickname' => 'Sketchy',
            'intent' => 'join',
            'room_code' => '',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('room_code');
    }

    public function test_guest_player_can_clear_their_session(): void
    {
        $response = $this
            ->withSession([
                'guest_player' => ['nickname' => 'Pixel Pro'],
                'pending_room_code' => 'ABCD12',
            ])
            ->delete('/guest-player');

        $response->assertRedirect(route('home', absolute: false));
        $response->assertSessionMissing('guest_player');
        $response->assertSessionMissing('pending_room_code');
    }
}

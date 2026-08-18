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

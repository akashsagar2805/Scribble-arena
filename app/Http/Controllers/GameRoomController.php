<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinGameRoomRequest;
use App\Http\Requests\StoreGameRoomRequest;
use App\Models\GameRoom;
use App\Services\GameRoomService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class GameRoomController extends Controller
{
    public function __construct(private GameRoomService $rooms) {}

    public function store(StoreGameRoomRequest $request): RedirectResponse
    {
        $room = $this->rooms->createRoom(
            $request->validated(),
            $request->session()->getId(),
            $request->user(),
        );

        $request->session()->put('guest_player', [
            'nickname' => $request->validated('nickname'),
        ]);
        $request->session()->forget('pending_room_code');

        return redirect()->route('rooms.show', $room);
    }

    public function join(JoinGameRoomRequest $request): RedirectResponse
    {
        $room = GameRoom::where('code', $request->validated('room_code'))->waiting()->firstOrFail();

        $this->rooms->joinRoom(
            $room,
            $request->validated('nickname'),
            $request->session()->getId(),
            $request->user(),
        );

        $request->session()->put('guest_player', [
            'nickname' => $request->validated('nickname'),
        ]);
        $request->session()->forget('pending_room_code');

        return redirect()->route('rooms.show', $room);
    }

    public function show(GameRoom $room): Response
    {
        $room->load(['players' => fn ($query) => $query->oldest('joined_at')]);

        return Inertia::render('Rooms/Show', [
            'room' => [
                'code' => $room->code,
                'status' => $room->status,
                'maxPlayers' => $room->max_players,
                'roundsTotal' => $room->rounds_total,
                'drawingSeconds' => $room->drawing_seconds,
                'players' => $room->players->map(fn ($player) => [
                    'id' => $player->id,
                    'nickname' => $player->nickname,
                    'isHost' => $player->is_host,
                ])->values(),
            ],
        ]);
    }
}

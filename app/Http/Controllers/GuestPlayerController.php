<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestPlayerRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuestPlayerController extends Controller
{
    public function store(StoreGuestPlayerRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->session()->put('guest_player', [
            'nickname' => $validated['nickname'],
        ]);

        if (! empty($validated['room_code'])) {
            $request->session()->put('pending_room_code', $validated['room_code']);
        }

        return redirect()->route('play');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['guest_player', 'pending_room_code']);

        return redirect()->route('home');
    }
}

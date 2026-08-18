<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuestPlayerController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['guest_player', 'pending_room_code']);

        return redirect()->route('home');
    }
}

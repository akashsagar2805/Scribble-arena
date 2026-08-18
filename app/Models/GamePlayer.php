<?php

namespace App\Models;

use Database\Factories\GamePlayerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['game_room_id', 'user_id', 'session_id', 'nickname', 'is_host', 'joined_at'])]
class GamePlayer extends Model
{
    /** @use HasFactory<GamePlayerFactory> */
    use HasFactory;

    public function room(): BelongsTo
    {
        return $this->belongsTo(GameRoom::class, 'game_room_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_host' => 'boolean',
            'joined_at' => 'datetime',
        ];
    }
}

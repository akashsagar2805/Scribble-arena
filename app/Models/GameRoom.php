<?php

namespace App\Models;

use Database\Factories\GameRoomFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['host_user_id', 'code', 'status', 'max_players', 'rounds_total', 'drawing_seconds'])]
class GameRoom extends Model
{
    /** @use HasFactory<GameRoomFactory> */
    use HasFactory;

    protected $attributes = [
        'status' => 'waiting',
        'max_players' => 8,
        'rounds_total' => 3,
        'drawing_seconds' => 60,
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_user_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }

    public function scopeWaiting(Builder $query): Builder
    {
        return $query->where('status', 'waiting');
    }

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'max_players' => 'integer',
            'rounds_total' => 'integer',
            'drawing_seconds' => 'integer',
        ];
    }
}

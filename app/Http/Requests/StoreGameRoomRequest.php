<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'nickname' => ['required', 'string', 'min:2', 'max:24', 'regex:/^[A-Za-z0-9 _-]+$/'],
            'max_players' => ['required', 'integer', 'min:2', 'max:8'],
            'rounds_total' => ['required', 'integer', 'min:1', 'max:6'],
            'drawing_seconds' => ['required', 'integer', 'min:30', 'max:120'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nickname' => is_string($this->nickname) ? trim($this->nickname) : $this->nickname,
            'max_players' => $this->integer('max_players', 8),
            'rounds_total' => $this->integer('rounds_total', 3),
            'drawing_seconds' => $this->integer('drawing_seconds', 60),
        ]);
    }
}

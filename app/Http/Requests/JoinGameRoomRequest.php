<?php

namespace App\Http\Requests;

use App\Models\GameRoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JoinGameRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'nickname' => ['required', 'string', 'min:2', 'max:24', 'regex:/^[A-Za-z0-9 _-]+$/'],
            'room_code' => [
                'required',
                'string',
                'size:6',
                'regex:/^[A-Z0-9]+$/',
                Rule::exists((new GameRoom)->getTable(), 'code')->where('status', 'waiting'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'room_code.exists' => 'Room not found.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nickname' => is_string($this->nickname) ? trim($this->nickname) : $this->nickname,
            'room_code' => is_string($this->room_code) ? strtoupper(trim($this->room_code)) : $this->room_code,
        ]);
    }
}

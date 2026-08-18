<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGuestPlayerRequest extends FormRequest
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
            'intent' => ['required', Rule::in(['create', 'join'])],
            'room_code' => [Rule::requiredIf($this->intent === 'join'), 'nullable', 'string', 'max:12', 'regex:/^[A-Z0-9]+$/'],
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('add-work-time');
    }

    public function rules(): array
    {
        return [
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after:start_at'],
        ];
    }

    public function messages(): array
    {
        return [
            'end_at.after' => 'Data zakończenia musi być późniejsza niż data rozpoczęcia.',
        ];
    }

    public function attributes(): array
    {
        return [
            'start_at' => 'data rozpoczęcia',
            'end_at' => 'data zakończenia',
        ];
    }
}

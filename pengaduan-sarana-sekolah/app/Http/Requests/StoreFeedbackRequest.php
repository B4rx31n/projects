<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:5000'],
            'status_after' => ['required', 'string', Rule::in(array_keys((array) config('aspirasi.statuses')))],
            'progress_percent_after' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }
}




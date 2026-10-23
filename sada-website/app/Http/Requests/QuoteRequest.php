<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "content" => ['required', 'min:3', "max:500"],
            'category' => ['nullable', 'string', 'max:60'],
            'source' => ['nullable', 'string', 'max:180'],
            'challenge' => ['nullable', 'boolean'],
        ];
    }

}

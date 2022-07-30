<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BabyStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam id . Example: 9
 */

class ParentUserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required_without:name|max:255',
            'name' => 'required_without:id|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

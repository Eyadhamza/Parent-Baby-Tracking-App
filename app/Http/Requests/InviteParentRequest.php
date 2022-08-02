<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam id The id of the parent. Example: 9
 */
class InviteParentRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => 'required|exists:parent_users,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

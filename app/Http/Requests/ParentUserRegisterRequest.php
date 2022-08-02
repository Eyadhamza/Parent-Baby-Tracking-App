<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @bodyParam name required name of the parent. Example: Eyad
 * @bodyParam email required The email of the parent. Example: eyad@gmail.com
 */

class ParentUserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:parent_users',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

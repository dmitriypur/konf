<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BitrixFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'required|string',
            'phone' => 'required|numeric',
            'org' => 'string',
            'city' => 'string',
            'brand' => 'string',
            'email' => 'email',
            'contact_method' => 'string',
            'telegram' => 'string',
            'message' => 'string',
            'form_type' => 'string',
            'form_name' => 'string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealStoreRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'city' => 'nullable|string',
            'org' => 'nullable|string',
            'brand' => 'nullable|string',
            'phone' => 'required',
            'form_type' => 'nullable|string',
            'form_name' => 'nullable|string',
        ];

        $input = $this->all();
        foreach ($input as $key => $value) {
            if (preg_match('/^fio(\d+)$/', $key)) {
                $index = str_replace('fio', '', $key);
                $rules["fio{$index}"] = 'required|string';
                $rules["telegram{$index}"] = 'nullable|string';
                $rules["email{$index}"] = 'nullable|email';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'email' => 'Поле :attribute должно быть валидным email адресом',
            'string' => 'Только буквы',
        ];
    }
}

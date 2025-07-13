<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BitrixFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => 'required|string|max:255',
            'org' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'people' => 'required|array|min:1|max:10',
            'people.*.fio' => 'required|string|max:255',
            'people.*.email' => 'required|email|max:255',
            'people.*.telegram' => 'nullable|string|max:255',
            'people.0.phone' => 'required|string|max:20',
            'tariff_id' => 'required|string|in:14,18',
        ];
    }

    public function messages(): array
    {
        return [
            'city.required' => 'Поле "Город" обязательно для заполнения',
            'city.max' => 'Название города не может превышать 255 символов',
            'org.required' => 'Поле "Организация" обязательно для заполнения',
            'org.max' => 'Название организации не может превышать 255 символов',
            'brand.required' => 'Поле "Бренд" обязательно для заполнения',
            'brand.max' => 'Название бренда не может превышать 255 символов',
            'people.required' => 'Необходимо добавить хотя бы одного участника',
            'people.min' => 'Необходимо добавить хотя бы одного участника',
            'people.max' => 'Максимальное количество участников: 10',
            'people.*.fio.required' => 'ФИО участника обязательно для заполнения',
            'people.*.fio.max' => 'ФИО не может превышать 255 символов',
            'people.*.email.required' => 'Email участника обязателен для заполнения',
            'people.*.email.email' => 'Введите корректный email адрес',
            'people.*.email.max' => 'Email не может превышать 255 символов',
            'people.*.telegram.max' => 'Telegram не может превышать 255 символов',
            'people.0.phone.required' => 'Телефон обязателен для заполнения',
            'people.0.phone.max' => 'Телефон не может превышать 20 символов',
            'tariff_id.required' => 'Выберите тариф',
            'tariff_id.in' => 'Выбран неверный тариф',
        ];
    }
}

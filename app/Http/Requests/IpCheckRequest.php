<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IpCheckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ip' => 'required|ip|not_regex:/^(http)/i'
        ];
    }

    public function messages(): array
    {
        return [
            'ip.required' => 'Поле IP-адрес обязательно для заполнения.',
            'ip.ip' => 'Введите корректный IP-адрес. Например: 8.8.8.8',
            'ip.not_regex' => 'Введите только IP-адрес в формате 8.8.8.8'
        ];
    }
}
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
            'ip' => 'required|ip',
        ];
    }

    public function messages(): array
    {
        return [
            'ip.required' => 'Поле IP-адрес обязательно для заполнения.',
            'ip.ip' => 'Введите корректный IP-адрес. Например: 192.168.1.1',
        ];
    }
}
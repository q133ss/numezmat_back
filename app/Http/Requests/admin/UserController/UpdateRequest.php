<?php

namespace App\Http\Requests\admin\UserController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'role_id' => 'required|int|exists:roles,id',
            'password' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите имя',
            'name.string' => 'Введите имя',

            'email.required' => 'Введите Email',
            'email.email' => 'Неверный формат Email',

            'role_id.required' => 'Выберите роль',
            'role_id.int' => 'Выберите роль',
            'role_id.exists' => 'Выберите роль'
        ];
    }
}

<?php

namespace App\Http\Requests\ProfileController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
            'img' => 'nullable|dimensions:min_width=269,min_height=168',
            'name' => 'required|string',
            'email' => 'required|email',
            'password_old' => [
                                'nullable',
                                function($attribute, $value, $fail){
                                    if(!Hash::check($value, Auth()->user()->password)){
                                        $fail('Старый пароль неверный');
                                    }
                                }
                              ],
            'password_new' => 'nullable|min:8|string'
        ];
    }

    public function messages()
    {
        return [
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'name.required' => 'Введите имя',
            'name.string' => 'Введите имя',

            'email.required' => 'Введите Email',
            'email.email' => 'Неверный формат Email',

            'password_new.min' => 'Минимальная длина пароля 8 символов',
            'password_new.string' => 'Минимальная длина пароля 8 символов'
        ];
    }
}

<?php

namespace App\Http\Requests\CartController;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'fio' => 'string|required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'email' => 'required|email',
            'address' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'fio.string' => 'Введите имя',
            'fio.required' => 'Введите имя',

            'phone.required' => 'Введите телефон',
            'phone.regex' => 'Не верный формат телефона',

            'email.email' => 'Не верный формат Email',
            'email.required' => 'Введите Email',

            'address.string' => 'Введите адрес',
            'address.required' => 'Введите адрес',
        ];
    }
}

<?php

namespace App\Http\Requests\AdController;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'type' => 'required|string',
            'img' => 'required|dimensions:min_width=269,min_height=168',
            'link' => 'required|string|url',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'page_url' => 'required|url',
            'in_footer' => 'nullable|boolean',
            'category' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Выберите тип',
            'type.string' => 'Выберите тип',

            'img.required' => 'Выберите изображение',
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'link.required' => 'Введите ссылку',
            'link.url' => 'Неверный формат ссылки',
            'link.string' => 'Введите ссылку',

            'phone.required' => 'Введите телефон',
            'phone.regex' => 'Неверный формат телефона',
            'phone.min' => 'Неверный формат телефона',

            'page_url.required' => 'Произошла ошибка, обновите страницу и попробуйте еще раз',
            'page_url.url' => 'Произошла ошибка, обновите страницу и попробуйте еще раз',

            'in_footer.boolean' => 'Произошла ошибка, обновите страницу и попробуйте еще раз',

            'category.required' => 'Произошла ошибка, обновите страницу и попробуйте еще раз',
            'category.string' => 'Произошла ошибка, обновите страницу и попробуйте еще раз'
        ];
    }
}

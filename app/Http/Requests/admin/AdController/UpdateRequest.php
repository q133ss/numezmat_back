<?php

namespace App\Http\Requests\Admin\AdController;

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
            'img' => 'nullable|dimensions:min_width=269,min_height=168',
            'link' => 'required|url',
            'page_url' => 'required|url',
            'category_type' => 'nullable|string',
            'in_footer' => 'nullable|string',
            'active' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'link.required' => 'Введите ссылку',
            'link.url' => 'Неверый формат ссылки',

            'page_url.required' => 'Введите url страницы',
            'page_url.url' => 'Неверый формат url страницы',

            'category_type.string' => 'Неверный формат категории'
        ];
    }
}

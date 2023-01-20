<?php

namespace App\Http\Requests\NewsController;

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
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'title.required' => 'Введите загаловок',
            'title.string' => 'Загаловок должен быть строкой',

            'description.required' => 'Введите текст',
            'description.string' => 'Текст должен быть строкой'
        ];
    }
}

<?php

namespace App\Http\Requests\NewsController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'img' => 'required|dimensions:min_width=269,min_height=168',
            'except' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'img.required' => 'Выберите изображение',
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'title.required' => 'Введите загаловок',
            'title.string' => 'Загаловок должен быть строкой',

            'except.required' => 'Введите краткое описание',
            'except.string' => 'Поле краткое описание должно быть строкой',

            'description.required' => 'Введите текст',
            'description.string' => 'Текст должен быть строкой'
        ];
    }
}

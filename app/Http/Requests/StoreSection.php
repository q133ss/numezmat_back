<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSection extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'img.required' => 'Выберите изображение',
            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'name.required' => 'Введите название',
            'name.string' => 'Введите название',

            'description.required' => 'Введите описание',
            'description.string' => 'Введите описание',
        ];
    }
}

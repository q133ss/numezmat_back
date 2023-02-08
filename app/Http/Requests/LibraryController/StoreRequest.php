<?php

namespace App\Http\Requests\LibraryController;

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
            'name' => 'string|required',
            'description' => 'string|required',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Выберите категорию',
            'category_id.exists' => 'Выберите категорию',

            'name.required' => 'Введите название',
            'name.string' => 'Введите название',

            'description.required' => 'Введите текст',
            'description.string' => 'Введите текст'
        ];
    }
}

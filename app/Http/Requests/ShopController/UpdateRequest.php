<?php

namespace App\Http\Requests\ShopController;

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
            'title' => 'string|required',
            'description' => 'string|required',
            'price' => 'integer|required',
            'category_id' => 'exists:categories,id|required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Выберите категорию',
            'category_id.exists' => 'Выберите категорию',

            'title.required' => 'Введите название',
            'title.string' => 'Введите название',

            'description.required' => 'Введите описание',
            'description.string' => 'Введите описание',

            'price.required' => 'Введите описание',
            'price.integer' => 'Введите описание'
        ];
    }
}

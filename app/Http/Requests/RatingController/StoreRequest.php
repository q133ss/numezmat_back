<?php

namespace App\Http\Requests\RatingController;

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
            'img' => ['required',
                        'array',
                        function($attribute, $value, $fail){
                            foreach ($value as $img){
                                $data = getimagesize($img);
                                if($data[0] < 269 || $data[1] < 168){
                                    $fail('Минимальный размер изображения 269x168px');
                                }
                            }
                        }
                    ],
            'title' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'img.required' => 'Выберите изображение',
            'img.array' => 'Выберите изображение',

            'title.required' => 'Введите название',
            'title.string' => 'Введите название',

            'category_id.required' => 'Ошибка',
            'category_id.integer' => 'Ошибка',
            'category_id.exists' => 'Ошибка',

            'description.required' => 'Введите название',
            'description.string' => 'Введите название',
        ];
    }
}

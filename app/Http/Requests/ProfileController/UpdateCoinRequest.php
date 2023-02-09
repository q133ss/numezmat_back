<?php

namespace App\Http\Requests\ProfileController;

use App\Models\Coin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCoinRequest extends FormRequest
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
            'id' => [
                        'exists:coins,id',
                        function($attribute, $value, $fail){
                            if(Coin::findOrFail($value)->user_id != Auth()->id()){
                                $fail('Ошибка');
                            }
                        }
                    ],
            'img' => 'nullable|dimensions:min_width=269,min_height=168',
            'title' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Ошибка',

            'img.dimensions' => 'Минимальный размер изображения 269x168px',

            'title.required' => 'Введите название',
            'title.string' => 'Введите название',

            'description.required' => 'Введите описание',
            'description.string' => 'Введите описание'
        ];
    }
}

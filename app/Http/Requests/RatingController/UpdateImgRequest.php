<?php

namespace App\Http\Requests\RatingController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImgRequest extends FormRequest
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
            'file' => 'required|dimensions:min_width=269,min_height=168'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Выберите изображение',
            'file.dimensions' => 'Минимальный размер изображения 269x168px'
        ];
    }
}

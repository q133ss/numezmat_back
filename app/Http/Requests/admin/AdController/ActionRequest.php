<?php

namespace App\Http\Requests\Admin\AdController;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
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
            'start_date' => 'date|required',
            'last_date' => 'date|required'
        ];
    }

    public function messages()
    {
        return [
            'start_date.date' => 'Неверный формат даты начала',
            'last_date.date' => 'Неверный формат даты окончания',

            'start_date.required' => 'Выберите дату начала',
            'last_date.required' => 'Выберите дату окончания'
        ];
    }
}

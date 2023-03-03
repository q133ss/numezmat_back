<?php

namespace App\Http\Requests\Admin\RoleController;

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
            'permissions' => 'array|required'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Введите название',
            'name.required' => 'Введите название',

            'permissions.required' => 'Выберите доступы',
            'permissions.array' => 'Выберите доступы'
        ];
    }
}

<?php

namespace App\Http\Requests\CatalogController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
{
    private $characteristics;
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
        $char_arr = [];
        foreach ($this->char_name as $key => $name){
            $char_arr[] = [
                'name' => $this->char_name[$key],
                'key' => $this->char_key[$key],
                'value' => $this->char_value[$key]
            ];
            if(empty($this->char_name[$key]) || empty($this->char_key[$key]) || empty($this->char_value[$key])){
                throw ValidationException::withMessages(['Характеристики' => 'Необходимо заполнить все поля характеристик']);
            }
        }
        $this->characteristics = $char_arr;

        return [
            'title' => 'string|required',
            'description' => 'string|required',
            'char_name' => 'array',
            'char_key' => 'array',
            'char_value' => 'array',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = (data_get($this->validator->validated(), $key, $default));

        unset($data['char_name']);
        unset($data['char_key']);
        unset($data['char_value']);

        $data['characteristics'] = $this->characteristics;
        return $data;
    }
}

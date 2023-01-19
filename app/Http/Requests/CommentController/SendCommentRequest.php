<?php

namespace App\Http\Requests\CommentController;

use Illuminate\Foundation\Http\FormRequest;

class SendCommentRequest extends FormRequest
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
            'type' => 'required|in:news,rating,expertise,catalog,shop,library,forum',
            'post_id' => 'required|integer',
            'coin_id' => 'nullable|integer|exists:coins,id', #TODO проверка принадлежность к юзеру!!!
            'reply_id' => 'nullable|integer|exists:comments,id',
            'text' => 'required|string'
        ];
    }
}

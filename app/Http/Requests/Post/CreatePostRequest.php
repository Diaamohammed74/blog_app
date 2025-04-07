<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\FormRequest;


class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => ['required','string','max:255','unique:posts,title'],
            'content' => ['required','string'],
        ];
    }
    public function validated($key = null, $default = null)
    {
        $data            = parent::validated();
        $data['user_id'] = auth()->id();
        return $data;
    }
    public function attributes()
    {
        return [
            'title'   => __('main.attributes.title'),
            'content' => __('main.attributes.content'),
        ];
    }
}

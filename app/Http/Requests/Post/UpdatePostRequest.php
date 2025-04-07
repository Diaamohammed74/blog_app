<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => ['required','string','max:255','unique:posts,title,'.$this->post->id],
            'content' => ['required','string'],
        ];
    }
    public function attributes()
    {
        return [
            'title'   => __('main.attributes.title'),
            'content' => __('main.attributes.content'),
        ];
    }
}

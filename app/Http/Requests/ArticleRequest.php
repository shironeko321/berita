<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:1|max:100',
            'content' => 'required',
            'content_meta' => 'required|min:1|max:120',
            'status_published' => 'required',
            'thumbnail'=> [
                Rule::requiredIf(function (){
                    if ($this->thumbnail == null) {
                        return false;
                    } else {
;                       'required|image|mimes:jpeg,jpg,png|max:2048';
                    }
                }),
            ],
            'category' => 'required',
            'tags' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Content Title',
            'content' => 'Content',
            'content_meta' => 'Content Meta',
            'status_published'=> 'Status Published',
            'thumbnail'=> 'Thumbnail',
            'category' => 'Category',
            'tags' => 'Tag'
        ];
    }
}

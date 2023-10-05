<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            // 'status_published' => 'required',
            // 'user_id' => 'required',
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
            'category' => 'Category',
            'tags' => 'Tag'
        ];
    }
}

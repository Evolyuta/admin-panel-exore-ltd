<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'image'       => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}

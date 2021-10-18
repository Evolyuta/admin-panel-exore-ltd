<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexPostFormRequest extends FormRequest
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
            'category_id' => ['exists:categories,id'],
            'employee_id' => ['exists:users,id'],
        ];
    }
}

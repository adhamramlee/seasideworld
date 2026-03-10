<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255'],
            'name_jp' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'description_jp' => ['nullable', 'string', 'max:1000'],
            'status' => ['sometimes', 'boolean'],
        ];
    }
}

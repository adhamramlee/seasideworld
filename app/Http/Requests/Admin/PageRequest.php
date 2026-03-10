<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_en' => ['required', 'string', 'max:255'],
            'title_jp' => ['required', 'string', 'max:255'],
            'content_en' => ['required', 'string'],
            'content_jp' => ['required', 'string'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'status' => ['sometimes', 'boolean'],
        ];
    }
}

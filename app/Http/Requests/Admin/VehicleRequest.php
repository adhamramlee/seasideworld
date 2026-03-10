<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name_en' => ['required', 'string', 'max:255'],
            'name_jp' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string', 'max:5000'],
            'description_jp' => ['required', 'string', 'max:5000'],
            'year' => ['required', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['sometimes', 'boolean'],
            'images' => ['sometimes', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }
}

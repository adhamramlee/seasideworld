<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title_en' => ['required', 'string', 'max:255'],
            'title_jp' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string', 'max:2000'],
            'description_jp' => ['nullable', 'string', 'max:2000'],
            'status' => ['sometimes', 'boolean'],
            'client_ids' => ['sometimes', 'array'],
            'client_ids.*' => ['integer', 'exists:users,id'],
        ];

        if ($this->isMethod('POST')) {
            $rules['file'] = ['required', 'file', 'max:20480', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,zip'];
        } else {
            $rules['file'] = ['nullable', 'file', 'max:20480', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,zip'];
        }

        return $rules;
    }
}

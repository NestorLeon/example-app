<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'color' => 'required|max:7',
            'name' => [
                        'required', 
                        Rule::unique('categories')->ignore($this->category),
                        'min:3',
                        'max:255',
            ],
            [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.unique' => 'El campo nombre debe ser único.',
                'name.min' => 'El campo nombre debe tener mínimo 3 caracteres.',
                'name.max' => 'El campo nombre debe tener máximo 255 caracteres.',
                'color.required' => 'El campo color es obligatorio.',
                'color.max' => 'El campo color debe tener máximo 7 caracteres.',
            ]
        ];
    }
}

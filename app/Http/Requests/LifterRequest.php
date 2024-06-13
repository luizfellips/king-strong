<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LifterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'height' => [
                'required',
                'integer',
                'regex:/^[0-9]{1,9}$/',
                'max:3',
            ],
            'weight' => [
                'required',
                'integer',
                'regex:/^[0-9]{1,9}$/',
                'max:3',
            ],
            'gender' => [
                'required',
                'string',
                'regex:/^[MF]$',
                'max:1',
            ],
            'years_of_lifting' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }


    public function messages(): array
{
    return [
        'height.required' => 'A altura é obrigatória.',
        'height.integer' => 'A altura deve ser um número inteiro.',
        'height.regex' => 'A altura deve conter apenas números e ter no máximo 9 dígitos.',
        'height.max' => 'A altura não pode ter mais de 3 caracteres.',

        'weight.required' => 'O peso é obrigatório.',
        'weight.integer' => 'O peso deve ser um número inteiro.',
        'weight.regex' => 'O peso deve conter apenas números e ter no máximo 9 dígitos.',
        'weight.max' => 'O peso não pode ter mais de 3 caracteres.',

        'gender.required' => 'O gênero é obrigatório.',
        'gender.string' => 'O gênero deve ser uma string.',
        'gender.regex' => 'O gênero deve ser "M" ou "F".',
        'gender.max' => 'O gênero deve ter exatamente 1 caractere.',

        'years_of_lifting.required' => 'Os anos de levantamento são obrigatórios.',
        'years_of_lifting.string' => 'Os anos de levantamento devem ser uma string.',
        'years_of_lifting.max' => 'Os anos de levantamento não podem ter mais de 255 caracteres.',
    ];
}
}

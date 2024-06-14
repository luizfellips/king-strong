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
        return true;
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
                'digits_between:1,4',
            ],
            'weight' => [
                'required',
                'integer',
                'digits_between:1,4',
            ],
            'gender' => [
                'required',
                'string',
                'in:M,F',
            ],
            'years_of_lifting' => [
                'required',
                'string',
                'in:three_to_six_months,up_to_two_years,two_to_five_years,five_or_more_years,ten_or_more_years',
            ],
            'lifter_slug' => [
                'required',
                'exists:lifters,slug',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'height.required' => 'A altura é obrigatória.',
            'height.integer' => 'A altura deve ser um número inteiro.',
            'height.digits_between' => 'A altura deve conter entre 1 e 4 dígitos.',

            'weight.required' => 'O peso é obrigatório.',
            'weight.integer' => 'O peso deve ser um número inteiro.',
            'weight.digits_between' => 'O peso deve conter entre 1 e 4 dígitos.',

            'gender.required' => 'O gênero é obrigatório.',
            'gender.string' => 'O gênero deve ser uma string.',
            'gender.in' => 'O gênero deve ser "M" ou "F".',

            'years_of_lifting.required' => 'Os anos de levantamento são obrigatórios.',
            'years_of_lifting.string' => 'Os anos de levantamento devem ser uma string.',
            'years_of_lifting.in' => 'Selecione uma opção válida para os anos de levantamento.',

            'lifter_slug.required' => 'The lifter slug is required.',
            'lifter_slug.exists' => 'The given lifter slug does not exist.',
        ];
    }
}

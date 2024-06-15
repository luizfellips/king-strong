<?php

namespace App\Http\Requests\OneRepMax;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'compoundWeight' => 'required|numeric',
            'reps' => 'required|integer',
            'repsInReserve' => 'required|integer',
            'compound_slug' => 'required|exists:compounds,slug|string',
            'lifter_slug' => 'required|exists:lifters,slug|string',
        ];
    }

    public function messages(): array
    {
        return [
            'compoundWeight.required' => 'O peso do exercício é obrigatório.',
            'compoundWeight.numeric' => 'O peso do exercício deve ser um valor numérico.',
            'reps.required' => 'O número de repetições é obrigatório.',
            'reps.integer' => 'O número de repetições deve ser um valor inteiro.',
            'repsInReserve.required' => 'As repetições em reserva são obrigatórias.',
            'repsInReserve.integer' => 'As repetições em reserva devem ser um valor inteiro.',
            'compound_id.required' => 'O Slug do exercício é obrigatório.',
            'compound_id.exists' => 'O Slug do exercício selecionado não existe.',
            'lifter_slug.required' => 'O Slug do levantador é obrigatório.',
            'lifter_slug.exists' => 'O Slug do levantador selecionado não existe.',
        ];
    }
}

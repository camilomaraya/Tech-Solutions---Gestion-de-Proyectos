<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarProyectoRequest extends FormRequest
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
            'nombre'      => ['sometimes', 'required', 'string', 'max:120'],
            'fechaInicio' => ['sometimes', 'required', 'date'],
            'estado'      => ['sometimes', 'required', 'in:Planificado,En progreso,Finalizado'],
            'responsable' => ['sometimes', 'required', 'string', 'max:120'],
            'monto'       => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'estado.in' => 'El estado debe ser: Planificado, En progreso o Finalizado.',
        ];
    }
}

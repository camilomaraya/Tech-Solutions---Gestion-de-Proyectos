<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GuardarProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => ['required', 'string', 'max:120'],
            'fechaInicio' => ['required', 'date'],
            'estado'      => ['required', 'in:Planificado,En progreso,Finalizado'],
            'responsable' => ['required', 'string', 'max:120'],
            'monto'       => ['required', 'numeric', 'min:0'],
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

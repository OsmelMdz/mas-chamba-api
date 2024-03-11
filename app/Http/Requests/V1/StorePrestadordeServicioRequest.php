<?php

namespace App\Http\Requests\V1;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrestadordeServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return true;¿
        $user = $this->user();
        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string'],
            'a_paterno' => ['required', 'string'],
            'a_materno' => ['required', 'string'],
            'fecha_nacimiento' => ['required', 'date'],
            'imagen' => ['required', 'string'],
            'sexo' => ['required', 'string'],
            'telefono' => ['required', 'string'],
            'identificacion_personal' => ['required', 'string'],
            'comprobante_domicilio' => ['required', 'string'],
            'email' => ['required', 'email'],
            'tipo_cuenta' => ['required', Rule::in(['Premiun', 'Normal'])],
            'estatus' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'estatus' => $this->estatus ?? 'Activo',
        ]);
    }
}

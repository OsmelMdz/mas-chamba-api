<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrestadordeServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
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
                'tipo_cuenta' => ['required', Rule::in(['Premiun', 'Normal'])],
                'estatus' => ['required', 'string'],
            ];
        } else {
            return [
                'nombre' => ['sometimes', 'required', 'string'],
                'a_paterno' => ['sometimes', 'required', 'string'],
                'a_materno' => ['sometimes', 'required', 'string'],
                'fecha_nacimiento' => ['sometimes', 'required', 'date'],
                'imagen' => ['sometimes', 'required', 'string'],
                'sexo' => ['sometimes', 'required', 'string'],
                'telefono' => ['sometimes', 'required', 'string'],
                'identificacion_personal' => ['sometimes', 'required', 'string'],
                'comprobante_domicilio' => ['sometimes', 'required', 'string'],
                'tipo_cuenta' => ['sometimes', 'required', Rule::in(['Premiun', 'Normal'])],
                'estatus' => ['sometimes', 'required', 'string'],
            ];
        }
    }
    protected function prepareForValidation()
    {
        if ($this->estatus) {
            $this->merge([
                'estatus' => $this->estatus ?? 'Activo',
            ]);
        }
    }
}

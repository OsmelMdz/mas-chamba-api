<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificacionRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'nombre' => ['required', 'string'],
                'descripcion' => ['required', 'string'],
                'imagen' => ['required', 'string'],
                'estatus' => ['required', 'string'],
            ];
        } else {
            return [
                'nombre' => ['sometimes', 'required', 'string'],
                'descripcion' => ['sometimes', 'required', 'string'],
                'imagen' => ['sometimes', 'required', 'string'],
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

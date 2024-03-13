<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestadordeServicioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'imagen' => $this->imagen,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'identificacion_personal' => $this->identificacion_personal,
            'comprobante_domicilio' => $this->comprobante_domicilio,
            'email' => $this->email,
            'tipo_cuenta' => $this->tipo_cuenta,
            'estatus' => $this->estatus,
            'cursos' => CursoResource::collection($this->whenLoaded('cursos')),
            'certificaciones' => CertificacionResource::collection($this->whenLoaded('certificaciones')),
            'servicios' => ServicioResource::collection($this->whenLoaded('servicios')),
            'zonas' => ZonaResource::collection($this->whenLoaded('zonas')),
        ];
    }
}

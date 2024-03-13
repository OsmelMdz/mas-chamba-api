<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestadordeServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'a_paterno',
        'a_materno',
        'fecha_nacimiento',
        'imagen',
        'sexo',
        'telefono',
        'identificacion_personal',
        'comprobante_domicilio',
        'tipo_cuenta',
        'user_id',
        'estatus',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_asignados');
    }
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
    public function certificaciones()
    {
        return $this->hasMany(Certificacion::class);
    }
}

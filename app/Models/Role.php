<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_asignados', 'rol_id', 'user_id');
    }
    public function prestadores()
    {
        return $this->belongsToMany(PrestadordeServicio::class, 'roles_asignados');
    }
    public function administradores()
    {
        return $this->belongsToMany(Administrador::class, 'roles_asignados');
    }
}

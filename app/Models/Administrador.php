<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nombre', 'estatus'];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_asignados');
    }
}

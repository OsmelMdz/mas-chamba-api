<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'estatus',
    ];
    public function prestadordeServicio()
    {
        return $this->belongsTo(PrestadordeServicio::class);
    }
}

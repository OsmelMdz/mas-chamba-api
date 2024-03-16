<?php

namespace App\Filters\V1;


use App\Filters\ApiFilter;

class CertificacionFilter extends ApiFilter
{
    protected $safeParms = [
        'prestadorde_servicio_id' => ['eq'],
        'nombre' => ['eq'],
        'descripcion' => ['eq'],
        'imagen' => ['eq'],
        'estatus' => ['eq','neq','gt','gte','lt','lte','like','nlike','in','nin','btw','nbtw','is','nis'],
    ];

    protected $columnMap = [
        'prestadorde_servicio_id' => 'prestadorde_servicio_id',
    ];

    protected $operatorMap = [
        'eq'=> '=',
        'neq'=> '!=',
        'gt'=> '>',
        'gte'=> '>=',
        'lt'=> '<',
        'lte'=> '<=',
        'like'=> 'like',
        'nlike'=> 'not like',
        'in'=> 'in',
        'nin'=> 'not in',
        'btw'=> 'between',
        'nbtw'=> 'not between',
        'is'=> 'is',
        'nis'=> 'is not',
    ];


}

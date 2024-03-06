<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class VisitanteFilter extends ApiFilter
{
    protected $safeParms = [
        'nombre' => ['eq'],
        'telefono'=> ['eq'],
        'estatus' => ['eq','neq','gt','gte','lt','lte','like','nlike','in','nin','btw','nbtw','is','nis'],
    ];

    protected $columnMap = [
        'estatus' => 'estatus',
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

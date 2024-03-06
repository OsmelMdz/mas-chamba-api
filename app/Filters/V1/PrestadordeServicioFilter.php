<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class  PrestadordeServicioFilter extends ApiFilter
{
    protected $safeParms = [
        'nombre' => ['eq'],
        'a_paterno' => ['eq'],
        'a_materno' => ['eq'],
        'fecha_nacimiento' => ['eq'],
        'imagen' => ['eq'],
        'sexo' => ['eq'],
        'telefono' => ['eq'],
        'identificacion_personal' => ['eq'],
        'comprobante_domicilio' => ['eq'],
        'email' => ['eq'],
        'estatus' => ['eq'],
        'tipo_cuenta' => ['eq','neq','gt','gte','lt','lte','like','nlike','in','nin','btw','nbtw','is','nis'],
    ];

    protected $columnMap = [
        'tipo_cuenta' => 'tipo_cuenta',
    ];

    protected $operatorMap = [
        'Normal' => '=',
        'Premiun' => '=',
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

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {	// Si el operador está definido
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                    break;
                }
            }
        }
        return $eloQuery;
    }
}

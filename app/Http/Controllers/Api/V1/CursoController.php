<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Filters\V1\CursoFilter;
use App\Models\Curso;
use App\Http\Requests\V1\StoreCursoRequest;
use App\Http\Requests\V1\UpdateCursoRequest;
use App\Http\Resources\V1\CursoResource;
use App\Http\Resources\V1\CursoCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreCursoRequest;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Curso::all();
        //return new CursoCollection(Curso::paginate());
        $filter = new CursoFilter();
        $queryItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])

        if(count($queryItems) == 0){
            return new CursoCollection(Curso::paginate());
        }else{
            $cursos = Curso::where($queryItems)->paginate();
            return new CursoCollection($cursos->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bulkStore(BulkStoreCursoRequest $request)
    {
        $data = collect($request->all())->map(function($arr, $key){
            if (Arr::exists($arr, 'prestadorde_servicio_id')) {
                $arr['prestadorde_servicio_id'] = $arr['prestadorde_servicio_id'] ?? null;
            }
            if (Arr::exists($arr, 'estatus')) {
                $arr['estatus'] = $arr['estatus'] ?? 'Habilitado';
            }
            return $arr;
        });

        Curso::insert($data->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCursoRequest $request)
    {
        return new CursoResource(Curso::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return new CursoResource($curso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursoRequest $request, $id)
    {
        $curso = Curso::find($id);
        if(!$curso){
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }
        $curso->update($request->all());
        return new CursoResource($curso);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        //
    }
}

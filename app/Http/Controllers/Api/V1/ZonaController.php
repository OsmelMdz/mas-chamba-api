<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ZonaCollection;
use App\Http\Resources\V1\ZonaResource;
use App\Http\Requests\V1\StoreZonaRequest;
use App\Http\Requests\V1\UpdateZonaRequest;
use App\Http\Requests\V1\BulkStoreZonaRequest;
use App\Filters\V1\ZonaFilter;
use App\Models\Zona;
use Illuminate\Support\Arr;

class ZonaController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ZonaFilter();
        $queryItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])

        if(count($queryItems) == 0){
            return new ZonaCollection(Zona::paginate());
        }else{
            $cursos = Zona::where($queryItems)->paginate();
            return new ZonaCollection($cursos->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bulkStore(BulkStoreZonaRequest $request)
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

        Zona::insert($data->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZonaRequest $request)
    {
        return new ZonaResource(Zona::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Zona $curso)
    {
        return new ZonaResource($curso);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zona $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZonaRequest $request, $id)
    {
        $curso = Zona::find($id);
        if(!$curso){
            return response()->json(['message' => 'Zona no encontrado'], 404);
        }
        $curso->update($request->all());
        return new ZonaResource($curso);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zona $curso)
    {
        //
    }
}

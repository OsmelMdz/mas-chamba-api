<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Filters\V1\ServicioFilter;
use App\Models\Servicio;
use App\Http\Requests\V1\StoreServicioRequest;
use App\Http\Requests\V1\UpdateServicioRequest;
use App\Http\Resources\V1\ServicioResource;
use App\Http\Resources\V1\ServicioCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreServicioRequest;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Servicio::all();
        //return new ServicioCollection(Servicio::paginate());
        $filter = new ServicioFilter();
        $queryItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])

        if(count($queryItems) == 0){
            return new ServicioCollection(Servicio::paginate());
        }else{
            $cursos = Servicio::where($queryItems)->paginate();
            return new ServicioCollection($cursos->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bulkStore(BulkStoreServicioRequest $request)
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

        Servicio::insert($data->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicioRequest $request)
    {
        return new ServicioResource(Servicio::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        return new ServicioResource($servicio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicioRequest $request, $id)
    {
        $servicio = Servicio::find($id);
        if(!$servicio){
            return response()->json(['message' => 'Certificado no encontrado'], 404);
        }
        $servicio->update($request->all());
        return new ServicioResource($servicio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ZonaCollection;
use App\Http\Resources\V1\ZonaResource;
use App\Http\Requests\V1\StoreZonaRequest;
use App\Http\Requests\V1\UpdateZonaRequest;
use App\Filters\V1\ZonaFilter;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreZonaRequest;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new ZonaFilter();
        $queryItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])

        if (count($queryItems) == 0) {
            return new ZonaCollection(Zona::paginate());
        } else {
            $zonas = Zona::where($queryItems)->paginate();
            return new ZonaCollection($zonas->appends($request->query()));
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
        $data = collect($request->all())->map(function ($arr, $key) {
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
    public function show(Zona $zona)
    {
        return new ZonaResource($zona);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zona $zona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZonaRequest $request, $id)
    {
        $zona = Zona::find($id);
        if (!$zona) {
            return response()->json(['message' => 'Zona no encontrado'], 404);
        }
        $zona->update($request->all());
        return new ZonaResource($zona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $zona = Zona::find($id);
        if (!$zona) {
            return response()->json(['message' => 'Zona no encontrado'], 404);
        }
        $zona->delete();
        return response()->json(['message' => 'Zona eliminado'], 200);
    }
}

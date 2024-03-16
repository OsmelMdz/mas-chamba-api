<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Filters\V1\CertificacionFilter;
use App\Models\Certificacion;
use App\Http\Requests\V1\StoreCertificacionRequest;
use App\Http\Requests\V1\UpdateCertificacionRequest;
use App\Http\Resources\V1\CertificacionResource;
use App\Http\Resources\V1\CertificacionCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreCertificacionRequest;

class CertificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Certificacion::all();
        // return new CertificacionCollection(Certificacion::paginate());
        $filter = new CertificacionFilter();
        $queryItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])

        if (count($queryItems) == 0) {
            return new CertificacionCollection(Certificacion::paginate());
        } else {
            $cursos = Certificacion::where($queryItems)->paginate();
            return new CertificacionCollection($cursos->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bulkStore(BulkStoreCertificacionRequest $request)
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

        Certificacion::insert($data->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCertificacionRequest $request)
    {
        return new CertificacionResource(Certificacion::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificacion $certificacion)
    {
        return new CertificacionResource($certificacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificacion $certificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificacionRequest $request, $id)
    {
        $certificacion = Certificacion::find($id);
        if(!$certificacion){
            return response()->json(['message' => 'Certificado no encontrado'], 404);
        }
        $certificacion->update($request->all());
        return new CertificacionResource($certificacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificacion = Certificacion::find($id);
        if(!$certificacion){
            return response()->json(['message' => 'Certificado no encontrado'], 404);
        }
        $certificacion->delete();
        return response()->json(['message' => 'Certificado eliminado'], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\PrestadordeServicioFilter;
use App\Http\Controllers\Controller;
use App\Models\PrestadordeServicio;
use App\Http\Requests\V1\StorePrestadordeServicioRequest;
use App\Http\Requests\V1\UpdatePrestadordeServicioRequest;
use App\Http\Resources\V1\PrestadordeServicioResource;
use App\Http\Resources\V1\PrestadordeServicioCollection;
use Illuminate\Http\Request;

class PrestadordeServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PrestadordeServicioFilter();
        $filterItems = $filter->transform($request); // PrestadordeServicio::where([['colum','operador','value']])
        $includeCursos = $request->query('includeCursos');
        $inlcudeServicios = $request->query('includeServicios');
        $includeCertificaciones = $request->query('includeCertificaciones');
        $includeZonas = $request->query('includeZonas');
        $prestadoresdeservicios = PrestadordeServicio::where($filterItems);
        if ($includeCursos && $includeCertificaciones && $inlcudeServicios && $includeZonas) {
            $prestadoresdeservicios = $prestadoresdeservicios->with('cursos');
            $prestadoresdeservicios = $prestadoresdeservicios->with('certificaciones');
            $prestadoresdeservicios = $prestadoresdeservicios->with('servicios');
            $prestadoresdeservicios = $prestadoresdeservicios->with('zonas');
        }
        return new PrestadordeServicioCollection($prestadoresdeservicios->paginate()->appends($request->query()));
        /*  if (count($filterItems) == 0) {
            return new PrestadordeServicioCollection(PrestadordeServicio::paginate());
        } else {
        } */
        // PrestadordeServicio::where($queryItems)
        //return PrestadordeServicio::all();
        // return new PrestadordeServicioCollection(PrestadordeServicio::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestadordeServicioRequest $request)
    {
        return new PrestadordeServicioResource(PrestadordeServicio::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestadordeServicio = PrestadordeServicio::findOrFail($id);
        $includeCursos = request()->query('includeCursos');
        $includeCertificaciones = request()->query('includeCertificaciones');
        $inlcudeServicios = request()->query('includeServicios');
        $inlcudeZonas = request()->query('includeZonas');
        if ($includeCursos && $includeCertificaciones && $inlcudeServicios && $inlcudeZonas) {
            return new PrestadordeServicioResource($prestadordeServicio->loadMissing('cursos', 'certificaciones', 'servicios','zonas'));
        }
        return new PrestadordeServicioResource($prestadordeServicio);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrestadordeServicio $prestadordeServicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestadordeServicioRequest $request, $id)
    {
        $prestadordeServicio = PrestadordeServicio::find($id);
        if (!$prestadordeServicio) {
            return response()->json(['message' => 'Prestador de servicio no encontrado'], 404);
        }
        $prestadordeServicio->update($request->all());
        return new PrestadordeServicioResource($prestadordeServicio);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrestadordeServicio $prestadordeServicio)
    {
        //
    }
}

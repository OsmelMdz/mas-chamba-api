<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\VisitanteCollection;
use App\Http\Resources\V1\VisitanteResource;
use App\Models\Visitante;
use App\Filters\V1\VisitanteFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreVisitanteRequest;
use App\Http\Requests\V1\UpdateVisitanteRequest;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return Visitante::all();
        $filter = new VisitanteFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new VisitanteCollection(Visitante::paginate());
        } else {
            $visitantes = Visitante::where($queryItems)->paginate();
            return new VisitanteCollection($visitantes->appends($request->query()));
        }
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
    public function store(StoreVisitanteRequest $request)
    {
        return new VisitanteResource(Visitante::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitante $visitante)
    {
        return new VisitanteResource($visitante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitante $visitante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitanteRequest $request, $id)
    {
        $visitante = Visitante::find($id);
        if(!$visitante){
            return response()->json(['message' => 'Visitante no encontrado'], 404);
        }
        $visitante->update($request->all());
        return new VisitanteResource($visitante);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visitante = Visitante::find($id);
        if(!$visitante){
            return response()->json(['message' => 'Visitante no encontrado'], 404);
        }
        $visitante->delete();
        return response()->json(['message' => 'Visitante eliminado'], 200);
    }
}

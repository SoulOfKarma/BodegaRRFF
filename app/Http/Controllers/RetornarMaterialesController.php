<?php

namespace App\Http\Controllers;

use App\RetornarMateriales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class RetornarMaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $res = RetornarMateriales::all();
            return $res;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function PostStockDevolucion(Request $request){

        $get_all = RetornarMateriales::select('retornar_materiales.*','material_ubicaciones.descripcion_ubicacion',/* 'material_servicios.descripcion_servicio', */
        'material_ingresados.descripcion_material',/* 'material_cantidades_especificas.descripcion_cantidad_especifica', */
        'material_medidas.descripcion_medidas','material_cubiculos.descripcion_cubiculo','documento_asociados.descripcion_documento',DB::raw("DATE_FORMAT(retornar_materiales.created_at,'%d/%m/%Y') as created"))
        ->join('material_ubicaciones', 'retornar_materiales.id_ubicaciones','=','material_ubicaciones.id')
        /* ->join('material_servicios', 'material_inventarios.id_servicios','=','material_servicios.id') */
        ->join('material_ingresados', 'retornar_materiales.id_material_ing','=','material_ingresados.id')
        /* ->join('material_cantidades_especificas', 'material_inventarios.id_cant_esp','=','material_cantidades_especificas.id') */
        ->join('material_medidas', 'retornar_materiales.id_material_medida','=','material_medidas.id')
        ->join('documento_asociados','retornar_materiales.id_documento','=','documento_asociados.id')
        ->join('material_cubiculos','retornar_materiales.id_cubiculo','=','material_cubiculos.id')
        ->where('retornar_materiales.id_ticket',$request->idTicket)
        ->get();

        return $get_all;
    }

    public function PutRetornoMateriales(Request $request){
        try {
            $data = $request->all();
            foreach($data as $e => $req ){       
                RetornarMateriales::where('id',$req['id'])
              ->update(['material_cantidad' => $req['material_cantidad'],'id_estados' => 6 ]);             
            }
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            foreach($data as $e => $req ){                    
                RetornarMateriales::create(array_merge($req,['id_ticket' => $req['idOT'],'id_estados' => 2]));
            }
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RetornarMateriales  $retornarMateriales
     * @return \Illuminate\Http\Response
     */
    public function show(RetornarMateriales $retornarMateriales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetornarMateriales  $retornarMateriales
     * @return \Illuminate\Http\Response
     */
    public function edit(RetornarMateriales $retornarMateriales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetornarMateriales  $retornarMateriales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetornarMateriales $retornarMateriales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetornarMateriales  $retornarMateriales
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetornarMateriales $retornarMateriales)
    {
        //
    }
}
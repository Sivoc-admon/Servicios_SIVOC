<?php

namespace App\Http\Controllers;

use App\Area;
use App\Requisition;
use Illuminate\Http\Request;
use App\DetailRequisition;
use App\ProvidersRequisitions;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::all();
        $areas = Area::all();
        $newRequisitionsCount = Requisition::all()->count();

        $newRequisition = $newRequisitionsCount + 1;
        //dd($newRequisition);

        return view('requisitions.requisitions', compact('requisitions','areas', 'newRequisition'));
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
        $error = false;
        $msg = "";

        $id_user = auth()->user()->id;
        $requisition = new Requisition();
        $requisition->id_user = $id_user;
        $requisition->id_area = $request->area_id;

        if ($requisition->save()) {
            for ($i=1; $i <= $request->totalItems; $i++) {
                $detailRequisition = new DetailRequisition();
                $detailRequisition->num_item = $i;
                $detailRequisition->id_classification = $request->item_clasificacion_+$i;
                $detailRequisition->id_requisition = $requisition->id;
                $detailRequisition->quantity = $request->item_cantidad_.$i;
                $detailRequisition->unit = $request->item_unidad_.$i;
                $detailRequisition->description = $request->item_descripcion_.$i;
                $detailRequisition->model = $request->item_modelo_.$i;
                $detailRequisition->preference = $request->item_referencia_.$i;
                $detailRequisition->urgency = $request->item_urgencia_.$i;
                $detailRequisition->status = $request->item_status_.$i;
                $detailRequisition->save();

                //dd($request);
                $providerRequisitionUno = new ProvidersRequisitions();
                $providerRequisitionUno->id_detail_requisition = $detailRequisition->id;
                $providerRequisitionUno->num_item = $i;
                $providerRequisitionUno->name = $request->item_prov1_.$i;
                $providerRequisitionUno->unit_price = $request->item_unitatio1_.$i;
                $providerRequisitionUno->save();

                $providerRequisitionDos = new ProvidersRequisitions();
                $providerRequisitionDos->id_detail_requisition = $detailRequisition->id;
                $providerRequisitionDos->num_item = $i;
                $providerRequisitionDos->name = $request->item_prov2_.$i;
                $providerRequisitionDos->unit_price = $request->item_unitatio2_.$i;
                $providerRequisitionDos->save();

                $providerRequisitionTres = new ProvidersRequisitions();
                $providerRequisitionTres->id_detail_requisition = $detailRequisition->id;
                $providerRequisitionTres->num_item = $i;
                $providerRequisitionTres->name = $request->item_prov3_.$i;
                $providerRequisitionTres->unit_price = $request->item_unitatio3_.$i;
                $providerRequisitionTres->save();
            }
        } else {
            $msg = "Error al guardar la requisición";
            $error = true;
            $array=["msg"=>$msg, "error"=>$error];

            return response()->json($array);
        }

        $msg = "Requisición guardada correctamente";
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
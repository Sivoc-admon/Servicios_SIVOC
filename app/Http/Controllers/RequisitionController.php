<?php

namespace App\Http\Controllers;

use App\Area;
use App\Requisition;
use Illuminate\Http\Request;
use App\DetailRequisition;
use App\ProvidersRequisitions;
use Illuminate\Support\Facades\DB;
use App\RequisitionFile;

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
        $newRequisitionsCount = Requisition::latest()->first();
        $test = Requisition::latest()->first();

        $newRequisition = $newRequisitionsCount->id + 1;
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
        $requisition->no_requisition = $request->noRequisition;
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
    public function show(Request $request, $id)
    {
        $requisition = Requisition::find($id);
        $detailRequisition = DetailRequisition::where("id_requisition", $id)->get();

        $array=["requisition"=>$requisition, "detailRequisition"=>$detailRequisition];
        return response()->json($array);
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

    public function uploadFile(Request $request, $idRequisition){
        $error=false;
        $msg="";

        $pathFile = 'public/Documents/Requisitions/Files/'.$idRequisition;

        for ($i=0; $i <$request->tamanoFiles ; $i++) {
            $nombre="file".$i;
            $archivo = $request->file($nombre);


            $requisitionFile=RequisitionFile::create([
                'requisition_id' => $request->id,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/Documents/Requisitions/Files/'.$idRequisition.'/',

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }

        if ($requisitionFile->save()) {
            $msg="Registro guardado con exito";
        }else{
            $error=true;
            $msg="Error al guardar archvio";
        }



        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }

    public function files($idRequisition)
    {
        $requisitionFiles = Requisition::find($idRequisition)->requisitionFiles;

        $array=["requisitionFiles"=>$requisitionFiles];

        return response()->json($array);
    }
}

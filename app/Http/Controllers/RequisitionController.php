<?php

namespace App\Http\Controllers;

use App\Area;
use App\Requisition;
use Illuminate\Http\Request;
use App\DetailRequisition;
use App\ProvidersRequisitions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        $newRequisition = ($newRequisitionsCount != null) ? $newRequisitionsCount->id + 1 : 1;
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
        $petition = $request->all();
        //print_r($petition['item_descripcion_1']);

        $requisition = new Requisition();
        $requisition->no_requisition = $request->noRequisition;
        $requisition->id_user = $id_user;
        $requisition->id_area = $request->area_id;

        if ($requisition->save()) {
            for ($i=1; $i <= $request->totalItems; $i++) {
                $detailRequisition = new DetailRequisition();
                $detailRequisition->num_item = $i;
                $detailRequisition->id_classification = $petition['item_clasificacion_'.$i];
                $detailRequisition->id_requisition = $requisition->id;
                $detailRequisition->quantity = $petition['item_cantidad_'.$i];
                $detailRequisition->unit = $petition['item_unidad_'.$i];
                $detailRequisition->description = $petition['item_descripcion_'.$i];
                $detailRequisition->model = $petition['item_modelo_'.$i];
                $detailRequisition->preference = $petition['item_referencia_'.$i];
                $detailRequisition->urgency = $petition['item_urgencia_'.$i];
                $detailRequisition->status = $petition['item_status_'.$i];
                $detailRequisition->save();
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
        $user = Auth::user();
        $requisition = Requisition::find($id);
        $detailRequisition = DetailRequisition::where("id_requisition", $id)->get();
        $response = [
            'permission' => $user->area_id,
            'currentUser' => $user->id,
            'requisition'=>$requisition['id'],
            'no_requisition'=>$requisition['no_requisition'],
            'id_area'=>$requisition['id_area'],
            'id_user'=>$requisition['id_user'],
            'detailRequisition'=>$detailRequisition
        ];
        //$array=["requisition"=>$requisition, "detailRequisition"=>$detailRequisition];
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $request, $id)
    {

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

    public function uploadFile(Request $request, $idProject){
        $error=false;
        $msg="";

        $projectName = Requisition::find($idProject)->name;
        $r = $this->getPathFolder($request->folder);
        $pathFile = 'public/Documents/Projects/'.$projectName.$r;

        for ($i=0; $i <$request->tamanoFiles ; $i++) {
            $nombre="file".$i;
            $archivo = $request->file($nombre);


            $projectFile=Requisition::create([
                'project_id' => $request->id,
                'id_padre' => $request->folder,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/Documents/Projects/'.$projectName.$r,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }

        if ($projectFile->save()) {
            $msg="Registro guardado con exito";
        }else{
            $error=true;
            $msg="Error al guardar archvio";
        }



        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }

    public function providers($detail){
        $providers = ProvidersRequisitions::where("id_detail_requisition", $detail)->get();
        $response = [
            'data'=>$providers,
        ];
        return response()->json($response);
    }

    public function saveProvider(Request $request){
        $providerRequisitionUno = new ProvidersRequisitions();
        $providerRequisitionUno->id_detail_requisition = $request->id_detail_requisition;
        $providerRequisitionUno->num_item = $request->num_item;
        $providerRequisitionUno->name = $request->name;
        $providerRequisitionUno->unit_price = $request->unit_price;
        if($providerRequisitionUno->save()){
            $msg = "Proveedor Guardado Correctamente";
            $error = false;
            $array=["msg"=>$msg, "error"=>$error, "provider"=>$providerRequisitionUno];
        }else{
            $msg = "Error al guardar la requisición";
            $error = true;
            $array=["msg"=>$msg, "error"=>$error];
        }

        return response()->json($array);

    }

    public function deleteProvider($id){
        $providerRequisitionUno = ProvidersRequisitions::find($id);
        if($providerRequisitionUno->delete()){
            $msg = "Proveedor Eliminado Correctamente";
            $error = false;
            $array=["msg"=>$msg, "error"=>$error];
        }else{
            $msg = "Error al eliminar la requisición";
            $error = true;
            $array=["msg"=>$msg, "error"=>$error];
        }

        return response()->json($array);

    }

    public function customUpdate(Request $request, $id){
        $error = false;
        $msg = "";
        $petition = $request->all();

        $requisition = Requisition::find($id);
        $reqUpdate = [
            'no_requisition' => $request->noRequisition,
            'id_area' => $request->area_id,
        ];

        if ($requisition->update($reqUpdate)) {
            for ($i=1; $i <= $request->totalItems; $i++) {

                $detailRequisition = DetailRequisition::find($petition['item_id_'.$i]);
                $detUpdate = [
                    'num_item' => $i,
                    'id_classification' => $petition['item_clasificacion_'.$i],
                    'id_requisition' => $id,
                    'quantity' => $petition['item_cantidad_'.$i],
                    'unit' => $petition['item_unidad_'.$i],
                    'description' => $petition['item_descripcion_'.$i],
                    'model' => $petition['item_modelo_'.$i],
                    'preference' => $petition['item_referencia_'.$i],
                    'urgency' => $petition['item_urgencia_'.$i],
                    'status' => $petition['item_status_'.$i],
                ];

                $detailRequisition->update($detUpdate);
            }
        } else {
            $msg = "Error al actualizar la requisición";
            $error = true;
            $array=["msg"=>$msg, "error"=>$error];

            return response()->json($array);
        }

        $msg = "Requisición actualizada correctamente";
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }
}

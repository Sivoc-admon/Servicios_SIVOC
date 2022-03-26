<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = DB::table('assets')
        ->select(DB::raw('assets.*, TIMESTAMPDIFF(MONTH, date_calibration, CURDATE()) as month'))
        ->whereNull('assets.deleted_at')
        ->get();
       
       
       return view('assets.assets',compact('assets'));
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
        $asset=Asset::create([
            'description' => $request->description, 
            'clasification' => $request->costo,
            'day_buy' => $request->buy,
            'calibration' => $request->check,
            'date_calibration' => $request->dayCalibration,
        ]);
        $error=false;
        $msg="";
        
        if ($asset->save()) {
            $pathFile = 'public/Documents/Activos/'.$asset->id.'/General';
            //SE GUARDAN LOS ARCHIVOS GENERALES
            for ($i=0; $i <$request->lengthGeneral ; $i++) { 
                $nombre="generalFile".$i;
                $archivo = $request->file($nombre);
                $assetFile=AssetFile::create([
                    'asset_id' => $asset->id,
                    'name' => $archivo->getClientOriginalName(),
                    'ruta' => 'storage/app/' . $pathFile,
                    'type' => 'General',
    
                ]);
                $path = $archivo->storeAs(
                    $pathFile, $archivo->getClientOriginalName()
                );
            }
            
            if ($assetFile->save()) {
                $msg="Archivos Generales guardados con exito";
            } else {
                $error=true;
                $msg="No se pudieron guardar Archivos Generales";
            }

            if ($request->check == 1) {
                $pathFile = 'public/Documents/Activos/'.$asset->id.'/Calibracion';
                //SE GUARDA LOS ARCHIVOS DE CALIBRACION
                for ($i=0; $i <$request->lengthCalibration ; $i++) { 
                    $nombre="calibrationFile".$i;
                    $archivo = $request->file($nombre);
                    $assetFile2=AssetFile::create([
                        'asset_id' => $asset->id,
                        'name' => $archivo->getClientOriginalName(),
                        'ruta' => 'storage/app/' . $pathFile,
                        'type' => 'Calibracion',
        
                    ]);
                    $path = $archivo->storeAs(
                        $pathFile, $archivo->getClientOriginalName()
                    );
                }
                
                if ($assetFile2->save()) {
                    $msg="Archivos Generales guardados con exito";
                } else {
                    $error=true;
                    $msg="No se pudieron guardar Archivos de calibracion";
                }
            }
 
        }else{
            $error=true;
            $msg="No se guardo el registro";
        }

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::find($id);

        $array=["asset"=>$asset];
        
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $error=false;
        $msg="";
        $check=0;

        $asset = Asset::find($id);

        if($request->checkEditAsset=="on")
        {
            $check=1;
        }else{
            $check=0;
        }
        
        $asset->update([
            'description' => $request->inputEditDescriptionAsset, 
            'clasification' => $request->inputEditCostoAsset,
            'day_buy' => $request->inputEditBuyAsset,
            'calibration' => $check,
            'date_calibration' => $request->inputEditCalibrationDayAsset,
            
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::find($id);
        $asset->delete();
        return redirect()->route('assets.index');
    }

    public function showAssetFiles(Request $request, $asset)
    {
        $files = AssetFile::where('asset_id', $asset)->where('type', $request->tipo)->get();
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "assetfiles"=>$files];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $asset)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/Activos/'.$asset.'/'.$request->tipo;
        //SE GUARDAN LOS ARCHIVOS GENERALES
        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $assetFile=AssetFile::create([
                'asset_id' => $asset,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/app/' . $pathFile,
                'type' => $request->tipo,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        if ($assetFile->save()) {
            $msg="Archivos Generales guardados con exito";
        } else {
            $error=true;
            $msg="No se pudieron guardar Archivos Generales";
        }
            
            

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Area;
use App\InternalAudit;
use App\InternalAuditFile;
use App\User;

class InternalAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $audits = DB::table('internal_audits')
            ->join('users', 'users.id', '=', 'internal_audits.user_id')
            ->join('areas', 'areas.id', '=', 'internal_audits.area_id')
            ->select('users.name as user_name', 'users.last_name', 'users.mother_last_name', 'users.id', 'internal_audits.*', 'areas.id as area_id', 'areas.name as area_name')
            ->whereNull('internal_audits.deleted_at')
            ->get();
        $areas = Area::get();
        $users = User::get();

        return view('internalAudits.internalAudits',compact('audits', 'areas', 'users'));
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
        $msg="";
        $error=false;

        $internalAudit=InternalAudit::create([
            'area_id' => $request->area,            
            'user_id' => $request->evaluador,
            'date_register' => $request->fecha,
            
        ]);

        if ($internalAudit->save()) {
            $pathFile = 'public/Documents/Auditoria_interna/'.$internalAudit->id;

            for ($i=0; $i <$request->tamanoFiles ; $i++) { 
                $nombre="file".$i;
                $archivo = $request->file($nombre);
                $internalAuditFile=InternalAuditFile::create([
                    'internal_audits_id' => $internalAudit->id,
                    'name' => $archivo->getClientOriginalName(),
                    'ruta' => 'storage/app/' . $pathFile,
    
                ]);
                $path = $archivo->storeAs(
                    $pathFile, $archivo->getClientOriginalName()
                );
            }
            
            if ($internalAuditFile->save()) {
                $msg="Registro guardado con exito";
            }else {
                $msg="Error al guardar el archivo";
                $error=true;
            }
            
            
        }else{
            $msg="Error al guardar el registro";
            $error=true;
        }

        $array=["msg"=>$msg, "error"=>$error];
       
        return response()->json($array);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $internalAudit= InternalAudit::find($id);
        $array=["internalAudit"=>$internalAudit];
       
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $internal= InternalAudit::find($id);
        
        
        $internal->update([
            'area_id' => $request->sltEditAreaAudit,            
            'user_id' => $request->inputIdAutor,
            'date_register' => $request->inputEditDateAudit,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $internalAudit = InternalAudit::find($id);
        
        $internalAudit->delete();
        return redirect()->route('internalAudits.index');
    }

    public function showFiles($id)
    {
        $files = InternalAudit::find($id)->auditFiles;
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "files"=>$files];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $id)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/Auditoria_interna/'.$id;

        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $InternalAuditFile=InternalAuditFile::create([
                'internal_audits_id' => $id,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/app/' . $pathFile,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        if ($InternalAuditFile->save()) {
            $msg="Registro guardado con exito";
        }else{
            $error=true;
            $msg="Error al guardar archvio";
        }
            
            

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
    }

    public function destroyFile($id)
    {
        $msg="";
        $error=false;

        $file = InternalAuditFile::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }
}

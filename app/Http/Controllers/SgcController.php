<?php

namespace App\Http\Controllers;

use App\Area;
use App\Sgc;
use App\SgcFile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SgcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sgcs = DB::table('sgc')
            ->join('users', 'users.id', '=', 'sgc.user_id')
            ->select('users.name as user_name', 'users.last_name', 'users.mother_last_name', 'users.id', 'sgc.*')
            ->whereNull('sgc.deleted_at')
            ->orderByDESC('sgc.code')
            ->get();
        $areas = Area::get();
        $users = User::get();
        
        
        return view('sgc.sgc',compact('sgcs', 'areas', 'users'));
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

        $sgc=Sgc::create([
            'code' => $request->codigo,   
            'area_id' => $request->area,         
            'type' => $request->procedimiento,
            'description' => $request->description,
            'create_date' => $request->fechaCreacion,
            'update_date' => $request->fechaActualizacion,
            'user_id' => $request->responsable,
            
        ]);

        if ($sgc->save()) {
            $pathFile = 'public/Documents/SGC/'.$sgc->id;

            for ($i=0; $i <$request->tamanoFiles ; $i++) { 
                $nombre="file".$i;
                $archivo = $request->file($nombre);
                $sgcFile=SgcFile::create([
                    'sgc_id' => $sgc->id,
                    'name' => $archivo->getClientOriginalName(),
                    'ruta' => 'storage/app/' . $pathFile,
                    'revision' => 0,
    
                ]);
                $path = $archivo->storeAs(
                    $pathFile, $archivo->getClientOriginalName()
                );
            }
            
            if ($sgcFile->save()) {
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
     * @param  \App\Sgc  $sgc
     * @return \Illuminate\Http\Response
     */
    public function show(Sgc $sgc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sgc  $sgc
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $sgc = Sgc::find($id);
        $user = User::find($sgc->user_id);
        $areas = Area::get();
        $msg="";
        $error=false;
        
        $array=["msg"=>$msg,"error"=>$error,"sgc"=>$sgc, "user"=>$user, "areas"=>$areas];
       
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sgc  $sgc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $sgc = Sgc::find($id);
        
        $sgc->update([
            'area_id' => $request->sltEditAreaSgc,
            'type' => $request->sltEditTypeSGC,
            'code' => $request->inputEditCodigoSgc,
            'description' => $request->inputEditDescriptionSgc,
            'create_date' => $request->inputEditCreateSgc,
            'update_date' => $request->inputEditUpdateSgc,
            'user_id' => $request->inputEditResponsable,
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sgc  $sgc
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        
        $sgc = Sgc::find($id);
        
        $sgc->delete();
        return redirect()->route('sgc.index');
    }

    public function showFiles($id)
    {
        $files = Sgc::find($id)->sgcFile;
        
        $msg="";
        $error=false;
        
        $user = new User();
        $user = $user->find(Auth::user()->id);
        
        $eliminaArchivo = $user->hasAnyRole(['admin', 'calidad']);
        //$user = Auth::user()->with('role')->get();

        $array=["msg"=>$msg, "error"=>$error, "files"=>$files, "eliminaArchivo"=>$eliminaArchivo];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $sgc)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/SGC/'.$sgc;

        $count = SgcFile::where('sgc_id', $sgc)->get();
        //dd($count);
        if($count->count()>0){
            $count =$count[$count->count()-1]->revision;
        
            
        }else{
            $count = -1;
        }

        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $count++;
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $sgcFile=SgcFile::create([
                'sgc_id' => $request->sgc,
                'name' => $archivo->getClientOriginalName(),
                'revision' => $count,
                'ruta' => 'storage/app/' . $pathFile,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        
        if ($sgcFile->save()) {
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

        $file = SgcFile::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }

    public function updateFile(Request $request, $id)
    {
        $file = SgcFile::find($id);
        
        $msg="";
        $error=false;
        
        $file->update([
            'revision' => $request->revision,
            
        ]);
        
        

        $array=["msg"=>$msg, "error"=>$error, "file"=>$file];

        return response()->json($array);
    }
}

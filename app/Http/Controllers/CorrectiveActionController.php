<?php

namespace App\Http\Controllers;

use App\CorrectiveAction;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\CorrectiveActionFiles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CorrectiveActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correctiveActions = CorrectiveAction::get();
        $allUsers = User::withTrashed()->get(); //todos los usuarios activos e inactivos
        $users = User::get(); //usuarios activos

        return view('correctiveActions.correctiveActions',compact('correctiveActions', 'users', 'allUsers'));
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
        $error=false;
        $msg="";
        
        $arrayIds=explode(",",$request->participant);
        $users = DB::table('users')
                    ->whereIn('id', $arrayIds)->get();
        
        $participantes="";
        foreach ($users as $user) {
            $participantes=$participantes."".$user->name." ".$user->last_name." ".$user->mother_last_name.",";
        }
        
        
        $correctiveAction=CorrectiveAction::create([
            'issue' => $request->issue,            
            'action' => $request->action,
            'involved' => $participantes,
            'user_id' => $request->responsable,
            'status' => $request->status,
        ]);

        if ($correctiveAction->save()) {
            $pathFile = 'public/Documents/Accion_Correctiva/'.$correctiveAction->id;

            for ($i=0; $i <$request->tamanoFiles ; $i++) { 
                $nombre="file".$i;
                $archivo = $request->file($nombre);
                $correctiveActionFile=CorrectiveActionFiles::create([
                    'corrective_action_id' => $correctiveAction->id,
                    'file' => $archivo->getClientOriginalName(),
                    'ruta' => 'storage/app/' . $pathFile,
    
                ]);
                $path = $archivo->storeAs(
                    $pathFile, $archivo->getClientOriginalName()
                );
            }
            
            
            $correctiveActionFile->save();
            $msg="Registro guardado con exito";
            
            
        }else{
            $error=true;
        }

        $array=["msg"=>$msg, "error"=>$error];
       
        return response()->json($array);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CorrectiveAction  $correctiveAction
     * @return \Illuminate\Http\Response
     */
    public function show(CorrectiveAction $correctiveAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CorrectiveAction  $correctiveAction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $correctiveAction = CorrectiveAction::find($id);
        $users = User::withTrashed()->find($correctiveAction->user_id);
        
    
        $msg="";
        $error=false;
        $array=["msg"=>$msg, "error"=>$error, "correctiveAction"=>$correctiveAction, "users"=>$users];
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CorrectiveAction  $correctiveAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $correctiveAction = CorrectiveAction::find($id);
        
        $correctiveAction->update([
            'issue' => $request->inputEditIssiueCorrectiveAction,
            'action' => $request->inputEditActionCorrectiveAction,
            'status' => $request->inputEditStatusCorrectiveAction,
            'user_id' => $request->inputEditNameAutor,
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CorrectiveAction  $correctiveAction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $correctiveAction = CorrectiveAction::find($id);
        $correctiveAction->delete();
        return redirect()->route('correctiveActions.index');
    }

    public function showCorrectiveActionFile($correctiveAction)
    {
        
        $files = CorrectiveAction::find($correctiveAction)->correctiveActionFile;
        $user = new User();
        $user = $user->find(Auth::user()->id);
        
        $eliminaArchivo = $user->hasAnyRole(['admin', 'calidad']);
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "correctiveActionfiles"=>$files, "eliminaArchivo"=>$eliminaArchivo];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $correctiveAction)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/Accion_Correctiva/'.$correctiveAction;

        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $correctiveActionFile=CorrectiveActionFiles::create([
                'corrective_action_id' => $request->correctiveAction,
                'file' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/app/' . $pathFile,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        if ($correctiveActionFile->save()) {
            $msg="Registro guardado con exito";
        }else{
            $error=true;
            $msg="Error al guardar archvio";
        }
            
            

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
    }

    public function destroyfile($id)
    {  
        $file = CorrectiveActionFiles::find($id);
        
        $pathFile = $file->ruta."/".$file->file;
        Storage::delete($pathFile);
        CorrectiveActionFiles::find($id)->delete();

        return redirect()->route('correctiveActions.index');
    }
}

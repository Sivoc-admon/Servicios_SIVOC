<?php

namespace App\Http\Controllers;

use App\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WelcomeFile;
use App\User;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $buttons = DB::table('welcome')
            ->join('welcome_files', 'welcome_files.welcome_id', '=', 'welcome.id')
            ->select('welcome.id', 'welcome.name as button', 'welcome.color', 'welcome_files.name as nameFile', 'welcome_files.ruta')
            ->whereNull('welcome_files.deleted_at')
            ->whereNull('welcome.deleted_at')
            ->get();

        return view('welcome',compact('buttons'));
    }

    public function buttons()
    {

        $buttons = Welcome::get();

        return view('buttons.buttons',compact('buttons'));
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
                 
        $button=Welcome::create([
            'name' => $request->name, 
            'color' => $request->color,
            
        ]);
        $error=false;
        $msg="";
        
        if ($button->save()) {
            $pathFile = 'public/Documents/welcome/'.$button->id;

            for ($i=0; $i <$request->tamanoFiles ; $i++) { 
                $nombre="file".$i;
                $archivo = $request->file($nombre);
                $welcomeFile=WelcomeFile::create([
                    'welcome_id' => $button->id,
                    'name' => $archivo->getClientOriginalName(),
                    'ruta' => 'storage/Documents/welcome/',
    
                ]);
                $path = $archivo->storeAs(
                    $pathFile, $archivo->getClientOriginalName()
                );
            }
            
            
            $welcomeFile->save();
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
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function show(Welcome $welcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $button = Welcome::find($id);
        
        $msg="";
        $error=false;
        $array=["msg"=>$msg, "error"=>$error, "button"=>$button];
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $button = Welcome::find($id);
        
        $button->update([
            'name' => $request->inputEditButton,
            'color' => $request->sltEditColorButton,
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $button = Welcome::find($id);
        $button->delete();
        return redirect()->route('welcome.button');
    }

    public function showButtonFile($minute)
    {
        
        $files = Welcome::find($minute)->welcomeFile;

        $user = new User();
        $user = $user->find(Auth::user()->id);
        
        $eliminaArchivo = $user->hasAnyRole(['admin', 'calidad']);
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "buttonfiles"=>$files, "eliminaArchivo"=>$eliminaArchivo];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $id)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/welcome/'.$id;

        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $welcomeFile=WelcomeFile::create([
                'welcome_id' => $id,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/Documents/welcome/',

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
            
            
           
        
        if ($welcomeFile->save()) {
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

        $file = WelcomeFile::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }
}

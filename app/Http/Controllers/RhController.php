<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Area;
use App\Role;
use App\RhFile;


class RhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        $areas = Area::get();
        $usersEliminados = User::onlyTrashed()->get();
        $users = DB::table('users')
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->select('users.*', 'areas.name as area_name')
            ->whereNull('users.deleted_at')
            ->get();
        
      
        return view('rh.rh',compact('users','roles', 'areas', 'usersEliminados'));
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
        //
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
        $user = User::find($id);
        $roles = Role::get();
        $areas = Area::get();
        $roleUser = User::find($id)->roles;
        $msg="";
        $error=false;
        $array=["msg"=>$msg, "error"=>$error, "user"=>$user, "roles"=>$roles, "areas"=>$areas, "roleUser"=>$roleUser];
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

        
        $user = User::find($id);
        $user->update([
            'name' => $request->input('inputNameRh'),            
            'last_name' => $request->input('inputLastNameRh'),
            'mother_last_name' => $request->input('inputMotherLastNameRh'),
            'area_id' => $request->input('sltAreaRh'),
            'grade' => $request->input('inputEstudios'),
            'profession' => $request->input('inputProfesion'),
            'nss' => $request->input('inputNSS'),
            'age' => $request->input('inputEdad'),
            'gender' => $request->input('sltGenero'),
            'marital_status' => $request->input('inputEstadoCivil'),
            'street' => $request->input('inputDireccion'),
            'telefono' => $request->input('inputTelefono'),
            'contacto' => $request->input('inputContacto'),
            'rfc' => $request->input('inputRFC'),
            'curp' => $request->input('inputCURP')
        ]);

        
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function files($id)
    {
        $files = User::find($id)->rhFiles;
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "files"=>$files];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $empleado)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/RH/'.$empleado;
        
        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $rhFile=RhFile::create([
                'user_id' => $empleado,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => 'storage/app/' . $pathFile,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        if ($rhFile->save()) {
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

        $file = RhFile::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }
}

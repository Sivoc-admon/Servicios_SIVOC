<?php

namespace App\Http\Controllers;

use App\Area;
use App\Customer;
use Illuminate\Http\Request;
use App\Project;
use App\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\User;
use App\ProjectFile;
use App\ProjectFolder;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$projects = Project::get();
        $customers = Customer::get();
        $users = User::get();

        $projects = DB::table('projects')
        ->join('customers', 'projects.client', '=', 'customers.id')
        ->join('users', 'projects.id_user', '=', 'users.id')
        ->select('projects.*', 'customers.code as name_customer', 'users.name as user_name', 'users.last_name', 'users.mother_last_name')
        ->whereNull('adicional')
        ->get();
        $areas = DB::table('areas')->get();
        $colocado= Project::where("status","Colocado")->count();
        $proceso= Project::where("status","Proceso")->count();
        $terminado= Project::where("status","Terminado")->count();

        return view('projects.projects', compact('projects','customers', 'colocado', 'proceso', 'terminado', 'users', 'areas'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = new Project;

        $project->name = $request->input('inputProyecto');
        $project->type = $request->input('sltTypeProject');
        $project->client = $request->input('sltCliente');
        $project->name_project = $request->input('inputNameProject');
        $project->status = $request->input('inputEstatus');
        $project->id_user = auth()->id();

        if($request->input('adicionalProject'))
        {
            $project->adicional = $request->input('adicionalProject');
        }

        $project->save();

        $ventas = new ProjectFolder;

        $ventas->project_id = $project->id;
        $ventas->name = 'VENTAS';
        $ventas->id_padre = '0';

        $ventas->save();



        $r = $this->getPathFolder($ventas->id_padre);
        $projectName = Project::find($ventas->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $ventas->name);

        $supVentas = [
            ['project_id' => $project->id, 'name'=>'PROPUESTAS ECONOMICAS', 'id_padre'=>$ventas->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'ORDEN DE COMPRA', 'id_padre'=>$ventas->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'BASES', 'id_padre'=>$ventas->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'ORDENES DE TRABAJO', 'id_padre'=>$ventas->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
        ];
        foreach ($supVentas as $key) {
            $supVentasFolder = new ProjectFolder;

            $supVentasFolder->project_id = $key['project_id'];
            $supVentasFolder->name = $key['name'];
            $supVentasFolder->id_padre = $key['id_padre'];
            $supVentasFolder->save();
            $r = $this->getPathFolder($supVentasFolder->id_padre);
            $projectName = Project::find($supVentasFolder->project_id)->name;
            Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $supVentasFolder->name);

        }

        $servicio = new ProjectFolder;

        $servicio->project_id = $project->id;
        $servicio->name = 'SERVICIO';
        $servicio->id_padre = '0';

        $servicio->save();

        $r = $this->getPathFolder($servicio->id_padre);
        $projectName = Project::find($servicio->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $servicio->name);

        $supServicio = [
            ['project_id' => $project->id, 'name'=>'REPORTES', 'id_padre'=>$servicio->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'MINUTAS', 'id_padre'=>$servicio->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
        ];
        foreach ($supServicio as $key) {
            $supServicioFolder = new ProjectFolder;
            $supServicioFolder->project_id = $key['project_id'];
            $supServicioFolder->name = $key['name'];
            $supServicioFolder->id_padre = $key['id_padre'];
            $supServicioFolder->save();
            $r = $this->getPathFolder($supServicioFolder->id_padre);
            $projectName = Project::find($supServicioFolder->project_id)->name;
            Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $supServicioFolder->name);
        }

        $compras = new ProjectFolder;
        $compras->project_id = $project->id;
        $compras->name = 'COMPRAS';
        $compras->id_padre = '0';

        $compras->save();

        $r = $this->getPathFolder($compras->id_padre);
        $projectName = Project::find($compras->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $compras->name);

        $supCompra = [
            ['project_id' => $project->id, 'name'=>'PAGO A PROVEEDORES', 'id_padre'=>$compras->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'REPORTES O FACTURAS DE PROVEEDORES', 'id_padre'=>$compras->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
        ];
        foreach ($supCompra as $key) {
            $supCompraFolder = new ProjectFolder;
            $supCompraFolder->project_id = $key['project_id'];
            $supCompraFolder->name = $key['name'];
            $supCompraFolder->id_padre = $key['id_padre'];
            $supCompraFolder->save();
            $r = $this->getPathFolder($supCompraFolder->id_padre);
            $projectName = Project::find($supCompraFolder->project_id)->name;
            Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $supCompraFolder->name);
        }

        $finanza = new ProjectFolder;
        $finanza->project_id = $project->id;
        $finanza->name = 'TESORERIA';
        $finanza->id_padre = '0';

        $finanza->save();

        $r = $this->getPathFolder($finanza->id_padre);
        $projectName = Project::find($finanza->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $finanza->name);

        $supFinanza = [
            ['project_id' => $project->id, 'name'=>'SOLICITUD DE VIATICOS', 'id_padre'=>$finanza->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
        ];
        foreach ($supFinanza as $key) {
            $supFinanzaFolder = new ProjectFolder;
            $supFinanzaFolder->project_id = $key['project_id'];
            $supFinanzaFolder->name = $key['name'];
            $supFinanzaFolder->id_padre = $key['id_padre'];
            $supFinanzaFolder->save();
            $r = $this->getPathFolder($supFinanzaFolder->id_padre);
            $projectName = Project::find($supFinanzaFolder->project_id)->name;
            Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $supFinanzaFolder->name);
        }

        $calidad = new ProjectFolder;
        $calidad->project_id = $project->id;
        $calidad->name = 'CALIDAD';
        $calidad->id_padre = '0';

        $calidad->save();

        $r = $this->getPathFolder($calidad->id_padre);
        $projectName = Project::find($calidad->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $calidad->name);

        $supCalidad = [
            ['project_id' => $project->id, 'name'=>'SALIDAS NO CONFORMES', 'id_padre'=>$calidad->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'CHECK LIST DE PROYECTO', 'id_padre'=>$calidad->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
            ['project_id' => $project->id, 'name'=>'SATISFACCION DE CLIENTE', 'id_padre'=>$calidad->id, 'created_at' => date('Y-m-d H:m:s'), 'updated_at' => date('Y-m-d H:m:s')],
        ];
        foreach ($supCalidad as $key) {
            $supCalidadFolder = new ProjectFolder;
            $supCalidadFolder->project_id = $key['project_id'];
            $supCalidadFolder->name = $key['name'];
            $supCalidadFolder->id_padre = $key['id_padre'];
            $supCalidadFolder->save();
            $r = $this->getPathFolder($supCalidadFolder->id_padre);
            $projectName = Project::find($supCalidadFolder->project_id)->name;
            Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $supCalidadFolder->name);
        }

        return redirect()->action([ProjectController::class, 'index']);
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
        $project = Project::find($id);
        $users = Customer::get();

        $array=["project"=>$project, "users"=>$users];
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
        $project = Project::find($id);


        $project->update([
            'name' => $request->inputEditProyecto,
            'name_project' => $request->inputNameProjectEdit,
            'type' => $request->sltEditTypeProject,
            'client' => $request->sltEditCliente,
            'status' => $request->inputEditEstatus,

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
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('projects');
    }

    public function createBoard(Request $request)
    {
        $board = new Board;

        $board->project_id = $request->input('inputIdProyect');
        $board->name = $request->input('inputNameBoard');


        $board->save();

        return redirect()->action([ProjectController::class, 'index']);
    }

    public function showBoards($id)
    {
        $tableros = DB::table('boards')
        ->join('projects', 'boards.project_id', '=', 'projects.id')
        ->select('boards.*', 'projects.name as name_project')
        ->where('projects.id', $id)
        ->whereNull('boards.deleted_at')
        ->get();

        return response()->json(['data' => $tableros], Response::HTTP_OK);
    }

    public function showFile($id)
    {
        $rolesUser =auth()->user()->roles;
        $files = Project::find($id)->projectFiles;

        $msg="";
        $error=false;


        $array=["msg"=>$msg, "error"=>$error, "projectfiles"=>$files, "rolesUser"=>$rolesUser];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $idProject)
    {
        $error=false;
        $msg="";

        $projectName = Project::find($idProject)->name;
        $r = $this->getPathFolder($request->folder);
        $pathFile = 'public/Documents/Projects/'.$projectName.$r;

        for ($i=0; $i <$request->tamanoFiles ; $i++) {
            $nombre="file".$i;
            $archivo = $request->file($nombre);


            $projectFile=ProjectFile::create([
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

    public function showFolder($idProject)
    {

        $project = Project::find($idProject);
        $projectsAditionals = Project::where('name_project', '=', $project->name_project)
        #->whereNotNull('adicional')
        ->get();
        $tree ="";
        foreach ($projectsAditionals as $adicional) {
            $folders = ProjectFolder::where('id_padre', '=', '0')
            ->where('project_id', '=', $adicional->id)
            ->get();

            if(!$adicional->adicional){
                $tree .= "<li><span class='caret'>".$adicional->name_project."_".$adicional->name."</span>";
            }else{
                $tree .= "<li><span class='caret'>".$adicional->name_project."-".$adicional->adicional."_".$adicional->name."</span>";
            }

            $tree .= "<ul class='nested'>";
            foreach ($folders as $folder) {
                $tree.="<li><span class='caret'>".$folder->name."</span><i style='padding-left: 5px; color: orange;' class='fas fa-folder' onClick='showModal(\"ModalShowFoldersProject\",".$folder->id.", ".$adicional->id.", \"folder\")'></i><i style='padding-left: 5px; color: darkcyan;' class='fas fa-file' onClick='showModal(\"ModalShowFilesProject\",".$folder->id.", ".$adicional->id.", \"file\")'></i>";

                if(count($folder->childs)){

                    $tree .= $this->childView($folder, $adicional->id);
                }



            }
            $tree .= "</li></ul></li>";
        }





        return response()->json(['data' => $tree], Response::HTTP_OK);
    }

    public function childView($folder, $idProject)
    {
        $html = "<ul class='nested'>";
        if(count($folder->files)){
            foreach ($folder->files as $file) {
                $storage =asset($file->ruta.$file->name);
                $html .= "<li><a href=".$storage." target='_blank'>$file->name</a><i style='padding-left: 5px; color: red;' class='fas fa-minus-square' onClick='eliminarArchivo(".$file->id.")'></i></li>";
            }

        }
        foreach ($folder->childs as $arr) {
            if(count($arr->childs)){
                $html .= "<li>";
                $html .= "<span class='caret'>".$arr->name."</span><i style='padding-left: 5px; color: orange;' class='fas fa-folder' onClick='showModal(\"ModalShowFoldersProject\",".$arr->id.", ".$idProject.", \"folder\")'></i><i style='padding-left: 5px; color: darkcyan;' class='fas fa-file' onClick='showModal(\"ModalShowFilesProject\",".$arr->id.", ".$idProject.", \"file\")'></i>";
                $html .= $this->childView($arr, $idProject);
                if(count($arr->files)){
                    foreach ($arr->files as $file) {
                        $html .= "<li><a href='$file->ruta$file->name' target='_blank'>$file->name</a></li>";
                    }

                }

                $html .= "</li>";

            }else{
                $html .= "<li>";
                $html .= "<span>".$arr->name."</span><i style='padding-left: 5px; color: orange;' class='fas fa-folder' onClick='showModal(\"ModalShowFoldersProject\",".$arr->id.", ".$idProject.", \"folder\")'></i><i style='padding-left: 5px; color: darkcyan;' class='fas fa-file' onClick='showModal(\"ModalShowFilesProject\",".$arr->id.", ".$idProject.", \"file\")'></i>";
                if(count($arr->files)){
                    $html .= "<ul>";
                    foreach ($arr->files as $file) {
                        $html .= "<li><a href='$file->ruta$file->name' target='_blank'>$file->name</a><i style='padding-left: 5px; color: red;' class='fas fa-minus-square' onClick='eliminarArchivo(".$file->id.")'></i></li>";
                    }
                    $html .= "</ul>";

                }
                $html .= "</li>";
            }
        }
        $html .= "</ul>";
        return $html;
    }

    public function createFolder(Request $request)
    {
        $folder = new ProjectFolder;

        $folder->project_id = $request->id_proyecto;
        $folder->name = $request->folder;
        $folder->id_padre = $request->id_padre;

        $folder->save();

        $r = $this->getPathFolder($request->id_padre);
        $projectName = Project::find($folder->project_id)->name;
        Storage::makeDirectory('public/Documents/Projects/'. $projectName .'/' . $r . $folder->name);

        return response()->json(['data' => "success"], Response::HTTP_OK);
        //return redirect()->action([ProjectController::class, 'index']);
    }

    private function getPathFolder($folderId){

        $idPadre = -70;
        $path = '';
        if ($folderId != 0) {
            do {
                $folder = ProjectFolder::where('id', $folderId)->get()[0];
                $idPadre = intval($folder->id_padre);
                $nameFolder = $folder->name;
                $folderId = $idPadre;
                $path = $nameFolder . '/' . $path;
            } while ($idPadre != 0);
        }
        return '/' . $path;
    }

    public function showFolderFiles(Request $request, $project_id)
    {
        $folders = DB::table('project_folders')
        ->where('project_id', $project_id)
        ->where('area_id', $request->area_id)
        ->where('id_padre', $request->id_padre)
        ->whereNull('deleted_at')
        ->get();

        $files = DB::table('project_files')
        ->where('project_id', $project_id)
        ->where('id_padre', $request->id_padre)
        ->whereNull('deleted_at')
        ->get();

        return response()->json(['folders' => $folders, 'files'=>$files], Response::HTTP_OK);
    }

    public function adicional($project_id)
    {
        $project = Project::find($project_id);

        $projects = DB::table('projects')
                ->where('name_project', 'like', $project->name_project . '%')
                ->whereNotNull('adicional')
                ->get();
        $totalAdicional = "";
        switch (count($projects)) {
            case 0:
                $totalAdicional = "A";
                break;
            case 1:
                $totalAdicional = "B";
                break;
            case 2:
                $totalAdicional = "C";
                break;
            case 3:
                $totalAdicional = "D";
                break;
            case 4:
                $totalAdicional = "E";
                break;
            case 5:
                $totalAdicional = "F";
                break;
            case 6:
                $totalAdicional = "G";
                break;
            case 7:
                $totalAdicional = "H";
                break;
            default:
                # code...
                break;
        }


        return response()->json(['project' => $project->name_project, 'totalAdicional'=>$totalAdicional], Response::HTTP_OK);
    }

    public function totalProyectos()
    {
        $projects = Project::whereNull('adicional')
                ->get();

        $totalProyectos=0;
        if (count($projects) <= 0) {
            $totalProyectos=1;
        }else{
            $totalProyectos=count($projects)+1;
        }

        return response()->json(['totalProyectos' => $totalProyectos], Response::HTTP_OK);
    }


    public function destroyFile($id)
    {
        $msg="";
        $error=false;

        $file = ProjectFile::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }

    public function destroyBoard($id)
    {
        $msg="";
        $error=false;

        $file = Board::find($id);
        $file->delete();
        $array=["msg"=>$msg, "error"=>$error];

        return response()->json($array);
    }
}

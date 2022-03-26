<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        
        switch ($id) {
            case '1':
                //nivel 1
                $folder = Storage::directories('/public/Documents/areas/almacen');
                foreach ($folder as $key) {
                    $temp_array = explode('/', $key);
                    array_push($file, end( $temp_array ));
                }
                $files = Storage::files('public/Documents/areas/almacen/carpeta 1');
                
                

                /*foreach ($folder as $key) {
                    
                    $temp_array = explode('/', $key);
                   array_push($nivel1, end( $temp_array ));
                   $nivel=array("0"=>);
                   $datos = array(	
	
                        'nivel_1' => array(
                            'marca' => "Bic",
                            'precio'  => "0.75€",
                            'referencia'  => "552BIC12"
                        ),
                        
                        'Pegamento' => array(
                            'marca' => "Pritt",
                            'precio'  => "1.75€",
                            'referencia'  => "567PRI13"
                        )
                    );

                }*/
                
                return view('documents.documents')->with('files', $file);
                break;
            
            default:
                # code...
                break;
        }
        
        
        
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
        return view('documents.documents');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\IndicatorType;
use App\Indicator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::get();
        $indicatorTypes = IndicatorType::get();
        $indicators = DB::table('indicators')
        ->join('areas', 'indicators.area_id', '=', 'areas.id')
        ->join('indicator_type', 'indicators.indicator_type_id', '=', 'indicator_type.id')
        ->select('indicators.*', 'areas.name as area', 'indicator_type.name as tipo_indicador')
        ->get();

        return view('indicators.indicators')->with('areas', $areas)->with('indicators', $indicators)->with('indicatorTypes', $indicatorTypes);
        
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
        //CREAR INDICADORES
        $indicator = new Indicator;
        $pathFile = 'public/Documents/Indicadores';
        $file = $request->files;
        
        $indicator->area_id = $request->idArea;
        $indicator->indicator_type_id = $request->typeIndicator;
        $indicator->value = $request->valorOptenido;
        $indicator->registration_date = $request->fechaRegistro;
        $indicator->ruta = 'storage/app/' . $pathFile;
        $file = $request->file('file');
        $indicator->file_name = $file->getClientOriginalName();
        $path = $file->storeAs(
            $pathFile, $file->getClientOriginalName()
        );

        $indicator->save();

        

        return redirect()->action([IndicatorController::class, 'index']);
        
    }

    //FUNCION PARA CREAR TIPOS DE INDICADORES
    public function createIndicatorType(Request $request)
    {
        $indicatorType = new IndicatorType;

        
        $indicatorType->name = $request->input('inputName');
        $indicatorType->formula = $request->input('inputFormula');
        $indicatorType->min = $request->input('inputMinimo');
        $indicatorType->max = $request->input('inputMaximo');
        

        $indicatorType->save();

        
        return redirect()->action([IndicatorController::class, 'index']);
        
    }

    public function getMinMax(Request $request)
    {
        
        $indicatorType = $request->indicatorType; 
        $minMax = IndicatorType::where('id', $indicatorType)->get();
        
        return response()->json(["message" => "Exitoso.", "minMax" => $minMax], Response::HTTP_OK);
    }

    public function graph(Request $request)
    {
        $area = $request->input('sltAreaGrafica');
        $indicatorType = $request->input('inputIndicatorTypeGrafica');
        $fechaInicial = $request->input('fechaInicial');
        
        
        $grafica = DB::table('indicators')
        ->where('area_id', $area)
        ->where('indicator_type_id', $indicatorType)
        ->where('registration_date', 'LIKE', $fechaInicial.'%')
        ->select(DB::raw('indicators.*, month(registration_date) as month'))
        ->orderBy('month')
        ->get();

        
        $minMax = IndicatorType::find($indicatorType);

        
        $indicators = DB::table('indicators')
        ->join('areas', 'indicators.area_id', '=', 'areas.id')
        ->join('indicator_type', 'indicators.indicator_type_id', '=', 'indicator_type.id')
        ->where('indicators.area_id', $area)
        ->where('indicators.indicator_type_id', $indicatorType)
        ->where('indicators.registration_date', 'LIKE', $fechaInicial.'%')
        ->select('indicators.*', 'areas.name as area', 'indicator_type.name as tipo_indicador')
        ->get();



        return response()->json(["message" => "Exitoso", "grafica" => $grafica, "minMax"=>$minMax, "indicatorsGraph"=>$indicators], Response::HTTP_OK);
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

<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;
use App\RuleFile;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = Rule::get();
        return view('rules.rules', compact('rules'));
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
        $rule = new Rule;
        
        $rule=Rule::create([
            'code' => $request->input('inputClaveRule'),
            'name' => $request->input('inputNameRule'),
            'url' => $request->input('inputUrlRule'),
        ]);
        
        
        $rule->save();

        return redirect()->action([RuleController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(Rule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rule = Rule::find($id);

        $array=["rule"=>$rule];
        
        return response()->json($array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Rule::find($id);
        
        $user->update([
            'code' => $request->inputEditClaveRule,
            'name' => $request->inputEditNameRule,
            'url' => $request->inputEditUrlRule
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy($rule)
    {
        $rule = Rule::find($rule);
        $rule->delete();
        return redirect()->route('rules.index');
    }

    public function showRuleFile($rule)
    {
        
        $files = Rule::find($rule)->ruleFile;
        
        $msg="";
        $error=false;
        

        $array=["msg"=>$msg, "error"=>$error, "rulefiles"=>$files];

        return response()->json($array);
    }

    public function uploadFile(Request $request, $rule)
    {
        $error=false;
        $msg="";
        
        
        $pathFile = 'public/Documents/Normas/'.$rule;

        for ($i=0; $i <$request->tamanoFiles ; $i++) { 
            $nombre="file".$i;
            $archivo = $request->file($nombre);
            $ruleFile=RuleFile::create([
                'rule_id' => $request->rule,
                'name' => $archivo->getClientOriginalName(),
                'ruta' => $pathFile,

            ]);
            $path = $archivo->storeAs(
                $pathFile, $archivo->getClientOriginalName()
            );
        }
        
        if ($ruleFile->save()) {
            $msg="Registro guardado con exito";
        }else{
            $error=true;
            $msg="Error al guardar archvio";
        }
            
            

        $array=["msg"=>$msg, "error"=>$error];
        
        return response()->json($array);
    }
}

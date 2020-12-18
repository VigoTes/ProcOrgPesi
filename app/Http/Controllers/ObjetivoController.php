<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objetivo;
use App\Empresa;
use PhpParser\Node\Expr\Cast\Object_;

class ObjetivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'objEstrX'=>'required|max:200'

            ],[
                'objEstrX.required'=>'Ingrese descripcion de categoria',
                'objEstrX.max' => 'El objetivo puede tener 200 caracteres máximo'
            ]

            );
            $objetivo = new Objetivo();
            $objetivo->descripcionObj=$request->objEstrX; 
            $objetivo->empresa_idEmpresa   = $request->idEmpresaa; // sacmaos el valor del hidden        
            $objetivo->save();      //guardamos la actualizacion
            // ahora tenemos que volver a la vista de empresa.edit

            $empresa = Empresa::findOrFail($request->idEmpresaa);
            $empresaFocus = $empresa ;
            $listaObjetivos=Objetivo::where('empresa_idEmpresa','=',$request->idEmpresaa)->get();
            return view('tablas.empresas.edit',compact('empresa','listaObjetivos','empresaFocus'));


               // return redirect()->route('.index')->with('datos','Registro nuevo guardado');

        

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
    public function edit($idObjetivoEst)
    {
        $objetivo=Objetivo::findOrFail($idObjetivoEst);
        $empresa=Empresa::findOrFail($objetivo->empresa_idEmpresa);
        $empresaFocus = $empresa;
        return view('tablas.objetivos.edit',compact('objetivo','empresa','empresaFocus'));
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

        
        $data=request()->validate([
            'descripcion'=>'required|max:200'
            ],[
            'descripcion.required'=>'Ingrese descripcion de categoria',
            'descripcion.max'=>'Ingrese un maximo de 30 caracteres'
        ]);
        $objetivo=Objetivo::findOrFail($id);
        $objetivo->descripcionObj=$request->descripcion;
        $objetivo->save();
        

        $empresa = Empresa::findOrFail($objetivo->empresa_idEmpresa);
      /*   $empresaFocus =  $empresa;
        $listaObjetivos=Objetivo::where('empresa_idEmpresa','=',$objetivo->empresa_idEmpresa)->get();
         */
        return redirect()->route('empresa.edit',$objetivo->empresa_idEmpresa);


      //  return view('tablas.empresas.edit',compact('empresa','listaObjetivos','empresaFocus'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $objetivo = Objetivo::findOrFail($id);
        $empresa = Empresa::findOrFail($objetivo->empresa_idEmpresa);
        $empresaFocus = $empresa;
        $objetivo->delete();

        $listaObjetivos=Objetivo::where('empresa_idEmpresa','=',$objetivo->empresa_idEmpresa)->get();
        

        return redirect()->route('empresa.edit',$objetivo->empresa_idEmpresa);


        //return view('tablas.empresas.edit',compact('empresa','listaObjetivos','empresaFocus'));

    }

    public function confirmar($id)
    {
        $objetivo = Objetivo::findOrFail($id); 
        $empresaFocus = Empresa::findOrFail($objetivo->empresa_idEmpresa);

        return view('tablas.objetivos.confirmar',compact('objetivo','empresaFocus'));


    }
    
}

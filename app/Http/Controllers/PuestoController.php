<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Objetivo;
use App\Elemento;
use App\Estrategia;
use App\Usuario;
use App\Proceso;
use App\Subproceso;
use App\Area;
use App\Puesto;


class PuestoController extends Controller
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
        //
    }

 
    public function store(Request $request)
    {
        $area = Area::findOrFail($request->idArea);
        $puesto = new Puesto();
        
        $puesto->nombre = $request->nombrePuestoNuevo;
        $puesto->idArea= $area->idArea
        ;
        //ahora calculamos el nro en proceso
        
        //obtenemos la cantidad de Puestos que tiene esta AREA
        $query = Puesto::where('idArea','=',$area->idArea)->get();
        //seleccionamos el idmayor
        $mayor=0;
        foreach ($query as $valor)
            {
                error_log(' X 
                ');
               if($valor->nroEnArea > $mayor)
                     $mayor=$valor->nroEnArea;
             }
        $puesto->nroEnArea = $mayor+1; 
        //ya tenemos el nroEnEmpresa, podemos guardar el valor
        error_log('*******REPORTE***********
        EL NUMERO MAYOR ES : '.$mayor.'
        ');


        $puesto->save();

        //retornamos a la vista de edit area
        return redirect()->route('area.edit', $area->idArea);     

    }

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
    public function edit($id) //le pasamos el id del subproceso a editar
    {
        $puesto = Puesto::findOrFail($id);
        $area = Area::findOrFail($puesto->idArea);
            return view('tablas.puestos.edit',compact('puesto','area'));


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
        $actualizado = Puesto::findOrFail($id); 
        $actualizado->nombre =  $request->nombre;
        $actualizado->save();

        return redirect()->route('area.edit',$actualizado->idArea);


    }

    public function destroy($id)//le pasamos la id del puesto a borrar
    {
        $puesto = Puesto::findOrFail($id);
        $idArea = $puesto->idArea;
        $puesto->delete();

        return redirect()->route('area.edit',$idArea);

    }

    public function confirmar($id){ //pasamos el id del subproceso a borrar
        $puesto = Puesto::findOrFail($id);
        $area = Area::findOrFail($puesto->idArea);
        $empresaFocus = Empresa::findOrFail($area->idEmpresa);
            return view ('tablas.puestos.confirmar',compact('puesto','empresaFocus'));

    }
}

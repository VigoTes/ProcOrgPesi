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
use Illuminate\Support\Facades\Auth;
use App\CambioEdicion;

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
        


        $puesto->save();

         //REGISTRO EN EL HISTORIAL
         $historial = new CambioEdicion();
         $historial->registrarCambio($area->idEmpresa , "Se creó un puesto " ,Auth::id(),
                                     "nroEnArea=".$puesto->nroEnArea.""
                                     ,"nombre = ".$puesto->nombre);
               

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
        $empresaFocus = Empresa::findOrFail($area->idEmpresa);
            return view('tablas.puestos.edit',compact('puesto','area','empresaFocus'));


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
        $area = Area::findOrFail($actualizado->idArea);

        $antValor = $actualizado->nombre;
        $actualizado->nombre =  $request->nombre;
        $actualizado->save();


        //REGISTRO EN EL HISTORIAL
        $historial = new CambioEdicion();
        $historial->registrarCambio($area->idEmpresa , "Se editó un puesto " ,Auth::id(),
                                    "nombreAnt=".$antValor
                                    ,"nombreNuevo = ".$actualizado->nombre);
         

        return redirect()->route('area.edit',$actualizado->idArea);


    }

    public function destroy($id)//le pasamos la id del puesto a borrar
    {
        $puesto = Puesto::findOrFail($id);
        $idArea = $puesto->idArea;
        $area = Area::findOrFail($idArea);

        $puesto->delete();

        //REGISTRO EN EL HISTORIAL
        $historial = new CambioEdicion();
        $historial->registrarCambio($area->idEmpresa , "Se eliminó un puesto " ,Auth::id(),
                                    "puesto eliminado = ".$puesto->nombre
                                    ,"");
         

        return redirect()->route('area.edit',$idArea);

    }

    public function confirmar($id){ //pasamos el id del subproceso a borrar
        $puesto = Puesto::findOrFail($id);
        $area = Area::findOrFail($puesto->idArea);
        $empresaFocus = Empresa::findOrFail($area->idEmpresa);
            return view ('tablas.puestos.confirmar',compact('puesto','empresaFocus'));

    }
}

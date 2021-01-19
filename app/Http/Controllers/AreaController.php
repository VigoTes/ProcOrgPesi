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


class AreaController extends Controller
{
    const PAGINATION = 20; // PARA QUE PAGINEE DE 10 EN 10
    public function index(Request $Request)
    {
    }

    public function listar(Request $Request,$idEmpresa)
    {
       
        if($idEmpresa==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        
        $usuario = Usuario::findOrFail(Auth::id());
        $empresa = Empresa::findOrFail($idEmpresa);

        $buscarpor = $Request->buscarpor;
              
        $area = Area::where('idEmpresa','=',$idEmpresa)
            ->where('nombreArea','like','%'.$buscarpor.'%')
            ->paginate($this::PAGINATION); 

        $empresaFocus = $empresa;
        
        //cuando vaya al index me retorne a la vista
        return view('tablas.areas.index',compact('area','empresaFocus','buscarpor')); 

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //la empresa focuseada en la que crearemos el proceso
    {

   
    }

    public function crear($idEmpresa) //la empresa focuseada en la que crearemos el proceso
    {

        $empresaFocus = Empresa::findOrFail($idEmpresa);
        
        return view('tablas.areas.create',compact('empresaFocus'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $empresaFocus = Empresa::findOrFail($request->idEmpresaFocus);

        $nuevo = new Area;
        $nuevo->descripcionArea = $request->descripcionArea;
        $nuevo->nombreArea = $request->nombreArea;
        $nuevo->idEmpresa = $empresaFocus->idEmpresa;
        //el idArea es Auto Increm, no tengo que ponerlo
        // ahora debo calcular el nro en empresa de este proceso

        error_log('EL IDEMPRESA FOCUSEADO ES '.$empresaFocus->idEmpresa);
        //obtenemos la cantidad de procesos que tiene la empresa
        $query = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
        //seleccionamos el idmayor
        $mayor=0;
        
        foreach ($query as $valor)
            {
                error_log(' X 
                ');
               if($valor->nroEnEmpresa > $mayor)
                     $mayor=$valor->nroEnEmpresa;
             }
        $nuevo->nroEnEmpresa = $mayor+1; 
        //ya tenemos el nroEnEmpresa, podemos guardar el valor
        error_log('*******REPORTE***********
        EL NUMERO MAYOR ES : '.$mayor.'
        ');
        $nuevo->save();

        $idEmpresa = $empresaFocus->idEmpresa;
        $Request = $request;
        return redirect()->route('area.listar',$idEmpresa);
            
   
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
    public function edit($id) //se le manda la id del Area a editar
    {
        $area=Area::findOrFail($id);
        $listaPuestos = Puesto::where('idArea','=',$id)->get();
        $empresaFocus = Empresa::findOrFail($area->idEmpresa);

        return view('tablas.areas.edit',compact('area','listaPuestos','empresaFocus'));
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
        $area = Area::findOrFail($id);
        $area->nombreArea = $request->nombreArea;
        $area->descripcionArea = $request->descripcionArea;
        $area->save();

        return redirect()->route('area.listar',$area->idEmpresa);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $idEmpresa = $area->idEmpresa;
        $area->delete();

        return redirect()->route('area.listar',$idEmpresa);

    }

    public function confirmar($id){
        $area = Area::findOrFail($id);
        $empresaFocus = Empresa::findOrFail($area->idEmpresa);
            return view ('tablas.areas.confirmar',compact('area','empresaFocus'));

    }
}

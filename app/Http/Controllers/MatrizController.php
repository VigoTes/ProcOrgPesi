<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Objetivo;
use App\Elemento;
use App\Estrategia;
use App\Usuario;
use App\CeldaMatriz;
use Illuminate\Support\Facades\DB;
use App\Area;
use App\Proceso;
use App\Puesto;
use App\Subproceso;
use App\Matriz;
use App\CambioEdicion;
use Illuminate\Support\Facades\Auth;

class MatrizController extends Controller
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


    //PARA SELECCIONAR UNA MATRIZ
    public function listar(Request $Request, $id) //id de la empresa
    {
        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        


        $empresa = Empresa::findOrFail($id);
        $listaMatrices = $empresa->matricesDeLaEmpresa();
        //return $listaMatrices;
        $empresaFocus = Empresa::findOrFail($id);

        //cuando vaya al index me retorne a la vista
        return view('tablas.matrizprocorg.listar',compact('empresa','listaMatrices','empresaFocus')); 
        //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact


        // otra forma sería hacer ['categoria'] => $categoria
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      

    }

    public function crear($idEmpresa){
        // RETORNAR VISTA DE CREAR UNA MATRIZ(Solo ponerle descripcion y seleccionar su tipo)


        $empresaFocus = Empresa::findOrFail($idEmpresa);

        return view('tablas.matrizProcOrg.create',compact('empresaFocus'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CREAR UNA NUEVA MATRIZ

        $nuevaMatriz = new Matriz();
        $nuevaMatriz->tipoDeMatriz = $request->tipoMatriz;
        $nuevaMatriz->descripcion = $request->descripcion;

        // ahora debo calcular el nro de la matriz en la empresa


        //  error_log('EL IDEMPRESA FOCUSEADO ES '.$empresaFocus->idEmpresa);
        //obtenemos la cantidad de matrices que tiene la empresa
        $query = Matriz::where('idEmpresa','=',$request->idEmpresaFocus)->get();
        //seleccionamos el idmayor
        $mayor=0;
        
        foreach ($query as $valor)
            {
               if($valor->nroEnEmpresa > $mayor)
                     $mayor=$valor->nroEnEmpresa;
             }
        $nuevaMatriz->nroEnEmpresa = $mayor+1; 
        $nuevaMatriz->idEmpresa = $request->idEmpresaFocus;
        $nuevaMatriz->save();

        //REGISTRO EN EL HISTORIAL
        $historial = new CambioEdicion();
        $historial->registrarCambio($nuevaMatriz->idEmpresa , "Se creó una matriz.",Auth::id(),
                                    "","idMatrizCreada=".$nuevaMatriz->nroEnEmpresa." descripcion=".$nuevaMatriz->descripcion);


        return redirect()->route('matriz.listar',$request->idEmpresaFocus);
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
    public function edit($id) //LE PASAMOS EL id DE LA MATRIZ A EDITAR
    { 
        // FUNCION QUE DESPLIEGA LA VISTA DE EDICION DE LA MATRIZ 

        
        /*
        tipoDeMatriz puede tener los valores
                    FILA        COLUMNA
          1  PxA   Proceso vs Area
          2  PxP   Proceso vs Puesto
          3  SxA   Subpr vs Area
          4  SxP   Subpr vs Puesto
        */
        $tipoMatrizEscrita = "";
        
        $matrizAEditar = Matriz::findOrFail($id);
        $empresaFocus = Empresa::findOrFail($matrizAEditar->idEmpresa);

        switch($matrizAEditar->tipoDeMatriz){
            case 1:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Procesos vs Areas";
                break;
            case 2:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
               // $listaColumnas = Puesto::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Procesos vs Puestos";
                break;
            case 3:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                

                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Subprocesos vs Areas";
                break;
            case 4:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Subprocesos vs Puesto";
                break;
                        

        }



        
        
        $celdaParaFuncion = new CeldaMatriz(); 

        return view('tablas.matrizProcOrg.edit',compact('empresaFocus','listaColumnas','listaFilas','celdaParaFuncion','tipoMatrizEscrita','matrizAEditar'));
    






        
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
    public function destroy($id) //mandamos la id de la matriz a borrar
    {
        //primero borrramos los elementos de esa matriz 
        $msjBorrado = DB::select("
            delete FROM celdamatriz 
                    WHERE idMatriz=$id
                ");
        
            
        $matriz = Matriz::findOrFail($id);
        $idEmpresa = $matriz->idEmpresa;
        $matriz->delete();
        
        //REGISTRO EN EL HISTORIAL
        $historial = new CambioEdicion();
        $historial->registrarCambio($matriz->idEmpresa , "Se borró una matriz.",Auth::id(),
                                    "idMatrizBorrada=".$id."         descripcion=".$matriz->descripcion,"");
         


        return redirect()->route('matriz.listar',$idEmpresa);

    }


    public function confirmar($id)
    {
        //
        $matriz = Matriz::findOrFail($id);
        $empresaFocus = Empresa::findOrFail($matriz->idEmpresa);
        return view('tablas.matrizProcOrg.confirmar',compact('matriz','empresaFocus'));
    }
    

}

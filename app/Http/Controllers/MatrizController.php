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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use PhpOffice\PhpWord;
use PhpOffice\PhpWord\Element\Cell;
use PhpOffice\PhpWord\Style\Font;

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
    
    public function verinforme($id){ //pasamos el id de la matriz
        // FUNCION QUE DESPLIEGA LA VISTA DE INFORME DE LA MATRIZ 
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
        $nombreFilas="";$nombreColumnas=""; // 

        switch($matrizAEditar->tipoDeMatriz){
            case 1:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Procesos vs Areas";
                $nombreFilas = "Procesos"; $nombreColumnas = "Areas";
                break;
            case 2:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
               // $listaColumnas = Puesto::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Procesos vs Puestos";
                $nombreFilas = "Procesos"; $nombreColumnas = "Puestos";
                break;
            case 3:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                

                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Subprocesos vs Areas";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Areas";
                break;
            case 4:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Subprocesos vs Puesto";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Puestos";
                break;
                        

        }
        $celdaParaFuncion = new CeldaMatriz(); 

        $textoDeColumnasSinFilas="";

        $listaColumnasSinFilas = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) SIN FILAS
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinFilas->push($itemColumna->nombre());
            }
        }


        $listaFilasSinColumnas = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinColumnas->push($itemFila->nombre());
            }
        }


        $listaColumnasSinX = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) QUE NO TENGAN NINGUNA X mayuscl
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinX->push($itemColumna->nombre());
            }
        }

        $listaFilasSinX = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinX->push($itemFila->nombre());
            }
        }
        

        //return $listaFilasSinColumnas."                       ".$listaColumnasSinFilas;
        
        return view('tablas.matrizProcOrg.informe',compact('empresaFocus','listaColumnas','listaFilas',
            'celdaParaFuncion','tipoMatrizEscrita','matrizAEditar',
            'nombreFilas','nombreColumnas','listaFilasSinColumnas','listaColumnasSinFilas',
            'listaColumnasSinX','listaFilasSinX'));
        




    }

    public function exportarInformePDF($id){ //LE MANDAMOS LA ID DE LA MATRIZ
        // FUNCION QUE DESPLIEGA LA VISTA DE INFORME DE LA MATRIZ PARA SER IMPRESA EN EL PDF
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
        $nombreFilas="";$nombreColumnas=""; // 

        switch($matrizAEditar->tipoDeMatriz){
            case 1:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Procesos vs Areas";
                $nombreFilas = "Procesos"; $nombreColumnas = "Areas";
                break;
            case 2:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
               // $listaColumnas = Puesto::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Procesos vs Puestos";
                $nombreFilas = "Procesos"; $nombreColumnas = "Puestos";
                break;
            case 3:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                

                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Subprocesos vs Areas";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Areas";
                break;
            case 4:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Subprocesos vs Puesto";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Puestos";
                break;
                        

        }
        $celdaParaFuncion = new CeldaMatriz(); 

        $textoDeColumnasSinFilas="";

        $listaColumnasSinFilas = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) SIN FILAS
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinFilas->push($itemColumna->nombre());
            }
        }


        $listaFilasSinColumnas = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinColumnas->push($itemFila->nombre());
            }
        }

        $listaColumnasSinX = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) QUE NO TENGAN NINGUNA X mayuscl
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinX->push($itemColumna->nombre());
            }
        }

        $listaFilasSinX = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinX->push($itemFila->nombre());
            }
        }

        



            $pdf = PDF::loadView( 
                'tablas.matrizProcOrg.imprinforme',
                    array(
                        'empresaFocus'=>$empresaFocus,'listaColumnas'=>$listaColumnas,'listaFilas'=>$listaFilas,
            'celdaParaFuncion'=>$celdaParaFuncion,'tipoMatrizEscrita'=>$tipoMatrizEscrita,'matrizAEditar'=>$matrizAEditar,
            'nombreFilas'=>$nombreFilas,'nombreColumnas'=>$nombreColumnas,
            'listaFilasSinColumnas'=>$listaFilasSinColumnas,'listaColumnasSinFilas'=>$listaColumnasSinFilas,
            'listaColumnasSinX'=>$listaColumnasSinX,'listaFilasSinX'=>$listaFilasSinX
                            )
                    
                )->setPaper('a4', 'landscape');
             
      /*      $pdf = PDF::loadView(
            redirect()->route('empresa.matriz','id')
                             )->setPaper('a4', 'landscape'); */

        return $pdf->download('informeMatriz.pdf');

    }

    public function exportarInformeWord($id){ //le pasamos la matriz a imprimir
        /* PRIMERO CALCULAMOS LOS DATOS PARA EL INFORME
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
        $nombreFilas="";$nombreColumnas=""; // 

        switch($matrizAEditar->tipoDeMatriz){
            case 1:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Procesos vs Areas";
                $nombreFilas = "Procesos"; $nombreColumnas = "Areas";
                break;
            case 2:
                $listaFilas = Proceso::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
               // $listaColumnas = Puesto::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Procesos vs Puestos";
                $nombreFilas = "Procesos"; $nombreColumnas = "Puestos";
                break;
            case 3:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                

                $listaColumnas = Area::where('idEmpresa','=',$empresaFocus->idEmpresa)->get();
                $tipoMatrizEscrita = "Subprocesos vs Areas";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Areas";
                break;
            case 4:
                $listaFilas = Subproceso::join('proceso','proceso.idProceso','=','subproceso.idProceso')
                    ->where('proceso.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('subproceso.*')->get();
                $listaColumnas = Puesto::join('area','area.idArea','=','puesto.idArea')
                    ->where('area.idEmpresa','=',$empresaFocus->idEmpresa)
                    ->select('puesto.*')->get();
                $tipoMatrizEscrita = "Subprocesos vs Puesto";
                $nombreFilas = "Subprocesos"; $nombreColumnas = "Puestos";
                break;
                        

        }
        $celdaParaFuncion = new CeldaMatriz(); 

        $textoDeColumnasSinFilas="";

        $listaColumnasSinFilas = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) SIN FILAS
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinFilas->push($itemColumna->nombre());
            }
        }


        $listaFilasSinColumnas = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido!=" ")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinColumnas->push($itemFila->nombre());
            }
        }

        $listaColumnasSinX = new Collection();
        // CALCULAMOS LAS COLUMNAS (AREAS/PUESTOS) QUE NO TENGAN NINGUNA X mayuscl
        foreach($listaColumnas as $itemColumna){
            $cadenaFila="";
            foreach($listaFilas as $itemFila){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    
            if(strlen($cadenaFila)==0){
                $listaColumnasSinX->push($itemColumna->nombre());
            }
        }

        $listaFilasSinX = new Collection();
        //CALCULAMOS LAS FILAS (PROC /SUBPR) SIN COLUMNAS
        foreach($listaFilas as $itemFila){
            $cadenaFila="";
            foreach($listaColumnas as $itemColumna){
                $contenido = $celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz);
                if($contenido=="X")
                {
                    $cadenaFila=$cadenaFila.$contenido;
                }
            }    

            if(strlen($cadenaFila)==0){
                $listaFilasSinX->push($itemFila->nombre());
            }
        }

/* ------------------------------------ ARMADO DEL WORD -----------------------------------------  */

        //ESTILO
        
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array("orientation" => "landscape"));

        $section->addText(
            'Empresa: '.$empresaFocus->nombreEmpresa
        );

        $section->addText(
            'RUC: '.$empresaFocus->ruc
        );

        $section->addText(
            "Las siguientes $nombreFilas se encuentran sin $nombreColumnas asignadas:"
        );
        if(count($listaFilasSinColumnas)==0)
            $section->addText("Ninguno");
        foreach($listaFilasSinColumnas as $x)
            $section->addText("    - ".$x);
        

        $section->addText("Los siguientes $nombreColumnas se encuentran sin $nombreFilas asignados:");
        if(count($listaColumnasSinFilas)==0)
            $section->addText("Ninguna");
        foreach($listaColumnasSinFilas as $x)
            $section->addText("    - ".$x);
        

        $section->addText("Los siguientes $nombreColumnas se encuentran sin $nombreFilas de los que ser responsables:");
        if(count($listaColumnasSinX)==0)
            $section->addText("Ninguna");
        foreach($listaColumnasSinX as $x)
            $section->addText("    - ".$x);
        
        $section->addText("Los siguientes $nombreFilas se encuentran sin $nombreColumnas de los que ser responsables:");        
        if(count($listaFilasSinX)==0)
            $section->addText("Ninguna");   
        foreach($listaFilasSinX as $x)
            $section->addText("    - ".$x);
        

        //TABLA
        $styleTable = array('borderSize' => 6, 'borderColor' => '888888', 'cellMargin' => 20);
        $phpWord->addTableStyle('table', $styleTable);
        $table = $section->addTable('table');

       
        //FILA
        $table->addRow();
        $table->addCell()->addText($nombreFilas." \ ".$nombreColumnas);
        foreach ($listaColumnas as $col) {
            $table->addCell()->addText($col->nombre());    
        }


       






        
        foreach($listaFilas as $fila){
            $table->addRow();
            $table->addCell()->addText($fila->nombre());
            foreach($listaColumnas as $col){
                $table->addCell()->addText(
                    $celdaParaFuncion->getContenido($fila->id(),$col->id(),$matrizAEditar->idMatriz)
                );
            }
        }
        

        

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord);
        $objWriter->save('reporteMatriz'.$empresaFocus->nombreEmpresa.'.docx');
        return response()->download('reporteMatriz'.$empresaFocus->nombreEmpresa.'.docx')->deleteFileAfterSend(true);
    }


    
    public function update(Request $request, $id)
    {
        //
    }

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

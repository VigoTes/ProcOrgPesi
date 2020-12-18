<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Objetivo;
use App\Elemento;
use App\Estrategia;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class EmpresaController extends Controller
{
    const PAGINATION = 10; // PARA QUE PAGINEE DE 10 EN 10
    
    

    public function index(Request $Request)
    {
        $buscarpor = $Request->buscarpor;
        $empresa = Empresa::where('estadoAct','=','1')
            ->where('nombreEmpresa','like','%'.$buscarpor.'%')
            ->where('idUsuario','=',Auth::id())
            ->paginate($this::PAGINATION);
        $empresaFocus = new Empresa();
        $empresaFocus->nombreEmpresa = 'Ninguna';
        $empresaFocus->idEmpresa = 0;

        //cuando vaya al index me retorne a la vista
        return view    ('tablas.empresas.index',compact('empresa','buscarpor','empresaFocus')); 
        //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact


        // otra forma sería hacer ['categoria'] => $categoria
    }



    //PARA SELECCIONAR UNA EMPRESA Y QUE ESTÉ EN FOCUS PUES 
    public function listar(Request $Request, $id) //MTODO PROBANDO BORRAR SI QUIERES
    {
        $buscarpor = $Request->buscarpor;
        $empresa = Empresa::where('estadoAct','=','1')
            ->where('nombreEmpresa','like','%'.$buscarpor.'%')
            ->where('idUsuario','=',Auth::id())
            ->paginate($this::PAGINATION);
        $empresaFocus = Empresa::findOrFail($id);

        //cuando vaya al index me retorne a la vista
        return view('tablas.empresas.index',compact('empresa','buscarpor','empresaFocus')); 
        //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact


        // otra forma sería hacer ['categoria'] => $categoria
    }
    

    public function create()
    {

        $empresaFocus = new Empresa();
        $empresa=$empresaFocus;
        $empresaFocus->nombreEmpresa = 'Ninguna';
        $empresaFocus->idEmpresa = 0;


        return view('tablas.empresas.create',compact('empresa','empresaFocus'));
    }

    public function store(Request $request)
    {
        
        $empresa = request()->validate(
            [
                'nombreEmpresa'=>'required|max:100',
                'mision'=>'required|max:1000',
                'vision'=>'required|max:1000',
                'factorDif'=>'required|max:1000',
                'propuestaV'=>'required|max:100',
                'direccion'=>'required|max:200',
                'RUC'=>'required|size:13'
                
            ],[
                'nombreEmpresa.required'=>'Ingrese nombre de la Empresa',
                'nombreEmpresa.max' => 'Maximo 100 caracteres la descripcion',
                 
                'mision.required'=>'Ingrese la mision de la Empresa',
                'mision.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'vision.required'=>'Ingrese la mision de la Empresa',
                'vision.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'factorDif.required'=>'Ingrese el factor diferenciador',
                'factorDif.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'propuestaV.required'=>'Ingrese la propuesta de valor',
                'propuestaV.max' => 'Maximo 100 caracteres la descripcion',
                 
                'direccion.required'=>'Ingrese la direccion de la empresa',
                'direccion.max' => 'Maximo 200 caracteres la descripcion',

                'RUC.required'=>'Ingrese el ruc de la empresa',
                'RUC.size' => 'Debe tener 13 caracteres'

            ]

            );

            

            $empresa = new Empresa();
            $empresa->nombreEmpresa=$request->nombreEmpresa;
            $empresa->mision=$request->mision;
            $empresa->vision=$request->vision;
            $empresa->factorDif=$request->factorDif;
            $empresa->propuestaV=$request->propuestaV;
            $empresa->direccion=$request->direccion;
            $empresa->RUC=$request->RUC;
            $empresa->estadoAct='1';
            $empresa->idUsuario = Auth::user()->id;
                          
            $empresa->save(); /* Guardamos el nuevo registro en la BD */
                
            /* Regresamos al index con el mensaje de nuevo registro */
            return redirect()->route('empresa.index')->with('msjLlegada','Registro nuevo guardado');
                
        }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
                
        $empresa=Empresa::findOrFail($id);
        $listaObjetivos=Objetivo::where('empresa_idEmpresa','=',$id)->get();
        $empresaFocus = $empresa; 

        return view('tablas.empresas.edit',compact('empresa','listaObjetivos','empresaFocus'));


    }

    public function update(Request $request, $id)
    {
        $empresa = request()->validate(
            [
                'nombreEmpresa'=>'required|max:100',
                'mision'=>'required|max:1000',
                'vision'=>'required|max:1000',
                'factorDif'=>'required|max:1000',
                'propuestaV'=>'required|max:100',
                'direccion'=>'required|max:200',
                'RUC'=>'required|size:13'
                
            ],[
                'nombreEmpresa.required'=>'Ingrese nombre de la Empresa',
                'nombreEmpresa.max' => 'Maximo 100 caracteres la descripcion',
                 
                'mision.required'=>'Ingrese la mision de la Empresa',
                'mision.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'vision.required'=>'Ingrese la mision de la Empresa',
                'vision.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'factorDif.required'=>'Ingrese el factor diferenciador',
                'factorDif.max' => 'Maximo 1000 caracteres la descripcion',
                 
                'propuestaV.required'=>'Ingrese la propuesta de valor',
                'propuestaV.max' => 'Maximo 100 caracteres la descripcion',
                 
                'direccion.required'=>'Ingrese la direccion de la empresa',
                'direccion.max' => 'Maximo 200 caracteres la descripcion',

                'RUC.required'=>'Ingrese el ruc de la empresa',
                'RUC.size' => 'El Ruc Debe tener 13 caracteres'
            ]

            );

            $empresa=Empresa::findOrFail($id);
            $empresa->nombreEmpresa=$request->nombreEmpresa;
            $empresa->mision=$request->mision;
            $empresa->vision=$request->vision;
            $empresa->factorDif=$request->factorDif;
            $empresa->propuestaV=$request->propuestaV;
            $empresa->direccion=$request->direccion;
            $empresa->RUC=$request->RUC;
                          
            $empresa->save(); /* Guardamos el nuevo registro en la BD */
                
            /* Regresamos al index con el mensaje de nuevo registro */
            return redirect()->route('empresa.index')->with('msjLlegada','Registro editado Exitosamente');
             
    }

    public function destroy($id)
    {

        $empresa = Empresa::findOrFail($id);
        $empresa->estadoAct = '0';
        $empresa->save ();
        return redirect() -> route('empresa.index')->with('msjLlegada','Registro eliminado!!');

    }

    public function confirmar($id){
        $empresa = Empresa::findOrFail($id); 
        return view('tablas.empresas.confirmar',compact('empresa'));
    }

    /* FUNCION PARA REDIRIGIRNOS A LA MATRIZ FODA DE ESTA EMPRESA
        MANDANDOLE COMO PARAMETRO LA EMPRESA
    */
    public function foda($id){
            // DESPLIEGA LA VISTA DE FODA HACIENDO SELECTS DE LA BD 
        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        
        $bandera=false;
        if($id<0){
            $id=-$id;
            $bandera=true;
        }

        $empresa = Empresa::findOrFail($id); 
        $empresaFocus = $empresa;
        
        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();

       // return redirect()->route('empresa.foda',$id)->with('msjLlegada','Registro nuevo guardado');
       if($bandera) //error del tipo: 
                 return redirect() -> route('empresa.foda',$id)->with('msjLlegada','Error: este elemento se está usando en alguna estrategia.');

        
                 return view('tablas.foda.index',compact('empresa',
                    'fortalezas','debilidades','oportunidades','amenazas',
                    'empresaFocus'));
        
    }
    


    public function estrategiasFO($id){
        // DESPLIEGA LA VISTA DE ESTRATEGIAS HACIENDO SELECTS DE LA BD 
        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        

        $empresa = Empresa::findOrFail($id); 
        $empresaFocus = $empresa;
        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();

        $estrategiasFO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FO')->get();

    // return redirect()->route('empresa.foda',$id)->with('msjLlegada','Registro nuevo guardado');
            
        return view('tablas.estrategias.FO',compact('empresa','fortalezas','oportunidades','estrategiasFO','empresaFocus'));    
    }

    public function estrategiasFA($id){
        // DESPLIEGA LA VISTA DE ESTRATEGIAS HACIENDO SELECTS DE LA BD 
        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        

        $empresa = Empresa::findOrFail($id); 
        $empresaFocus = $empresa;

        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();

        $estrategiasFA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FA')->get();


        return view('tablas.estrategias.FA',compact('empresa','fortalezas','amenazas','estrategiasFA','empresaFocus'));    
    }
    
    public function estrategiasDO($id){
        // DESPLIEGA LA VISTA DE ESTRATEGIAS HACIENDO SELECTS DE LA BD 

        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        
        $empresa = Empresa::findOrFail($id); 
        $empresaFocus = $empresa;

        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();

        $estrategiasDO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DO')->get();


        return view('tablas.estrategias.DO',compact('empresa','debilidades','oportunidades','estrategiasDO','empresaFocus'));    
    }
    
    public function estrategiasDA($id){
        // DESPLIEGA LA VISTA DE ESTRATEGIAS HACIENDO SELECTS DE LA BD 

        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        
        $empresa = Empresa::findOrFail($id); 

        $empresaFocus = $empresa;
        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();

        $estrategiasDA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DA')->get();


        return view('tablas.estrategias.DA',compact('empresa','debilidades','amenazas','estrategiasDA','empresaFocus'));    
    }
    
    public function matriz($id){ // le pasamos el id de la empresa

        if($id==0) //si no ha seleccionado una empresa, lo redirije al index para que escoja una
            return redirect()->route('empresa.index')->with('msjLlegada','Error: Debe escoger una empresa para editar.');
        
        $empresa = Empresa::findOrFail($id);
        $empresaFocus = $empresa;
        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();


        $estrategiasFO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FO')->get();
        $estrategiasFA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FA')->get();
        $estrategiasDO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DO')->get();
        $estrategiasDA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DA')->get();

        return view('tablas.matriz.index',
            compact('empresa',
            'fortalezas','debilidades','oportunidades','amenazas',
            'estrategiasFO','estrategiasFA','estrategiasDO','estrategiasDA',
            'empresaFocus'
            ));    
    


    }

    public function ExportarPDF($id){
        //COMANDO PARA EL COMPLEMENTO PARA PDF
        //composer require barryvdh/laravel-dompdf
        //COMPOSER: es un gestor para dependencias de laravel en la nube (se guarda en vendor)
        $empresa = Empresa::findOrFail($id);
        $empresaFocus = $empresa;

        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();


        $estrategiasFO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FO')->get();
        $estrategiasFA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FA')->get();
        $estrategiasDO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DO')->get();
        $estrategiasDA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DA')->get();



/*         $pdf = PDF::loadView( 
            view('tablas.matriz.index',
                compact('empresa',
                'fortalezas','debilidades','oportunidades','amenazas',
                'estrategiasFO','estrategiasFA','estrategiasDO','estrategiasDA',
                'empresaFocus'
                        )
                )
            )->setPaper('a4', 'landscape');
 */

            $pdf = PDF::loadView( 
                'tablas.matriz.imprimir',
                    array('empresa'=>$empresa,
                    'fortalezas'=>$fortalezas,'debilidades'=>$debilidades,'oportunidades'=>$oportunidades,'amenazas'=>$amenazas,
                    'estrategiasFO'=>$estrategiasFO,'estrategiasFA'=>$estrategiasFA,'estrategiasDO'=>$estrategiasDO,'estrategiasDA'=>$estrategiasDA,
                    'empresaFocus'=>$empresaFocus
                            )
                    
                )->setPaper('a4', 'landscape');
             


      /*      $pdf = PDF::loadView(
            redirect()->route('empresa.matriz','id')
                             )->setPaper('a4', 'landscape'); */

        return $pdf->download('MatrizFODA.pdf');

    }
 
    
    public function imprimir($id){
        //COMANDO PARA EL COMPLEMENTO PARA PDF
        //composer require barryvdh/laravel-dompdf
        //COMPOSER: es un gestor para dependencias de laravel en la nube (se guarda en vendor)
        $empresa = Empresa::findOrFail($id);
        $empresaFocus = $empresa;

        $fortalezas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','F')->get();
        $debilidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','D')->get();
        $oportunidades = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','O')->get();
        $amenazas = Elemento::where('empresa_idEmpresa','=',$id)
        ->where('tipo','=','A')->get();


        $estrategiasFO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FO')->get();
        $estrategiasFA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','FA')->get();
        $estrategiasDO = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DO')->get();
        $estrategiasDA = Estrategia::where('idEmpresa','=',$id)
        ->where('tipo','=','DA')->get();

 

            return view( 
                'tablas.matriz.imprimir',
                    array('empresa'=>$empresa,
                    'fortalezas'=>$fortalezas,'debilidades'=>$debilidades,'oportunidades'=>$oportunidades,'amenazas'=>$amenazas,
                    'estrategiasFO'=>$estrategiasFO,'estrategiasFA'=>$estrategiasFA,'estrategiasDO'=>$estrategiasDO,'estrategiasDA'=>$estrategiasDA,
                    'empresaFocus'=>$empresaFocus
            ));


    }

    




}

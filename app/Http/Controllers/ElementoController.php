<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elemento;
use App\Empresa;
use App\Estrategia;

class ElementoController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // FUNCION PARA METER A LA BD UN NUEVO ELEMENTO DE LA MATRIZ FODA 
        /* 
            F O D A
        ACTIVAR VALIDACIONES 
        */
        
        $empresa = request()->validate(
            [
                'descripcion'=>'required|max:200',
            ],[
                'descripcion.required'=>'Ingrese la descripcion',
                'descripcion.max' => 'El elemento puede tener Maximo 200 caracteres'
            ]);
        
            $elemento = new Elemento();
            $elemento->descripcion       =$request->descripcion;
            $elemento->tipo              =$request->tipoElemento;
            $elemento->empresa_idEmpresa = $request->idEmpresa;

            //obtenemos la cantidad de elementosFODA de ese tipo(F) que tiene la empresa
            $query = Elemento::where('empresa_idEmpresa','=',$request->idEmpresa)
                    ->where('tipo','=',$request->tipoElemento)->get();
            
            //seleccionamos el idmayor
            $mayor=0;
      
            foreach ($query as $valor)
                {
                    if($valor->nroEnEmpresa > $mayor)
                    $mayor=$valor->nroEnEmpresa;
                }
            $elemento->nroEnEmpresa = $mayor+1;       //le sumamos 1 porque tiene que ser A.I
            
            $elemento->save(); /* Guardamos el nuevo registro en la BD */
                
            
            $empresa = Empresa::findOrFail($request->idEmpresa); 

             
            return redirect() -> route('empresa.foda',$request->idEmpresa)->with('msjLlegada','Registro Creado!!');

            
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
        $elemento = Elemento::findOrFail($id);
        return view('tablas.foda.edit',compact('elemento'));
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
        $elemento=Elemento::findOrFail($id);
        $elemento->descripcion =$request->descripcion;
        $elemento->save();
        

        
        return redirect() -> route('empresa.foda',$elemento->empresa_idEmpresa)->with('msjLlegada','Registro Creado!!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //id del elemento a borrar
    {
        $elemento = Elemento::findOrFail($id);
        $idEmpresa = $elemento->empresa_idEmpresa;
        $nroEnEmpresa = $elemento->nroEnEmpresa;
        //buscamos a las estrategias que contentan a este elemento
        $query = Estrategia::where('idEmpresa','=',$idEmpresa) //misma empresa
                    ->where('tipo','like','%'.$elemento->tipoElemento.'%')//que contenga a este TIPO
                    ->get(); 

        foreach ($query as $valor)
                {
                    switch ($elemento->tipo) {
                        case 'F': //tenemos que buscar en los FO y FA , id1
                            $cadF = $valor->id1;
                            $array = explode("&",$cadF);
                            if(in_array($nroEnEmpresa, $array)) //SI ENCUENTRA ESTE NROEMPRESA en alguna estrategia, reotrna error
                              return redirect() -> route('empresa.foda',$idEmpresa*(-1));
                              
                            

                            break;
                        case 'O':
                            $cadO = $valor->id2;
                            $array = explode("&",$cadO);
                            if(in_array($nroEnEmpresa, $array)) //SI ENCUENTRA ESTE NROEMPRESA en alguna estrategia, reotrna error
                              return redirect() -> route('empresa.foda',$idEmpresa*(-1));
                            


                            break;
                        case 'D':
                            $cadD = $valor->id1;
                            $array = explode("&",$cadD);
                            if(in_array($nroEnEmpresa, $array)) //SI ENCUENTRA ESTE NROEMPRESA en alguna estrategia, reotrna error
                              return redirect() -> route('empresa.foda',$idEmpresa*(-1));
                            


                            break;
                        case 'A':
                            $cadA = $valor->id2;
                            $array = explode("&",$cadA);
                            if(in_array($nroEnEmpresa, $array)) //SI ENCUENTRA ESTE NROEMPRESA en alguna estrategia, reotrna error
                              return redirect() -> route('empresa.foda',$idEmpresa*(-1));
                                
                        
                            break;     

                    }

                }
                    


                    $elemento->delete();
        return redirect() -> route('empresa.foda',$idEmpresa)->with('msjLlegada','Registro Eliminado.');


    }
    public function confirmar($id)
    {
        $elemento = Elemento::findOrFail($id); 
        return view('tablas.foda.confirmar',compact('elemento'));


    }



}

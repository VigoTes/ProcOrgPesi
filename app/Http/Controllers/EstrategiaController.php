<?php

namespace App\Http\Controllers;

use App\Estrategia;
use Illuminate\Http\Request;
use App\Empresa;
use App\Elemento;;

class EstrategiaController extends Controller
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

     //ESTE STORE FUNCIONA PARA LAS 4 ESTRATEGIAS FO FA DO DA
    public function store(Request $request)
    {

        // Obtenemos los checkbox que han sido seleccionados
        $cadF = "";
        for($i=0;$i<100;$i++)
        {
            if(isset($_POST['CB_F'.$i]))
            $cadF = $cadF.$i.'&';
        }
        $cadF = trim($cadF, '&');
        
        $i=0;
        $cadO = "";
        for($i=0;$i<100;$i++)
        {
            if(isset($_POST['CB_O'.$i]))
            $cadO = $cadO.$i.'&';
        }
        $cadO = trim($cadO, '&');
        
        $cadD = "";
        for($i=0;$i<100;$i++)
        {
            if(isset($_POST['CB_F'.$i]))
            $cadD = $cadD.$i.'&';
        }
        $cadD = trim($cadD, '&');
        
        $i=0;
        $cadA = "";
        for($i=0;$i<100;$i++)
        {
            if(isset($_POST['CB_O'.$i]))
            $cadA = $cadA.$i.'&';
        }
        $cadA = trim($cadA, '&');
        
        

        $estrategia = new Estrategia();
        $estrategia->descripcion  = $request->descripcion;
        $estrategia->tipo  = $request->tipoEstrategia;
        $estrategia->idEmpresa = $request->idEmpresa;
        
        $tipoX =  $estrategia->tipo;

        $id = $request->idEmpresa;
 
        switch ($tipoX) {
            case "FO":
                $estrategia->id1 = $cadF;
                $estrategia->id2 = $cadO;
                if( strlen($cadF) < 1 or strlen($cadO)< 1 )
                    return redirect()->route('empresa.estrategiasFO',$id);

                break;  
            case 'FA':
                $estrategia->id1 = $cadF;
                $estrategia->id2 = $cadA;
                if( strlen($cadF) < 1 or strlen($cadA)<1 )
                    return redirect()->route('empresa.estrategiasFA',$id);
                
                break;
            case 'DO':
                $estrategia->id1 = $cadD;
                $estrategia->id2 = $cadO;
                if( strlen($cadD) < 1 or strlen($cadO)<1 )
                    return redirect()->route('empresa.estrategiasDO',$id);
                
                break;
            case 'DA':
                $estrategia->id1 = $cadD;
                $estrategia->id2 = $cadA;
                if( strlen($cadD) < 1 or strlen($cadA)<1 )
                    return redirect()->route('empresa.estrategiasDA',$id);
                
                break;  
        }
        $estrategia->save();
         
            switch ($tipoX) {
                case "FO":
                    return redirect()->route('empresa.estrategiasFO',$id);

                    break;
                case 'FA':
                    return redirect()->route('empresa.estrategiasFA',$id);

                    break;
                case 'DO':
                    return redirect()->route('empresa.estrategiasDO',$id);

                    break;
                case 'DA':
                    return redirect()->route('empresa.estrategiasDA',$id);

                    break;  
            }

       

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
        $estrategia=Estrategia::findOrFail($id);
        $empresaFocus = Empresa::findOrFail($estrategia->idEmpresa);
        return view('tablas.estrategias.edit',compact('estrategia','empresaFocus'));
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
        
        $estrategia = Estrategia::findOrFail($id);
        $estrategia->descripcion = $request->descripcion;
        $idEmpresa = $estrategia->idEmpresa;
        $estrategia->save();
        $tipoX = $estrategia->tipo;


        switch ($tipoX) {
            case "FO":

                return redirect()->route('empresa.estrategiasFO',$idEmpresa);

               
                break;
            case 'FA':
                return redirect()->route('empresa.estrategiasFA',$idEmpresa);

                break;
            case 'DO':
                return redirect()->route('empresa.estrategiasDO',$idEmpresa);

                break;
            case 'DA':
                return redirect()->route('empresa.estrategiasDA',$idEmpresa);

                break;  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)// id de la estrategia a borrar
    {
        $estrategia = Estrategia::findOrFail($id);
        $empresa = Empresa::findOrFail($estrategia->idEmpresa);

        $tipoX= $estrategia->tipo;

        //$listaObjetivos=Objetivo::where('empresa_idEmpresa','=',$objetivo->empresa_idEmpresa)->get();
        
        
        $idEmpresa = $estrategia->idEmpresa;

        $estrategia->delete();
 
        

        switch ($tipoX) {
            case "FO":

                return redirect()->route('empresa.estrategiasFO',$idEmpresa);

               
                break;
            case 'FA':
                return redirect()->route('empresa.estrategiasFA',$idEmpresa);

                break;
            case 'DO':
                return redirect()->route('empresa.estrategiasDO',$idEmpresa);

                break;
            case 'DA':
                return redirect()->route('empresa.estrategiasDA',$idEmpresa);

                break;  
        }
        
            return view('pruebas');

    }

    public function confirmar($id){
        $estrategia = Estrategia::findOrFail($id); 
        $empresaFocus = Empresa::findOrFail($estrategia->idEmpresa);
        return view('tablas.estrategias.confirmar',compact('estrategia','empresaFocus'));
    }


    // ME RETORNA A LA VISTA DE ESTRATEGIA FO FA DO DA EN LA QUE ESTABA
    public function cancelar($id){ // id de la estrategia

        $estrategia = Estrategia::findOrFail($id);
        $tipoX= $estrategia->tipo;
        $idEmpresa = $estrategia->idEmpresa;
        switch ($tipoX) {
            case "FO":
                return redirect()->route('empresa.estrategiasFO',$idEmpresa);
                break;
            case 'FA':
                return redirect()->route('empresa.estrategiasFA',$idEmpresa);
                break;
            case 'DO':
                return redirect()->route('empresa.estrategiasDO',$idEmpresa);
                break;
            case 'DA':
                return redirect()->route('empresa.estrategiasDA',$idEmpresa);
                break;  
        }
    }

}

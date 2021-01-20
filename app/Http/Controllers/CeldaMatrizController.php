<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\CeldaMatriz;


class CeldaMatrizController extends Controller
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
    public function retornarAMatriz($mensaje,$idMatriz){
        return redirect()->route('matriz.edit',$idMatriz)
                ->with('msjLlegada',$mensaje);
    }

    public function store(Request $request)
    {
        $idFila=-1;
        
        $empresa = Empresa::findOrFail($request->idEmpresa);
        

        $idFila = str_replace("RB_F","",$request->filas);
        $idColumna = str_replace("RB_C","",$request->columnas);
        $idMatriz = $request->idMatriz;
        $tipoDeMarca = $request->tipoMarca;

        if($idFila=="" || $idColumna ==""){
            return $this->retornarAMatriz("Error: Debe seleccionar una celda",$request->idMatriz);
        }
        if($tipoDeMarca=="")
            return $this->retornarAMatriz("Error: Debe seleccionar una marca",$request->idMatriz);

        $celdaOcupada=false;
        //buscamos si ya hay un elemento en esa posicion
        $query = CeldaMatriz::where('idFila','=',$idFila)
            ->where('idColumna','=',$idColumna)->get();
        if(count($query)!=0){
            $celdaOcupada=true;
        }

        if($tipoDeMarca=="*")// SI VAMOS A BORRAR UNA MARCA CREADA
        {
            if($celdaOcupada){
                error_log('Borrando la celda idCelda='.$query[0]->idCelda );
                try {
                    $celdaABorrar = CeldaMatriz::findOrFail($query[0]->idCelda);
                    $celdaABorrar->delete();
                } catch (\Throwable $th) {
                    error_log('EXCEPCION CATCH:'.$th);
                }
                
            }else{
                return $this->retornarAMatriz("Error: No se puede borrar la celda pues no tiene contenido",
                                                        $request->idMatriz);
                
            }   
        }else{ // SI VAMOS A CREAR UNA NUEVA MARCA

            if($celdaOcupada)
                return $this->retornarAMatriz("Error: Error: La celda seleccionada está ocupada",
                                                        $request->idMatriz);
            

            $nuevaCelda = new CeldaMatriz(); 
            $nuevaCelda->idFila = $idFila;
            $nuevaCelda->idColumna=$idColumna;
            $nuevaCelda->idMatriz = $idMatriz;
            $nuevaCelda->contenido=$tipoDeMarca;
            $nuevaCelda->save();
            

        }
        

        return redirect()->route('matriz.edit',$request->idMatriz);


        //return 'La idFila es:'.$idFila.' La idColumna es:'.$idColumna.'  El tipoDeMatriz='.$empresa->tipoDeMatriz;
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
        //
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
    public function destroy($id)
    {
        //
    }
}

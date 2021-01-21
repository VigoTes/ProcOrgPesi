<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;
use App\Usuario;
use Carbon\Carbon;

class CambioEdicion extends Model
{
    //
    //
    protected $table = "cambioedicion";
    protected $primaryKey = "idCambio";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

        // le indicamos los campos de la tabla 
        protected $fillable = ['idEmpresa','nroCambioEnEmpresa','fechaHoraCambio','descripcionDelCambio','idUsuario','anteriorValor','nuevoValor'];

    public function empresa(){
        return Empresa::findOrFail($this->idEmpresa);
    }

    public function usuario(){
        return Usuario::findOrFail($this->idUsuario);
    }


    /*
        $historial = new CambioEdicion();
        $historial->registrarCambio($idEmpresa, $descripcionDelCambio,$idUsuario,$antValor,$nueValor);


    */
    public function registrarCambio($idEmpresa, $descripcionDelCambio,$idUsuario,$antValor,$nueValor){
        $nuevoRegistro = new CambioEdicion();
        $nuevoRegistro->idEmpresa = $idEmpresa;
        
        //$nuevoRegistro->fechaHoraCambio = date("Y-m-d H:i:s");
        $nuevoRegistro->fechaHoraCambio = Carbon::now()->subHours(5);
        //Le resto 5 horas porque, por defecto la hora está en londres (5h adelantado)

        $nuevoRegistro->descripcionDelCambio = $descripcionDelCambio;
        $nuevoRegistro->idUsuario =  $idUsuario;
        $nuevoRegistro->anteriorValor =  $antValor;
        $nuevoRegistro->nuevoValor =  $nueValor;

        // ahora debo calcular el nro en empresa de este proceso

    
        //obtenemos la cantidad de procesos que tiene la empresa
        $query = CambioEdicion::where('idEmpresa','=',$idEmpresa)->get();
        //seleccionamos el idmayor
        $mayor=0;
        foreach ($query as $valor)
            {
               if($valor->nroCambioEnEmpresa > $mayor)
                     $mayor=$valor->nroCambioEnEmpresa;
             }
        $nuevoRegistro->nroCambioEnEmpresa = $mayor+1; 


       // return $nuevoRegistro;
        $nuevoRegistro->save();


    }

}

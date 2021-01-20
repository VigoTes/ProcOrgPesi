<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CeldaMatriz extends Model
{
    //
    protected $table = "celdamatriz";
    protected $primaryKey = "idCelda";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

        // le indicamos los campos de la tabla 
        protected $fillable = ['idFila','idColumna','idMatriz','contenido'];

    public function matriz(){
            return $this->hasOne('App\Matriz','idMatriz','idMatriz');
    
    }

    public function getContenido($idFila, $idColumna,$idMatriz){
        
       $listaFinalEmpresas = DB::select("
       SELECT C.contenido,C.idFila,C.idColumna 
            FROM celdamatriz C
             WHERE C.idFila=$idFila and C.idColumna=$idColumna and C.idMatriz=$idMatriz
        ");
        
        if(count($listaFinalEmpresas)==0)
            $content = " ";
        else
            $content = $listaFinalEmpresas[0]->contenido;
        
        error_log('getContenido de '.$idFila.'  '.$idColumna.' ========='.$content);

        return $content;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estrategia extends Model
{
    
    protected $table = "estrategiafoda";
    protected $primaryKey = "idEstrategia";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

        // le indicamos los campos de la tabla 
        protected $fillable = ['descripcion','tipo','id1','id2','idEmpresa'];



}

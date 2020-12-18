<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    protected $table = "elementofoda";
    protected $primaryKey = "idElemento";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

        // le indicamos los campos de la tabla 
        protected $fillable = ['tipo','descripcion','nroEnEmpresa','empresa_idEmpresa'];


}

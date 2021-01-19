<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
    protected $primaryKey = "idEmpresa";

    public $timestamps = false;  //para que no trabaje con los campos fecha 

        // le indicamos los campos de la tabla 
        protected $fillable = ['nombreEmpresa','ruc','direccion',
        'mision','vision','factorDif','propuestaV','estadoAct','configuracionMatriz'];

        /*
        configuracionMatriz puede tener los valores
            PxA   Proceso vs Area
            PxP   Proceso vs Puesto
            SxA   Subpr vs Area
            SxP   Subpr vs Puesto
        */
}

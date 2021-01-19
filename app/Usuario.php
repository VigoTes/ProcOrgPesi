<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    protected $table = "usuario";
    protected $primaryKey = "id";
    public $timestamps = false;  //para que no trabaje con los campos fecha 


    protected $fillable = [
        'name', 'email','nombres','apellidos','DNI','password','remember_token',
    ];


    // aqui 
    public function empresasTodasParaEdicion(){
        //aqui haremos la union de empresas
        $listaEmpresass = EmpresaUsuario::where('idEmpresa','=',$this->id  )->get();
        //aqui ya tenemos la lista de empresas de ese usuario, pero solo con sus ids
       // return $listaEmpresass;

       $listaFinalEmpresas = DB::select("
            SELECT  
                E.idEmpresa,
                E.nombreEmpresa,
                E.RUC,
                E.direccion,
                E.mision,
                E.vision,
                E.factorDif,
                E.propuestaV,
                E.estadoAct,
                IF ( $this->id = EU.idUsuario, 'checked','') as 'pertenece'
                    FROM empresa as E
            LEFT JOIN empresausuario as EU on E.idEmpresa = EU.idEmpresa
        ");

        
        

        return $listaFinalEmpresas;
    }


    public function empresasDelUsuario(){
        //aqui haremos la union de empresas
        $listaEmpresass = EmpresaUsuario::where('idEmpresa','=',$this->id  )->get();
        //aqui ya tenemos la lista de empresas de ese usuario, pero solo con sus ids
       // return $listaEmpresass;

        /*
        $listaFinalEmpresas = Empresa::where('idEmpresa','=','0')->get();//inicializamos el vector con 0 elem
        
        foreach ($listaEmpresass as $itemEmpresa) {
            $empresaActualCompleta = Empresa::findOrFail($itemEmpresa->idEmpresa);  
            array_push($listaFinalEmpresas , $empresaActualCompleta );
        } */
        

        //hacemos la busqueda de todas las empresas existentes
        $listaFinalEmpresas = DB::table('empresa as E')
        ->join('empresausuario as EU','E.idEmpresa','=','EU.idEmpresa')                 
        ->where('EU.idUsuario','=',$this->id)
        ->select('E.idEmpresa','E.nombreEmpresa','E.RUC','E.direccion','E.mision',
                    'E.vision','E.factorDif','E.propuestaV','E.estadoAct')
        
        ->get(); 
        
        

        return $listaFinalEmpresas;
    }
}

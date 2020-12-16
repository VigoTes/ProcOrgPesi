<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    const PAGINATION = 10; // PARA QUE PAGINEE DE 10 EN 10

    public function index(Request $Request)
    {
        $buscarpor = $Request->buscarpor;
        $empresa = Empresa::where('nombreEmpresa','like','%'.$buscarpor.'%')
            ->paginate($this::PAGINATION);

        //cuando vaya al index me retorne a la vista
        return view    ('tablas.empresas.index',compact('empresa','buscarpor')); 
        //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact


        // otra forma sería hacer ['categoria'] => $categoria
    }

    public function create()
    {
        return view ('tablas.empresas.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

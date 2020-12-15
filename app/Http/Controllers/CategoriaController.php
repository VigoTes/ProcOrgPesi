<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

use function GuzzleHttp\Promise\all;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const PAGINATION = 10; // PARA QUE PAGINEE DE 10 EN 10

    public function index(Request $Request)
    {


        $buscarpor = $Request->buscarpor;
        $categoria = Categoria::where('estado', '=','1')
            ->where('descripcion','like','%'.$buscarpor.'%')
            ->paginate($this::PAGINATION);



        //cuando vaya al index me retorne a la vista
        return view    ('tablas.categorias.index',compact('categoria','buscarpor')); //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact


        // otra forma sería hacer ['categoria'] => $categoria
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('tablas.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
                [
                    'descripcion'=>'required|max:30'

                ],[
                    'descripcion.required'=>'Ingrese descripcion de categoria',
                    'descripcion.max' => 'Maximo 30 caracteres la descripcion'
                ]

                );
                $categoria = new Categoria();
                $categoria->descripcion=$request->descripcion;
                $categoria->save;
                    return redirect  ()->route('categoria.index')->with('datos','Registro nuevo guardado');

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

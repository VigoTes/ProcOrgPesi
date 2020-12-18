<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Usuario;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller


{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


    }

   



    public function create()
    {
        $user = new Usuario();
        return view('tablas.usuarios.create',compact('user'));
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
                'name'=>'required|max:50',
                'email'=>'required|max:50',
                'password'=>'required|max:30',
                'nombres'=>'required|max:100',
                'apellidos'=>'required|max:100',
                'DNI'=>'required|size:8'
                
                

            ],[
                'name.required'=>'Ingrese el nombre de usuario',
                'name.max' => 'Maximo 30 caracteres la descripcion',

                'email.required'=>'Ingrese el email',
                'email.max' => 'Maximo 30 caracteres la descripcion',

                'password.required'=>'Ingrese la contraseña',
                'password.max' => 'Maximo 30 caracteres la descripcion',

                'nombres.required'=>'Ingrese el nombre',
                'nombres.max' => 'Maximo 30 caracteres la descripcion',

                'apellidos.required'=>'Ingrese los apellidos',
                'apellidos.max' => 'Maximo 30 caracteres la descripcion',

                'DNI.required'=>'Ingrese el nro de DNI',
                'DNI.max' => 'Maximo 30 caracteres la descripcion',
                'DNI.size'=> 'El DNI debe contener 8 digitos'
                     
            ]

            );
            $usuario = new Usuario();
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            

            $usuario->password= Hash::make($request->password);
            
            $usuario->apellidos=$request->apellidos;
            $usuario->nombres=$request->nombres;
            $usuario->DNI=$request->DNI;
            $usuario->estadoAct='1';                
            $usuario->save();
                return redirect()->route('user.index')->with('msj','Registro nuevo guardado');


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
        $usuario=Usuario::findOrFail($id);
        return view('tablas.usuarios.edit',compact('usuario'));


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
        $data = request()->validate(
            [
                'name'=>'required|max:50',
                'email'=>'required|max:50',
                'nombres'=>'required|max:100',
                'apellidos'=>'required|max:100',
                'DNI'=>'required|size:8'
            ],[
                'name.required'=>'Ingrese el nombre de usuario',
                'name.max' => 'Maximo 30 caracteres la descripcion',

                'email.required'=>'Ingrese el email',
                'email.max' => 'Maximo 30 caracteres la descripcion',

                'nombres.required'=>'Ingrese el nombre',
                'nombres.max' => 'Maximo 30 caracteres la descripcion',

                'apellidos.required'=>'Ingrese los apellidos',
                'apellidos.max' => 'Maximo 30 caracteres la descripcion',

                'DNI.required'=>'Ingrese el nro de DNI',
                'DNI.size'=> 'El DNI debe contener 8 digitos'
                     
            ]

            );
            $usuario = Usuario::findOrFail($id);
            $usuario->name=$request->name;
            $usuario->email=$request->email;
            $usuario->apellidos=$request->apellidos;
            $usuario->nombres=$request->nombres;
            $usuario->DNI=$request->DNI;             
            $usuario->save();
                return redirect()->route('user.index')->with('msj','Registro editado exitosamente');
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->estadoAct = '0';
        $usuario->save ();
        return redirect() -> route('user.index')->with('msj','Registro eliminado');



    }
    public function confirmar($id){
        $usuario = Usuario::findOrFail($id); 
        return view('tablas.usuarios.confirmar',compact('usuario'));
    }



}

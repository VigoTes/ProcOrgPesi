<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    const PAGINATION = 10; // PARA QUE PAGINEE DE 10 EN 10
    public function login(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'password'=>'required',
        ],
        [
            'name.required'=>'Ingrese Usuario',
            'password.required'=>'Ingrese Contraseña',
        ]);
            $name=$request->get('name');
            $query=User::where('name','=',$name)->get();
            if($query->count()!=0){
                $hashp=$query[0]->password; // guardamos la contraseña cifrada de la BD en hashp
                $password=$request->get('password');    //guardamos la contraseña ingresada en password
                if(password_verify($password,$hashp))       //comparamos con el metodo password_verifi ??¡ xdd
                {
                        // Preguntamos si es admin o no
                    if($name=='admin')
                    {
                        if(Auth::attempt($request->only('name','password'))) //este attempt es para que el Auth se inicie
                            return view('bienvenido');
                    }//si es user normal
                    else{
                        if(Auth::attempt($request->only('name','password')))
                        return redirect()->route('empresa.index','0');
    
                    }
                    
                
                
                }
                else{
                    return back()->withErrors(['password'=>'Contraseña no válido'])->withInput([request('password')]);
                }                
            }
            else
            {
                return back()->withErrors(['name'=>'Usuario no válido'])->withInput([request('name')]);
            }
        }


        public function index(Request $Request)
        {
            $buscarpor = $Request->buscarpor;
            $usuarios = User::where('name','like','%'.$buscarpor.'%')
                ->where('estadoAct','=','1')
                ->paginate($this::PAGINATION);
    
            //cuando vaya al index me retorne a la vista
            return view    ('tablas.usuarios.index',compact('usuarios','buscarpor')); 
            //el compact es para pasar los datos , para meter mas variables meterle mas comas dentro del compact
    
    
            // otra forma sería hacer ['categoria'] => $categoria
        }


    public function create()
    {
        
    }









}

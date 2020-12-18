@extends('layout.plantillaUser')
@section('contenido')


<form method = "POST" action = "{{route('empresa.update',$empresa->idEmpresa)}}"  >
    @method('put')
    @csrf   

  <div class="form-group">

   <div class="container">  {{-- Container  --}}
        <div class="row">
                


            <div class="col">
                {{-- CONTENIDO DE LA COLUMNA --}}
             <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control @error('nombreEmpresa') is-invalid @enderror"
                         value='{{$empresa->nombreEmpresa}}' 
                    id="nombreEmpresa" name="nombreEmpresa" placeHolder="Ingrese el nombre de la empresa">

                        @error('nombreEmpresa')
                            <span class = "invalid-feedback" role ="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                        @enderror  
               


                <br>
                <label for="mision">Misión</label>
                <div class="input-group">
                    <textarea class="form-control @error('mision') is-invalid @enderror"
                        style = "resize: none;"  id="mision" name="mision" value=''>{{$empresa->mision}}</textarea>
                    @error('mision')
                            <span class = "invalid-feedback" role ="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                    @enderror  
                
                </div>


                <br>
                <label for="vision">Vision</label>
                <div class="input-group">
                    <textarea class="form-control @error('vision') is-invalid @enderror" 
                    style = "resize: none;"  id="vision" name="vision" >{{$empresa->vision}}</textarea>
                    @error('vision')
                            <span class = "invalid-feedback" role ="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                    @enderror  
                </div>
            
                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="col">
                {{-- CONTENIDO COLUMNA --}}
        
                <label for="RUC">RUC de la Empresa</label>
                <input type="text" class="form-control @error('RUC') is-invalid @enderror" id="RUC" name="RUC" 
                    placeHolder="Ingrese RUC" value='{{$empresa->RUC}}' >
                    @error('RUC')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror  
            
                
                <br>
                <label for="factorDif">Factor Diferenciador</label>
                <div class="input-group">
                    
                    <textarea class="form-control @error('factorDif') is-invalid @enderror" aria-label="With textarea"
                     style = "resize: none;" id="factorDif" name="factorDif"  >{{$empresa->factorDif}}</textarea>
                     @error('factorDif')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                     @enderror 
                </div>


                <br>
                <label for="propuestaV">Propuesta de valor</label>
                <div class="input-group">
                    <textarea class="form-control @error('propuestaV') is-invalid @enderror"
                         style = "resize: none;" id="propuestaV" name="propuestaV" >{{$empresa->propuestaV}}</textarea>
                    @error('propuestaV')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                     @enderror 
                </div>



                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="w-100"></div>


            <div class="col">
                {{-- CONTENIDO COLUMNA DOBLE TAMAÑO--}}
                    
               <label for="direccion">Dirección</label>
                <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                     id="direccion" name="direccion" placeHolder="Ingrese Dirección de la empresa" 
                        value='{{$empresa->direccion}}' >
                    @error('direccion')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror  

                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="w-100"></div>

            <div class="col"> 
                 {{-- CONTENIDO COLUMNA --}}
                
                <div style=         "float: right;">    

                <br>
                 <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
                    <a href = "{{route('empresa.index')}}" class = "btn btn-danger">
                        <i class="fas fa-ban"> </i> Cancelar </a>   {{-- BOTON CANCELARRRRRRRRRRRRRRRRR --}}
                </div>

                 {{-- FIN CONTENIDO COLUMNA--}}
            </div>
        </div>
    </div>
   </div>

</form> {{-- FORM GRUP --}}











{{-- SEGUNDA SEPARACION AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA --}}






















<form method = "POST" action = "{{route('objetivo.store')}}"  >
    @csrf   

  <div class="form-group">

   <div class="container">  {{-- Container  --}}
        <div class="row">
        
            <div class="col"> 
                 {{-- CONTENIDO COLUMNA --}}
                <br>
                
                <label for="descripcion">Objetivos Estratégicos</label>
                <br>
                    <div class="container">
                        <div class="row">
                            
                             {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE LA ID EMPRESA --}}   
                            <input type="hidden" class="form-control" 
                                        id="idEmpresaa" name="idEmpresaa" value = {{$empresa->idEmpresa}}>
                            
                            <div class="col">
                            {{-- ESTE ES EL INPUTO DEL QUE QUIERO AGARRAR SU VALOR --}}
                                <input type="text" class="form-control @error('objEstrX') is-invalid @enderror" 
                                        id="objEstrX" name="objEstrX" >
                                    @error('objEstrX')
                                        <span class = "invalid-feedback" role ="alert">
                                            <strong>{{ $message }} </strong>
                                        </span>
                                    @enderror  


                            </div>

                            <div class="col">
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Nuevo Registro 
                                    </button>
                                
                            </div>
                            
                        </div>
                    </div>

                <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 2%">id</th>
                            <th scope="col" style = "width: 65%">Descripción Objetivo</th>
                            <th scope="col" style = "width: 20%">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>

                        {{-- LISTADO DE LOS OBJETIVOS DE LA EMPRESA --}}
                        @foreach($listaObjetivos as $itemObjetivo)

                            <tr>
                                <td>{{$itemObjetivo->idObjetivoEst}}</td>
                                <td>{{$itemObjetivo->descripcionObj}}</td>

                                <td> <a href="{{route('objetivo.edit',$itemObjetivo->idObjetivoEst)}}" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                                        Editar
                                    </a>

                                    <a href="{{route('objetivo.confirmar',$itemObjetivo->idObjetivoEst)}}" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                                        Eliminar
                                    </a>   
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                

                 {{-- FIN CONTENIDO COLUMNA--}}
            </div>
        </div>
    </div>
   </div>

</form> {{-- FORM GRUP --}}



@endsection
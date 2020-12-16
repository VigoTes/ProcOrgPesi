@extends('layout.plantilla')
@section('contenido')


<form method = "POST" action = ""  >
    @csrf   

  <div class="form-group">
        
   <div class="container">  {{-- Container  --}}
        <div class="row">
            <div class="col">
                {{-- CONTENIDO DE LA COLUMNA --}}
            <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                    id="nombreEmpresa" name="nombreEmpresa" placeHolder="Ingrese el nombre de la empresa">

                        @error('descripcion')
                            <span class = "invalid-feedback" role ="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                        @enderror  
               


                <br>
                <label for="descripcion">Misión</label>
                <div class="input-group">
                    
                    <textarea class="form-control" aria-label="With textarea" style = "resize: none;"  id="mision" name="mision"></textarea>
                </div>


                <br>
                <label for="descripcion">Vision</label>
                <div class="input-group">
                    
                    <textarea class="form-control" aria-label="With textarea" style = "resize: none;"  id="vision" name="vision"></textarea>
                </div>
            
                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="col">
                {{-- CONTENIDO COLUMNA --}}
        
                <label for="RUC">RUC de la Empresa</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="RUC" name="RUC" placeHolder="Ingrese RUC">
                    @error('descripcion')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror  
            
                
                <br>
                <label for="descripcion">Factor Diferenciador</label>
                <div class="input-group">
                    
                    <textarea class="form-control" aria-label="With textarea" style = "resize: none;" id="factorDif" name="factorDif" ></textarea>
                </div>


                <br>
                <label for="descripcion">Propuesta de valor</label>
                <div class="input-group">
                    
                    <textarea class="form-control" aria-label="With textarea" style = "resize: none;" id="propuestaV" name="propuestaV"></textarea>
                </div>



                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="w-100"></div>


            <div class="col">
                {{-- CONTENIDO COLUMNA DOBLE TAMAÑO--}}
                    
               <label for="descripcion">Dirección</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="direccion" name="direccion" placeHolder="Ingrese Dirección de la empresa">
                    @error('descripcion')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror  

                {{-- FIN CONTENIDO COLUMNA --}}
            </div>
            <div class="w-100"></div>
            <div class="col"> 
                 {{-- CONTENIDO COLUMNA --}}
                <br>
                
                <label for="descripcion">Objetivos Estratégicos</label>
                <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="objEstrX" name="objEstrX" >
                   
                            </div>

                            <div class="col">
                                <a href="" class = "btn btn-primary"> 
                                    <i class="fas fa-plus"> </i> 
                                    Nuevo Registro
                                </a>
                            </div>
                            
                        </div>
                    </div>

                <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">Descripción Objetivo</th>
                            <th scope="col">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>1</td>
                                <td>Mark</td>
                                <td> <a href="" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                                        Editar
                                    </a>

                                    <a href="" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                                        Eliminar
                                    </a>   
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>
                <div style=         "float: right;">    

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



@endsection
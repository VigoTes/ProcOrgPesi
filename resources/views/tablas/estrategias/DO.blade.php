

@extends('layout.plantillaUser')
@section('contenido')

<form method = "POST" action = "{{route('estrategia.store')}}"  >
    @csrf   
    <label for="nombreEmpresa">Nombre de la empresa:</label>
                <input type="text" class="form-control"  
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" value="{{$empresa->nombreEmpresa}}">
   
    {{-- INPUT INVISIBLE PARA GUARDAR EL TIPO DE ESTRATEGIA --}}   
          <input type="hidden" id="tipoEstrategia" name="tipoEstrategia" value ="DO">
     {{-- INPUT INVISIBLE PARA GUARDAR EL id de la empresa --}}   
          <input type="hidden" id="idEmpresa" name="idEmpresa" value ="{{$empresa->idEmpresa}}">
                            

    <br>
    <div class="container" Style = "font-size:10pt;">
        <div class="row" >
            <div class="col" >
                {{-- INICIO CELDA --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 88%;">Debilidades</th>
                            <th scope="col" style = "width: 1%;">X</th>

                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($debilidades as $itemDebilidad )
                                
                            <tr>
                                <td>{{$itemDebilidad->nroEnEmpresa}}</td>
                                <td>{{$itemDebilidad->descripcion}}</td>
                                <td> 
                                    <div class="form-check">
                                        <input name="CB_F<?php echo($itemDebilidad->nroEnEmpresa) ?>"
                                                 id="CB_F<?php echo($itemDebilidad->nroEnEmpresa) ?>"  class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>





        {{-- SEPARACION TABLAS     SEPARACION TABLAS     SEPARACION TABLAS     SEPARACION TABLAS     SEPARACION TABLAS     SEPARACION TABLAS     SEPARACION TABLAS     --}}
                    
                    
                    
                    
                    
                    
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style = "width: 10%;">id</th>
                                <th scope="col" style = "width: 88%;">Oportunidades</th>
                                <th scope="col" style = "width: 1%;">X</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($oportunidades as $itemOportunidad )
                                
                            <tr>
                                <td>{{$itemOportunidad->nroEnEmpresa}}</td>
                                <td>{{$itemOportunidad->descripcion}}</td>
                                <td> 
                                     

                                    <div class="form-check">
                                        <input name="CB_O<?php echo($itemOportunidad->nroEnEmpresa) ?>"
                                                 id="CB_O<?php echo($itemOportunidad->nroEnEmpresa) ?>"  class="form-check-input" type="checkbox" value="">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>





                {{-- FIN CELDA --}}    
            </div>












        {{--  SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR SEPARADOR --}}
         
         
         
         
         
         
         
         
         
         
         
         
            <div class="col" >
                 {{-- INICIO CELDA --}}           


                    <h1 style= "text-align: center"> Estrategias DO </h1>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="descripcion" name="descripcion" style="position: relative; width: 335px;">
                                
                            </div>

                            
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Agregar 
                                </button>
                                
                            
                        </div>
                    </div>    

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                  {{--           <th scope="col" style = "width: 5%;">id</th> --}}
                            <th scope="col" style = "width: 55%;">Estrategias</th>
                            <th scope="col" style = "width: 5%;">idD</th>
                            <th scope="col" style = "width: 5%;">idO</th>
                            <th scope="col" style = "width: 18%;">Opciones</th>
                            
                            
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($estrategiasDO as $itemEstrategia)
                            
                            <tr>
                          {{--       <td>{{$itemEstrategia->idEstrategia}}</td> --}}
                                <td>{{$itemEstrategia->descripcion}}</td>
                                <td>{{$itemEstrategia->id1}}</td>
                                <td>{{$itemEstrategia->id2}}</td>
                                <td>
                                       <a href="{{route('estrategia.edit',$itemEstrategia->idEstrategia)}}" class = "btn btn-warning btn-sm">  
                                            <i class="fas fa-edit fa-sm"> </i> 
                                        </a>

                                        <a href="{{route('estrategia.confirmar',$itemEstrategia->idEstrategia)}}" class = "btn btn-danger btn-sm"> 
                                            <i class="fas fa-trash-alt fa-sm"> </i> 
                                        </a>   
                                
                                </td>
                                

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                {{-- FIN CELDA --}}    
            </div>
            

            <div class="w-100"></div>
            
           
        </div>
    </div>

</form>
@endsection
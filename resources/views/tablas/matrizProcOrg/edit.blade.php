

@extends('layout.plantillaUser')
@section('contenido')

<form method = "POST" action = "{{route('celdamatriz.store')}}"  >
    @csrf   

    @if (session('msjLlegada'))
        <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
            {{session('msjLlegada')}}
          <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true"> &times;</span>
          </button>
          
        </div>
      @ENDIF


        <label for="nombreEmpresa">Nombre de la Empresa</label>
        <input type="text" class="form-control"  
          id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" 
          value="{{$empresaFocus->nombreEmpresa}}">
        
        <label>Nro de matriz</label>
        <input type="text" class="form-control"  
            id="codMatriz" name="codMatriz" disabled = "disabled" 
            value="{{$matrizAEditar->nroEnEmpresa}}">
            
        <label>Descripcion de la matriz</label>
        <input type="text" class="form-control"  
                id="codMatriz" name="codMatriz" disabled = "disabled" 
                value="{{$matrizAEditar->descripcion}}">
            
                  
                <input type="hidden"
                    id="idEmpresa" name="idEmpresa" 
                    value="{{$empresaFocus->idEmpresa}}">
                <input type="hidden"
                    id="idMatriz" name="idMatriz" 
                    value="{{$matrizAEditar->idMatriz}}">
                
    

    <div style="margin: 20px ;">
        <div style="margin-left: 35px;" >
            <input type="radio" id="MARCA_X" name="tipoMarca" value="X"> X
        
            <input type="radio" id="MARCA_x" name="tipoMarca" value="x"> x
            
            <input type="radio" id="MARCA_/" name="tipoMarca" value="/"> /
            <input type="radio" id="MARCA_*" name="tipoMarca" value="*"> Borrar
        
           
        
        </div>
        <button type="submit" style="margin-left: 30px;" class="btn btn-primary">  
            Marcar 
        </button>
        
        

    </div>
   
    <div class="container" Style = "font-size:10pt;">
        
        {{-- 
            TABLA DE PROCESOS/SUBPR VS AREAS/PUESTOS
                        FILAS           COLUMNAS



            --}}

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        {{$tipoMatrizEscrita}}
                    </th>
                    <th scope="col"></th>
                    @foreach($listaColumnas as $itemColumna)
                        <th scope="col"> {{$itemColumna->nombre()}}</th>    
                    @endforeach    
                </tr>


                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    @foreach($listaColumnas as $itemColumna)
                        <th scope="col"> 
                            <input type="radio" id="RB_C<?php echo($itemColumna->id()) ?>" name="columnas" value="RB_C<?php echo($itemColumna->id()) ?>">
                            {{$itemColumna->id()}}
                        </th>    
                    @endforeach  

                </tr>

            </thead>
            <tbody>
                @foreach($listaFilas as $itemFila)
                <tr> 
                    <td scope="col"> {{$itemFila->nombre()}}</td>
                    <td>   
                        <input type="radio" id="RB_F<?php echo($itemFila->id()) ?>" name="filas" value="RB_F{{$itemFila->id()}}">
                            {{$itemFila->id()}}
                    </td>
                    @foreach($listaColumnas as $itemColumna)
                        <th scope="col"> 
                            <?php 
                                echo($celdaParaFuncion->getContenido($itemFila->id(),$itemColumna->id(),$matrizAEditar->idMatriz));

                            ?>
                        </th>    
                    @endforeach          
                        
                  
                </tr>
                @endforeach  
            </tbody>
        </table>

        
        
        <div class="row" >
           
            
            <div class="w-100"></div>
            <div class="col" style = "text-align: center; position: relative; margin-top: 40px;">

                <a href="" class="btn btn-primary btn-lg"> <i class="fas fa-download"></i> Pdf</a>
                
            </div>
            <div class="col" style = "text-align: center; position: relative; margin-top: 40px;">
                {{-- <a href="www.facebook.com" class="btn btn-primary btn-lg"> 
                <i class="fas fa-download"></i> Word
                </a> --}}
                


            </div>
        </div>
    </div>

</form>
@endsection






{{--  GA GA GA A SODISA DSA JSDJ SDAJJ DSAJDSA JASDJL DSJAJDSAJLKADSJLK DSAJLKDSA DSAJL JLKDSAJLKD SAJKL DSAJLK --}}
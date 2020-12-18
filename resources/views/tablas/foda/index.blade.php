

@extends('layout.plantillaUser')
@section('contenido')

<h1> FODA PANEL </h1>
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
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" value="{{$empresa->nombreEmpresa}}">
    
    <div class="container">
        <div class="row" >
            <div class="col" >
            {{-- ************************************************* SEPARADOR ***************************** --}}
               
                    {{-- INICIO CELDA --}}
                <form method = "POST" action = "{{route('elemento.store')}}"  >
                    @csrf  
                    
                    <br>
                    <div class="container">
                        <div class="row">
                            
                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                    id="descripcion" name="descripcion" style="position: relative;   width: 325px;">
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Agregar 
                                    </button>
                            
                            
                        </div>
                    </div>

                     {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE TIPO DE ELEMENTO FODA --}}   
                            <input type="hidden" class="form-control" 
                                        id="tipoElemento" name="tipoElemento" value = 'F'>
                     {{-- INPUT INVISIBLE PARA GUARDAR EL idEmpresa --}}   
                            <input type="hidden" class="form-control" 
                                        id="idEmpresa" name="idEmpresa" value = {{$empresa->idEmpresa}}>
                            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortaleza</th>
                            <th scope="col" style = "width: 10%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($fortalezas as $itemFortaleza)
                            <tr>

                                <td>{{$itemFortaleza->nroEnEmpresa}}</td>
                                <td>{{$itemFortaleza->descripcion}}</td>

                                {{-- BOTON EDITAR --}}
                                <td> <a href="{{route('elemento.edit',$itemFortaleza->idElemento)}}" class = "btn btn-warning btn-sm">  
                                        <i class="fas fa-edit fa-sm"> </i> 
                                       
                                    </a>
                                {{-- BOTON ELIMINAR --}}
                                    <a href="{{route('elemento.confirmar',$itemFortaleza->idElemento)}}" class = "btn btn-danger btn-sm"> 
                                        <i class="fas fa-trash-alt fa-sm"> </i> 
                                 
                                    </a>   
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </form>
{{-- ************************************************* SEPARADOR ***************************** --}}
               

                {{-- FIN CELDA --}}    

















            </div>
            <div class="col" >
                 {{-- INICIO CELDA --}}           
                   {{-- INICIO CELDA --}}
                <form method = "POST" action = "{{route('elemento.store')}}"  >
                    @csrf  
                    
                    <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                    id="descripcion" name="descripcion" style="position: relative;   width: 325px;">
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Agregar 
                                    </button>
                            
                            
                        </div>
                    </div>

                     {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE TIPO DE ELEMENTO FODA --}}   
                            <input type="hidden" class="form-control" 
                                        id="tipoElemento" name="tipoElemento" value = 'D'>
                      {{-- INPUT INVISIBLE PARA GUARDAR EL idEmpresa --}}   
                            <input type="hidden" class="form-control" 
                                        id="idEmpresa" name="idEmpresa" value = {{$empresa->idEmpresa}}>
                           

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Debilidad</th>
                            <th scope="col" style = "width: 10%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($debilidades as $itemDebilidad)
                            <tr>

                                <td>{{$itemDebilidad->nroEnEmpresa}}</td>
                                <td>{{$itemDebilidad->descripcion}}</td>
                                <td> 
                                    {{-- BOTON EDITAR --}}
                                    <a href="{{route('elemento.edit',$itemDebilidad->idElemento)}}" class = "btn btn-warning btn-sm">  
                                        <i class="fas fa-edit fa-sm"> </i> 
                                       
                                    </a>

                                    {{-- BOTON BORRAR --}}
                                    <a href="{{route('elemento.confirmar',$itemDebilidad->idElemento)}}" class = "btn btn-danger btn-sm"> 
                                        <i class="fas fa-trash-alt fa-sm"> </i> 
                                 
                                    </a>   
                                </td>
                            </tr>
                            @endforeach
                            
                         
                        </tbody>
                    </table>
                </form>
                {{-- ************************************************* SEPARADOR ***************************** --}}
                {{-- FIN CELDA --}}    






















            </div>

            <div class="w-100"></div>
            <div class="col" >
                {{-- INICIO CELDA --}}     
                    {{-- INICIO CELDA --}}
                <form method = "POST" action = "{{route('elemento.store')}}"  >
                    @csrf  
                    
                    <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                    id="descripcion" name="descripcion" style="position: relative;   width: 325px;">
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror                   
                            </div>

                            
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Agregar 
                                    </button>
                            
                            
                        </div>
                    </div>

                     {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE TIPO DE ELEMENTO FODA --}}   
                            <input type="hidden" class="form-control" 
                                        id="tipoElemento" name="tipoElemento" value = 'O'>
                       {{-- INPUT INVISIBLE PARA GUARDAR EL idEmpresa --}}   
                            <input type="hidden" class="form-control" 
                                        id="idEmpresa" name="idEmpresa" value = {{$empresa->idEmpresa}}>
                           
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Oportunidad</th>
                            <th scope="col" style = "width: 10%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($oportunidades as $itemOportunidad)
                            <tr>

                                <td>{{$itemOportunidad->nroEnEmpresa}}</td>
                                <td>{{$itemOportunidad->descripcion}}</td>
                                <td> <a href="{{route('elemento.edit',$itemOportunidad->idElemento)}}" class = "btn btn-warning btn-sm">  
                                        <i class="fas fa-edit fa-sm"> </i> 
                                       
                                    </a>

                                    <a href="{{route('elemento.confirmar',$itemOportunidad->idElemento)}}" class = "btn btn-danger btn-sm"> 
                                        <i class="fas fa-trash-alt fa-sm"> </i> 
                                 
                                    </a>   
                                </td>
                            </tr>
                            @endforeach
                            
                         
                        </tbody>
                    </table>
                </form>
                {{-- ************************************************* SEPARADOR ***************************** --}}
               






















                {{-- FIN CELDA --}}           
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                   {{-- INICIO CELDA --}}
                <form method = "POST" action = "{{route('elemento.store')}}"  >
                    @csrf  
                    
                    <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                    id="descripcion" name="descripcion" style="position: relative;   width: 325px;">
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                                <button type="submit" class="btn btn-primary">  
                                           <i class="fas fa-plus"> </i>  Agregar 
                                    </button>
                            
                            
                        </div>
                    </div>

                      {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE TIPO DE ELEMENTO FODA --}}   
                            <input type="hidden" class="form-control" 
                                        id="tipoElemento" name="tipoElemento" value = 'A'>
                        {{-- INPUT INVISIBLE PARA GUARDAR EL idEmpresa --}}   
                            <input type="hidden" class="form-control" 
                                        id="idEmpresa" name="idEmpresa" value = {{$empresa->idEmpresa}}>
                             
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Amenaza</th>
                            <th scope="col" style = "width: 10%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($amenazas as $itemAmenaza)
                            <tr>

                                <td>{{$itemAmenaza->nroEnEmpresa}}</td>
                                <td>{{$itemAmenaza->descripcion}}</td>
                                <td> <a href="{{route('elemento.edit',$itemAmenaza->idElemento)}}" class = "btn btn-warning btn-sm">  
                                        <i class="fas fa-edit fa-sm"> </i> 
                                       
                                    </a>

                                    <a href="{{route('elemento.confirmar',$itemAmenaza->idElemento)}}" class = "btn btn-danger btn-sm"> 
                                        <i class="fas fa-trash-alt fa-sm"> </i> 
                                 
                                    </a>   
                                </td>
                            </tr>
                            @endforeach
                            
                         
                        </tbody>
                    </table>
                </form>    
                {{-- FIN CELDA --}}    
            </div>
        </div>
    </div>


@endsection
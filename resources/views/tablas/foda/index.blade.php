

@extends('layout.plantilla')
@section('contenido')

<h1> FODA PANEL </h1>

    <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control"  
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" value="HOLAAA AQUI VA EL NOMBRE">
    
    
    
  
    <div class="container">
        <div class="row" >
            <div class="col" >
                {{-- INICIO CELDA --}}
                    <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                    id="objEstrX" name="objEstrX" style="position: relative; left: 43px; width: 325px;">
                   
                            </div>

                            
                                <a href="" class = "btn btn-primary"> 
                                    <i class="fas fa-plus"> </i> 
                                    Agregar
                                </a>
                            
                            
                        </div>
                    </div>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortaleza</th>
                            <th scope="col" style = "width: 25%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>1</td>
                                <td>Mark</td>
                                <td> <a href="" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                                       
                                    </a>

                                    <a href="" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                                 
                                    </a>   
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>








                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                 {{-- INICIO CELDA --}}           
                   <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="objEstrX" name="objEstrX" style="position: relative; left: 43px; width: 325px;">
                   
                            </div>

                            
                                <a href="" class = "btn btn-primary"> 
                                    <i class="fas fa-plus"> </i> 
                                    Agregar
                                </a>
                            
                            
                        </div>
                    </div>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortaleza</th>
                            <th scope="col" style = "width: 25%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>1</td>
                                <td>Mark</td>
                                <td> <a href="" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                                    
                                    </a>

                                    <a href="" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                             
                                    </a>   
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>
     

                {{-- FIN CELDA --}}    
            </div>

            <div class="w-100"></div>
            <div class="col" >
                {{-- INICIO CELDA --}}     
                   <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="objEstrX" name="objEstrX" style="position: relative; left: 43px; width: 325px;">
                   
                            </div>

                            
                                <a href="" class = "btn btn-primary"> 
                                    <i class="fas fa-plus"> </i> 
                                    Agregar
                                </a>
                            
                            
                        </div>
                    </div>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortaleza</th>
                            <th scope="col" style = "width: 25%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>1</td>
                                <td>Mark</td>
                                <td> <a href="" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                                
                                    </a>

                                    <a href="" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                                   
                                    </a>   
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}           
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <br>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="objEstrX" name="objEstrX" style="position: relative; left: 43px; width: 325px;">
                   
                            </div>

                            
                                <a href="" class = "btn btn-primary"> 
                                    <i class="fas fa-plus"> </i> 
                                    Agregar
                                </a>
                            
                            
                        </div>
                    </div>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortaleza</th>
                            <th scope="col" style = "width: 25%;">Opciones</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>1</td>
                                <td>Mark</td>
                                <td> <a href="" class = "btn btn-warning">  
                                        <i class="fas fa-edit"> </i> 
                              
                                    </a>

                                    <a href="" class = "btn btn-danger"> 
                                        <i class="fas fa-trash-alt"> </i> 
                                    
                                    </a>   
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
        </div>
    </div>


@endsection
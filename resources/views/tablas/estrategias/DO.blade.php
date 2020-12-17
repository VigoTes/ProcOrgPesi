

@extends('layout.plantilla')
@section('contenido')


    <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control"  
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" value="HOLAAA AQUI VA EL NOMBRE">


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
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
             
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 88%;">Oportunidades</th>
                            <th scope="col" style = "width: 1%;">X</th>

                            
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td> 
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>





                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                 {{-- INICIO CELDA --}}           


                    <h1 style= "text-align: center"> Estrategias DO </h1>
                    <div class="container">
                        <div class="row">

                            <div class="col">
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                   id="objEstrX" name="objEstrX" style="position: relative; left: 30px; width: 325px;">
                   
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
                            <th scope="col" style = "width: 5%;">id</th>
                            <th scope="col" style = "width: 55%;">Estrategias</th>
                            <th scope="col" style = "width: 5%;">idD</th>
                            <th scope="col" style = "width: 5%;">idO</th>
                            <th scope="col" style = "width: 18%;">Opciones</th>
                            
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>1,4,6</td>
                                <td>2,3</td>
                                <td>
                                       <a href="" class = "btn btn-warning btn-sm">  
                                            <i class="fas fa-edit fa-sm"> </i> 
                                        </a>

                                        <a href="" class = "btn btn-danger btn-sm"> 
                                            <i class="fas fa-trash-alt fa-sm"> </i> 
                                        </a>   
                                
                                </td>
                                

                            </tr>
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}    
            </div>
            

            <div class="w-100"></div>
            
           
        </div>
    </div>


@endsection
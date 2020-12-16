

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
                    <br>
                    
                   <h2> MATRIZ ESTRATEGIAS </h2>






                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                 {{-- INICIO CELDA --}}           
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Fortalezas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}     
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Debilidades</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}           
            </div>

            <div class="w-100"></div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Oportunidades</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Estrategias FO</th>
                            <th scope="col" style = "width: 65%;">idF</th>
                            <th scope="col" style = "width: 65%;">idO</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>1,5,6</td>
                                <td>4,1,2</td>

                                
                            </tr>
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Estrategias DO</th>
                            <th scope="col" style = "width: 65%;">idD</th>
                            <th scope="col" style = "width: 65%;">idO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>1,5,6</td>
                                <td>4,1,2</td>
                            </tr>
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="w-100"></div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Amenazas</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Estrategias FA</th>
                            <th scope="col" style = "width: 65%;">idF</th>
                            <th scope="col" style = "width: 65%;">idA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>1,5,6</td>
                                <td>4,1,2</td>
                            </tr>
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col" style = "width: 10%;">id</th>
                            <th scope="col" style = "width: 65%;">Estrategias DA</th>
                            <th scope="col" style = "width: 65%;">idD</th>
                            <th scope="col" style = "width: 65%;">idA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>1,5,6</td>
                                <td>4,1,2</td>
                            </tr>
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="w-100"></div>
            <div class="col" style = "text-align: center; position: relative; margin-top: 40px;">

                <button type="button" class="btn btn-primary btn-lg"> <i class="fas fa-download"></i> Pdf</button>
                
            </div>
            <div class="col" style = "text-align: center; position: relative; margin-top: 40px;">
                <button type="button" class="btn btn-primary btn-lg"> <i class="fas fa-download"></i> Word</button>
                


            </div>
        </div>
    </div>


@endsection
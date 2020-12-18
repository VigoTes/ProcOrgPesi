

@extends('layout.plantillaUser')
@section('contenido')


    <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control"  
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" 
                    value="{{$empresa->nombreEmpresa}}">


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
                            @foreach($fortalezas as $itemFortalezas)
                                <tr>
                                    <td>{{$itemFortalezas->idElemento}}</td>
                                    <td>{{$itemFortalezas->descripcion}}</td>
                                </tr>
                            @endforeach
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

                            @foreach($debilidades as $itemDebilidades)
                                <tr>
                                    <td>{{$itemDebilidades->idElemento}}</td>
                                    <td>{{$itemDebilidades->descripcion}}</td>
                                </tr>
                            @endforeach
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
                            @foreach($oportunidades as $itemOportunidades)
                                <tr>
                                    <td>{{$itemOportunidades->idElemento}}</td>
                                    <td>{{$itemOportunidades->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
          
                            <th scope="col" style = "width: 65%;">Estrategias FO</th>
                            <th scope="col" style = "width: 65%;">idF</th>
                            <th scope="col" style = "width: 65%;">idO</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estrategiasFO as $itemEstrategia)
                                <tr>
                                    <td>{{$itemEstrategia->descripcion}}</td>
                                    <td>{{$itemEstrategia->id1}}</td>
                                    <td>{{$itemEstrategia->id2}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                        
                            <th scope="col" style = "width: 65%;">Estrategias DO</th>
                            <th scope="col" style = "width: 65%;">idD</th>
                            <th scope="col" style = "width: 65%;">idO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estrategiasDO as $itemEstrategia)
                                <tr>
                                    <td>{{$itemEstrategia->descripcion}}</td>
                                    <td>{{$itemEstrategia->id1}}</td>
                                    <td>{{$itemEstrategia->id2}}</td>
                                    
                                </tr>
                            @endforeach
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
                            @foreach($amenazas as $itemAmenazas)
                                <tr>
                                    <td>{{$itemAmenazas->idElemento}}</td>
                                    <td>{{$itemAmenazas->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                        
                            <th scope="col" style = "width: 65%;">Estrategias FA</th>
                            <th scope="col" style = "width: 65%;">idF</th>
                            <th scope="col" style = "width: 65%;">idA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estrategiasFA as $itemEstrategia)
                                <tr>
                                    <td>{{$itemEstrategia->descripcion}}</td>
                                    <td>{{$itemEstrategia->id1}}</td>
                                    <td>{{$itemEstrategia->id2}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                         
             
                {{-- FIN CELDA --}}    
            </div>
            <div class="col" >
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                       
                            <th scope="col" style = "width: 65%;">Estrategias DA</th>
                            <th scope="col" style = "width: 65%;">idD</th>
                            <th scope="col" style = "width: 65%;">idA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estrategiasDA as $itemEstrategia)
                                <tr>
                                    <td>{{$itemEstrategia->descripcion}}</td>
                                    <td>{{$itemEstrategia->id1}}</td>
                                    <td>{{$itemEstrategia->id2}}</td>
                                    
                                </tr>
                            @endforeach
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
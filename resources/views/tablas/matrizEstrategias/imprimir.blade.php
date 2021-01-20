<!DOCTYPE html>
<html lang="en">



  <head>
    <meta charset="utf-8" >
    <meta name="viewport" >
    <title>FODA System</title>

    
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" 
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons --> --}}


      {{-- <link  media="all"  rel="stylesheet"
         href="{{public_path('/adminlte/dist/css/adminlte.min.css') }}" />
  
      <link  media="all"  rel="stylesheet"
         href="/adminlte/dist/css/adminlte.min.css" />

      <link rel="stylesheet" 
        href="{{ ltrim(public_path('/adminlte/dist/css/adminlte.min.css'), '/') }}" />
 --}}


    <!-- Font Awesome ESTOS SON LOS ICONOS WE XD-->
    {{-- <link type="text/css"   rel="stylesheet" 
        href="/adminlte/plugins/fontawesome-free/css/all.min.css" />
 --}}
    
    <!-- overlayScrollbars -->
    {{-- <link  type="text/css"  rel="stylesheet" 
        href="{{public_path('/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}" />
     --}}<!-- Theme style -->
        <link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
        @page {
            margin: 0cm 0cm;
            font-size: 0.6em;
        }
        body {
            margin: 1cm 1cm 1cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 30px;
        }
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #46C66B;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>

  </head>
<body class="body">
<div class="wrapper">
  <!-- Navbar -->
          
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div >
     
               
    <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control"  
                    id="nombreEmpresa" name="nombreEmpresa" disabled = "disabled" 
                    value="{{$empresa->nombreEmpresa}}">



      <table class="table table-striped text-left">
        <tbody>
          <tr>
              <td>
                {{-- INICIO CELDA --}}
                    
                    
                   <h6> MATRIZ ESTRATEGIAS </h6>
                {{-- FIN CELDA --}}    
              </td>
              <td>
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
                                    <td>{{$itemFortalezas->nroEnEmpresa}}</td>
                                    <td>{{$itemFortalezas->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}    
              </td>
              <td>
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
                                    <td>{{$itemDebilidades->nroEnEmpresa}}</td>
                                    <td>{{$itemDebilidades->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                {{-- FIN CELDA --}}           
              </td>
        </tr>
        <tr>
           
              <td>
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
                                    <td>{{$itemOportunidades->nroEnEmpresa}}</td>
                                    <td>{{$itemOportunidades->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
              </td>
              <td>
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
          
                            <th scope="col" style = "width: 65%;">Estrategias FO</th>
                            <th scope="col" style = "width: 5%;">idF</th>
                            <th scope="col" style = "width: 5%;">idO</th>
                            
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
              </td>
              <td>
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                        
                            <th scope="col" style = "width: 65%;">Estrategias DO</th>
                            <th scope="col" style = "width: 5%;">idD</th>
                            <th scope="col" style = "width: 5%;">idO</th>
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
              </td>

         </tr>
          <tr>
     
              <td>
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
                                    <td>{{$itemAmenazas->nroEnEmpresa}}</td>
                                    <td>{{$itemAmenazas->descripcion}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   

                         
             
                {{-- FIN CELDA --}}    
              </td>
              <td>
                {{-- INICIO CELDA --}}            
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                        
                            <th scope="col" style = "width: 65%;">Estrategias FA</th>
                            <th scope="col" style = "width: 5%;">idF</th>
                            <th scope="col" style = "width: 5%;">idA</th>
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
                </td>
                <td>
                    {{-- INICIO CELDA --}}            
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                          
                                <th scope="col" style = "width: 65%;">Estrategias DA</th>
                                <th scope="col" style = "width: 5%;">idD</th>
                                <th scope="col" style = "width: 5%;">idA</th>
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

                </td>         
             </tr>
                {{-- FIN CELDA --}}    
            </div>
           
            
         
        <tbody>
      </table>

     

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

</body>
</html>

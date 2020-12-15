@extends('layout.plantilla')
@section('contenido')

<h1> Bienvenido al Sistema </h1>


<div class="card">
        <div class="card-header border-0">         
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Nombre</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
          </div>

          <button type="button" class="btn btn-primary"> <i class="fas fa-search"></i> Buscar</button>
          <button type="button" class="btn btn-primary"> <i class="fas fa-plus"></i> Agregar</button>
          <button type="button" class="btn btn-primary"> <i class="fas fa-edit"></i> Editar</button>
          <button type="button" class="btn btn-primary"> <i class="fas fa-trash-alt"></i> Eliminar</button>


          <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
          
            </a>
            <a href="#" class="btn btn-tool btn-sm">
       
            </a>
          </div>
        </div>

        <div class="card-body table-responsive p-0">
          <table class="table table-striped table-valign-middle">
            <thead>
            <tr>
              <th>Nombre de la Empresa</th>
              <th>RUC</th>
              <th>Direccion</th>
              <th>TIPO</th>
            </tr>
            </thead>
            <tbody>

                    <?php
                    /*     if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                            echo "nombre:" . $row["nombre"]. " - apellidos: " . $row["apellidos"]. " DNI: " . $row["dni"]. "   ". $row["tipo"] ." <br>";
                            }
                        } else {
                            echo "0 results";
                        } */
                 /*        $conn->close(); */
                    ?> 

            <tr>
              <td>Youtube S.A.C</td>
              <td>152346235473</td>
              <td>El porvenir MZ55</td>
              <td>ONG</td>
            </tr>

            <tr>
              <td>Discord E.I.R.L</td>
              <td>1475475754</td>
              <td>San Isidro calle oro 252</td>
              <td>Sociedad</td>
            </tr>
                        
                          










            </tbody>
          </table>
        </div>
      </div>


@endsection
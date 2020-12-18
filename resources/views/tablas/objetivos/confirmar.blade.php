@extends('layout.plantillaUser')
@section('contenido')

    <div class="container">
        <h1>¿Desea eliminar el siguiente Objetivo Estrategico?</h1> 
        
        <h3>
        idObjetivo : {{ $objetivo->idObjetivoEst }} - Descripcion  {{ $objetivo->descripcionObj }}  </h3>
                                    {{-- nombre de la ruta,         atributo --}}
        <form method="POST" action="{{route('objetivo.destroy',$objetivo->idObjetivoEst)}}">
            @method('delete')
            @csrf
        

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-check-square"></i>
                    Sí
             </button>
            <a href="{{route('empresa.edit',$objetivo->empresa_idEmpresa)}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>No</a>

          </form>

    </div>

@endsection
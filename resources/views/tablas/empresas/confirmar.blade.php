@extends('layout.plantilla')
@section('contenido')

    <div class="container">
        <h1>¿Desea eliminar el siguiente registro?</h1> 
        
        <h3>
        idEmpresa : {{ $empresa->idEmpresa }} - Nombre de la Empresa  {{ $empresa->nombreEmpresa }}  </h3>
                                    {{-- nombre de la ruta,         atributo --}}
        <form method="POST" action="{{route('empresa.destroy',$empresa->idEmpresa)}}">
            @method('delete')
            @csrf
        

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-check-square"></i>
                    Sí
             </button>
            <a href="{{ route('cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>No</a>

          </form>

    </div>

@endsection
@extends('layout.plantilla')
@section('contenido')

    <div class="container">
        <h1>¿Desea eliminar el siguiente elemento FODA?</h1> 
        
        <h3>
        idElemento : {{ $elemento->idElemento }} - Descripción: {{ $elemento->descripcion}}  </h3>
                                    {{-- nombre de la ruta,         atributo --}}
        <form method="POST" action="{{route('elemento.destroy',$elemento->idElemento)}}">
            @method('delete')
            @csrf
        

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-check-square"></i>
                    Sí
             </button>
            <a href="{{ route('empresa.foda',$elemento->empresa_idEmpresa)}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>No</a>

          </form>

    </div>

@endsection
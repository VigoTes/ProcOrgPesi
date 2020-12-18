@extends('layout.plantillaUser')
@section('contenido')

    <div class="container">
        <h1>¿Desea eliminar la siguiente estrategia ?</h1> 
        
        <h3>
        idEstrategia : {{ $estrategia->idEstrategia }}
        <br>
        Descripción:  {{ $estrategia->descripcion }}  </h3>
                                    {{-- nombre de la ruta,         atributo --}}
        <form method="POST" action="{{route('estrategia.destroy',$estrategia->idEstrategia)}}">
            @method('delete')
            @csrf
            

            <button type="submit" class="btn btn-danger">
                <i class="fas fa-check-square"></i>
                    Sí
             </button>
            <a href="{{route('estrategia.cancelar',$estrategia->idEstrategia)}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>No</a>

          </form>

    </div>

@endsection
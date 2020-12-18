@extends('layout.plantillaUser')
@section('contenido')
    <form method="POST" action="{{route('estrategia.update',$estrategia->idEstrategia)}}">
            @method('put')
            @csrf
            <div class="form-group">
                    <label for="categoria_id">Codigo:</label>
                <input type="text" class="form-control" id="categoria_id" name="categoria_id" value='{{$estrategia->idEstrategia}}' disabled>
            </div>

            <div class="form-group">
              <label for="descripcion">Descripcion:</label>
              <input type="text" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"  value='{{$estrategia->descripcion}}' name="descripcion">
              @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Grabar</button>
            <a href="{{route('estrategia.cancelar',$estrategia->idEstrategia)}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
          </form>


@endsection
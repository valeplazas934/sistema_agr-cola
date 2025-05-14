@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Detalles de Categoría</h2>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h3>{{ $categoria->nombre }}</h3>
                        <p class="text-muted">Creado el: {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mb-4">
                        <h4>Descripción:</h4>
                        <p>{{ $categoria->descripcion }}</p>
                    </div>

                    <div class="mb-4">
                        <h4>Cultivos en esta categoría:</h4>
                        @if($categoria->cultivosPublicacion->count() > 0)
                            <ul class="list-group">
                            @foreach($categoria->cultivosPublicacion as $cultivo)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('cultivations.show', $cultivo->id) }}">
                                        {{ $cultivo->cropTitle }}
                                    </a>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $cultivo->created_at->format('d/m/Y') }}
                                    </span>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info">
                                No hay cultivos registrados en esta categoría.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <div>
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('¿Está seguro que desea eliminar esta categoría?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
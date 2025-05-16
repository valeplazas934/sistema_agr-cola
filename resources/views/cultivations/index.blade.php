@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-success"><i class="bi bi-seedling"></i> Publicaciones de Cultivo</h2>

    <a href="{{ route('cultivations.create') }}" class="btn btn-success mb-4">
        <i class="bi bi-plus-circle"></i> Nueva Publicación
    </a>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-primary">{{ $post->cropTitle }}</h3>
                        <p class="card-subtitle mb-2 text-muted">
                            <strong>Categoría:</strong> {{ $post->category->name ?? 'Sin categoría' }}
                        </p>
                        <p class="card-text">
                            <strong>Contenido:</strong> {{ $post->cropContent }}
                        </p>
                        <p class="card-text">
                            <small class="text-muted">
                                Publicado por <strong>{{ $post->user->name }}</strong> el {{ $post->creationDate->format('d/m/Y') }}
                            </small>
                        </p>
                    </div>
                    <div class="card-footer bg-white d-flex gap-2">
                        <a href="{{ route('cultivations.show', $post) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye"></i> Ver
                        </a>

                        @if (auth()->id() === $post->idUser)
                            <a href="{{ route('cultivations.edit', $post) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('cultivations.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No hay publicaciones disponibles.
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection


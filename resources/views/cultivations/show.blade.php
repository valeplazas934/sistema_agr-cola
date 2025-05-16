@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $publication->cropTitle }}</h1>

   <p><strong>Categoría:</strong>
    @if($publication->category)
        {{ $publication->category->idCategory }}
    @endif
    </p>

    <p><strong>Autor:</strong>
        @if($publication->user)
            {{ $publication->user->name }}
        @else
            Autor desconocido
        @endif
    </p>

    <p><strong>Contenido:</strong></p>
    <p>{{ $publication->cropContent }}</p>

    <a href="{{ route('cultivations.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
<hr>
<h4>Comentarios</h4>

@foreach($publication->comments as $comment)
    <div class="mb-3 border rounded p-3">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->content }}</p>
        <small>{{ $comment->created_at->diffForHumans() }}</small>

        @if(auth()->id() === $comment->idUser)
            <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar comentario?')">Eliminar</button>
            </form>
        @endif
    </div>
@endforeach

<hr>
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="idCultivationPublication" value="{{ $publication->id }}">
    <div class="mb-3">
        <label for="content">Nuevo comentario</label>
        <textarea name="content" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary">Publicar comentario</button>
</form>

@endsection

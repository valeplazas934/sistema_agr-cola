@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Comentario</h3>

    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <textarea name="content" class="form-control" required>{{ $comment->content }}</textarea>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('cultivations.show', $comment->idCultivationPublication) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
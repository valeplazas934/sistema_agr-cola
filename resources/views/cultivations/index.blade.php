@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Publicaciones de Cultivo</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cultivations.create') }}" class="btn btn-primary mb-3">Nueva Publicación</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->cropTitle }}</td>
                    <td>{{ $post->category->name ?? 'Sin categoría' }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <a href="{{ route('cultivations.show', $post) }}" class="btn btn-info btn-sm">Ver</a>
                        @if(auth()->id() === $post->idUser)
                            <a href="{{ route('cultivations.edit', $post) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('cultivations.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?')">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No hay publicaciones.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

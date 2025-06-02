@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Publicaciones de Cultivos</h1>

    <a href="{{ route('admin.cultivations.create') }}" class="btn btn-primary mb-3">Nueva Publicación</a>

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cultivations as $cultivation)
            <tr>
                <td>{{ $cultivation->title }}</td>
                <td>{{ $cultivation->user->name }}</td>
                <td>{{ $cultivation->category->name }}</td>
                <td>
                    <a href="{{ route('admin.cultivations.edit', $cultivation) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.cultivations.destroy', $cultivation) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar publicación?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

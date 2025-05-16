@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Publicación</h1>

    <form action="{{ route('cultivations.update', $cultivation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cropTitle" class="form-label">Título</label>
            <input type="text" name="cropTitle" class="form-control" value="{{ old('cropTitle', $cultivation->cropTitle) }}" required>
        </div>

        <div class="mb-3">
            <label for="cropContent" class="form-label">Contenido</label>
            <textarea name="cropContent" class="form-control" rows="5" required>{{ old('cropContent', $cultivation->cropContent) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="idCategory" class="form-label">Categoría</label>
            <select name="idCategory" class="form-control">
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $cultivation->idCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection

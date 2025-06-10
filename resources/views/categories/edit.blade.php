@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-6">

        <h2 class="text-2xl font-bold text-green-700 mb-4">
            <i class="bi bi-pencil-square"></i> Editar Categoría
        </h2>

        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre de la Categoría</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="w-full px-4 py-2 border rounded @error('name') border-red-500 @enderror" 
                    value="{{ old('name', $category->name) }}" 
                    required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4" 
                    class="w-full px-4 py-2 border rounded @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

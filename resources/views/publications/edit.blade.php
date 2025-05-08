@extends('layouts.app')

@section('title', 'Editar Publicación')

@section('content')
<div class="mb-4">
    <a href="{{ route('publications.show', $publication) }}" class="text-green-600 hover:underline flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Volver a la publicación
    </a>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-bold text-green-800 mb-6">Editar Publicación</h1>
    
    <form method="POST" action="{{ route('publications.update', $publication) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="cropTitle" class="block text-gray-700 font-bold mb-2">Título del Cultivo</label>
            <input type="text" name="cropTitle" id="cropTitle" value="{{ old('cropTitle', $publication->cropTitle) }}" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cropTitle') border-red-500 @enderror">
            @error('cropTitle')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Categoría</label>
            <select name="category_id" id="category_id" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Selecciona una categoría (opcional)</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $publication->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="cropContent" class="block text-gray-700 font-bold mb-2">Contenido</label>
            <textarea name="cropContent" id="cropContent" rows="10" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cropContent') border-red-500 @enderror">{{ old('cropContent', $publication->cropContent) }}</textarea>
            @error('cropContent')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
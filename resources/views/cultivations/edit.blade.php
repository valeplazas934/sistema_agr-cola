@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">

    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-3xl font-bold text-green-700 mb-6">✏️ Editar Publicación</h1>

        <form action="{{ route('cultivations.update', $cultivation) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div>
                <label for="cropTitle" class="block text-gray-700 font-semibold mb-2">Título del cultivo</label>
                <input type="text" name="cropTitle" id="cropTitle"
                       class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-green-400"
                       value="{{ old('cropTitle', $cultivation->cropTitle) }}" required>
            </div>

            {{-- Contenido --}}
            <div>
                <label for="cropContent" class="block text-gray-700 font-semibold mb-2">Contenido</label>
                <textarea name="cropContent" id="cropContent" rows="6"
                          class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-green-400"
                          required>{{ old('cropContent', $cultivation->cropContent) }}</textarea>
            </div>

            {{-- Categoría --}}
            <div>
                <label for="idCategory" class="block text-gray-700 font-semibold mb-2">Categoría</label>
                <select name="idCategory" id="idCategory"
                        class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-green-400">
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $cultivation->idCategory == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('cultivations.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                    ← Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">
                    💾 Actualizar publicación
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

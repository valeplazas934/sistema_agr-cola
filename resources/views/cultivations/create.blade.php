@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded-2xl shadow-md mt-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">
        <i class="bi bi-journal-plus"></i> Crear Nueva Publicación
    </h2>

    <form method="POST" action="{{ route('cultivations.store') }}">
        @csrf

        <!-- Título -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Título</label>
            <input type="text" name="cropTitle" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-400" required>
        </div>

        <!-- Contenido -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Contenido</label>
            <textarea name="cropContent" id="editor" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>

        <!-- Categoría -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1">Categoría</label>
            <select name="idCategory" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-400" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-between">
            <a href="{{ route('cultivations.index') }}" class="px-5 py-2 text-gray-600 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition">
                ← Volver
            </a>
            <button type="submit" class="px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'image link lists',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | image link | bullist numlist',
        height: 300
    });
</script>
@endsection

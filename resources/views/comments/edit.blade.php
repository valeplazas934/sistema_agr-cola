@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">✏️ Editar Comentario</h2>

        <form action="{{ route('comments.update', $comment) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="content" class="block text-gray-700 font-semibold mb-2">Contenido del Comentario</label>
                <textarea name="content" id="content" rows="5"
                          class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                          required>{{ $comment->content }}</textarea>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('cultivations.show', $comment->idCultivationPublication) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded hover:bg-gray-300 transition">
                    ← Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded hover:bg-gray-300 transition">
                    💾 Actualizar
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

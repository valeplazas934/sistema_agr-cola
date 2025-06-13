@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    {{-- Publicación --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h1 class="text-3xl font-bold text-green-700 mb-4">{{ $cultivation->cropTitle }}</h1>

        <div class="text-gray-600 space-y-2 mb-6">
            <p>
                <span class="font-semibold text-gray-700">Categoría:</span>
                {{ $cultivation->category->name ?? 'Sin categoría' }}
            </p>
            <p>
                <span class="font-semibold text-gray-700">Autor:</span>
                {{ $cultivation->user->name ?? 'Desconocido' }} {{ $cultivation->user->lastName ?? '' }}
            </p>
        </div>

        <div class="prose max-w-none text-gray-800">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Contenido:</h2>
            <p class="leading-relaxed">{{ $cultivation->cropContent }}</p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>

        <a href="{{ session('url_origen', route('cultivations.index')) }}" class="text-blue-600 hover:underline">
            ← Volver
        </a>



    </div>

    {{-- Comentarios --}}
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">💬 Comentarios</h2>
            @foreach($cultivation->comments->where('parent_id', null) as $comment)
                <div class="border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

                    {{-- Botones del autor --}}
                    @if(auth()->id() === $comment->idUser)
                        <div class="flex space-x-2 mb-2">
                            <a href="{{ route('comments.edit', $comment) }}" class="text-blue-700">✏️ Editar</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('¿Eliminar comentario?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-blue-700">🗑️ Eliminar</button>
                            </form>
                        </div>
                    @endif

                    {{-- Formulario de respuesta --}}
                    <details class="mb-3">
                        <summary class="cursor-pointer text-sm text-green-700">💬 Responder</summary>
                        <form action="{{ route('comments.store') }}" method="POST" class="mt-2 space-y-2">
                            @csrf
                            <input type="hidden" name="idCultivationPublication" value="{{ $cultivation->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="content" rows="2" class="w-full p-2 border rounded text-sm" placeholder="Tu respuesta..." required></textarea>
                            <button class="text-sm text-blue-700">Responder</button>
                        </form>
                    </details>

                    {{-- Mostrar respuestas --}}
                    @foreach($comment->replies as $reply)
                        <div class="ml-6 border-l-2 border-gray-300 pl-4 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-800 font-medium">{{ $reply->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $reply->content }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach

    </div>

    {{-- Formulario nuevo comentario --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-green-600 mb-4">➕ Agregar comentario</h2>
        <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="idCultivationPublication" value="{{ $cultivation->id }}">

            <div>
                <label for="content" class="block text-gray-700 font-medium mb-1">Contenido</label>
                <textarea name="content" rows="4"
                          class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                          placeholder="Escribe tu comentario..." required></textarea>
            </div>

            <button type="submit"
                    class="text-1xl font-semibold text-blue-700 mb-4">
                💬 Publicar
            </button>
        </form>
    </div>

</div>
@endsection


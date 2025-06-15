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

    <div x-data="{ showComments: false }" class="mt-6">
        <!-- Botón para mostrar u ocultar comentarios -->
        <button @click="showComments = !showComments"
            class="text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded mb-4">
            <template x-if="!showComments">Mostrar Comentarios</template>
            <template x-if="showComments">Ocultar Comentarios</template>
        </button>
        <div class="mt-6 p-4 bg-white shadow rounded">
            <h3 class="text-lg font-bold mb-4">Agregar nuevo comentario</h3>

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="idCultivationPublication" value="{{ $cultivation->id }}">
                
                <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="Escribe tu comentario...">{{ old('content') }}</textarea>

                @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Publicar comentario
                </button>
            </form>
        </div>


        <!-- Sección de comentarios -->
        <div x-show="showComments" x-transition>
            <h2 class="text-xl font-semibold mb-4"><i class="fa-regular fa-comments"></i> Comentarios</h2>

            @foreach ($cultivation->comments as $comment)
                <div class="bg-gray-100 p-4 mb-2 rounded shadow-sm">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->content }}</p>
                    <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

                    @if (Auth::id() === $comment->idUser)
                        <div class="mt-2">
                            <a href="{{ route('comments.edit', $comment) }}" class="text-orange-500 hover:underline">
                                ✏️ Editar
                            </a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Botón para mostrar formulario de respuesta -->
                    <div x-data="{ showReply: false }" class="mt-2">
                        <button @click="showReply = !showReply"
                            class="text-green-600 hover:underline">💬 Responder</button>

                        <div x-show="showReply" x-transition class="mt-2">
                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                @csrf
                                <textarea name="reply" class="w-full rounded p-2 border" rows="2" placeholder="Escribe tu respuesta..."></textarea>
                                <button type="submit"
                                    class="mt-2 bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                                    Enviar
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Mostrar respuestas al comentario -->
                    @foreach ($comment->replies as $reply)
                        <div class="ml-6 mt-3 border-l-2 border-green-500 pl-3 bg-white rounded">
                            <strong>{{ $reply->user->name }}</strong>
                            <p>{{ $reply->content }}</p>
                            <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>


</div>
@endsection


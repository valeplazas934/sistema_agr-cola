@extends('layouts.app')

@section('title', $publication->cropTitle)

@section('content')
<div class="mb-4">
    <a href="{{ route('publications.index') }}" class="text-green-600 hover:underline flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Volver a publicaciones
    </a>
</div>

<article class="bg-white shadow-md rounded-lg p-6 mb-6">
    <header class="mb-4">
        <h1 class="text-3xl font-bold text-green-800 mb-2">{{ $publication->cropTitle }}</h1>
        <div class="text-sm text-gray-500 mb-4">
            <span>Por: {{ $publication->user->name }} {{ $publication->user->lastName }}</span>
            <span class="mx-2">|</span>
            <span>{{ $publication->creationDate->format('d/m/Y H:i') }}</span>
            @if($publication->category)
                <span class="mx-2">|</span>
                <a href="{{ route('categories.show', $publication->category) }}" class="text-green-600 hover:underline">
                    {{ $publication->category->name }}
                </a>
            @endif
        </div>
    </header>

    <div class="prose max-w-none text-gray-700 mb-6">
        {!! nl2br(e($publication->cropContent)) !!}
    </div>

    @if(Auth::id() === $publication->idUser)
        <div class="flex space-x-4 mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('publications.edit', $publication) }}" class="text-blue-600 hover:underline flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Editar
            </a>
            <form method="POST" action="{{ route('publications.destroy', $publication) }}" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline flex items-center" onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Eliminar
                </button>
            </form>
        </div>
    @endif
</article>

<section class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-green-800 mb-4">Comentarios ({{ $publication->comments->count() }})</h2>
    
    @auth
        <form method="POST" action="{{ route('comments.store', $publication) }}" class="mb-8">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Agregar un comentario</label>
                <textarea name="content" id="content" rows="4" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror"
                    placeholder="Escribe tu comentario aquí..."></textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Publicar Comentario
                </button>
            </div>
        </form>
    @else
        <div class="bg-gray-100 p-4 rounded-lg mb-8">
            <p class="text-gray-700">
                <a href="{{ route('login.show') }}" class="text-green-600 hover:underline">Inicia sesión</a> o
                <a href="{{ route('register.show') }}" class="text-green-600 hover:underline">regístrate</a> para comentar.
            </p>
        </div>
    @endauth
    
    <div class="space-y-6">
        @forelse($publication->comments as $comment)
            <div class="bg-gray-50 p-4 rounded-lg">
                <div class="flex justify-between mb-2">
                    <div class="font-semibold text-gray-700">{{ $comment->user->name }} {{ $comment->user->lastName }}</div>
                    <div class="text-sm text-gray-500">{{ $comment->creationDate->format('d/m/Y H:i') }}</div>
                </div>
                <p class="text-gray-700">{{ $comment->content }}</p>
                @if(Auth::id() === $comment->idUser)
                    <div class="mt-2 text-right">
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-sm hover:underline" onclick="return confirm('¿Estás seguro de eliminar este comentario?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-700">No hay comentarios. ¡Sé el primero en comentar!</p>
        @endforelse
    </div>
</section>
@endsection
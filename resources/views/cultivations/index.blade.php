@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
     <div class="flex justify-center">
        <h2 class="text-2xl font-semibold text-green-700 mb-6 flex items-center gap-2">
          <i class="bi bi-seedling"></i> PUBLICACIONES DE CULTIVOS
        </h2>
    </div>
    <a href="{{ route('cultivations.create') }}" class="inline-block mb-6 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        <i class="bi bi-plus-circle"></i> Nueva Publicación
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse ($posts as $post)
            <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-xl font-semibold text-green-700 mb-2">
                        <a href="{{ route('cultivations.show', $post) }}" class="hover:underline">{{ $post->cropTitle }}</a>
                    </h3>
                    <div class="text-sm text-gray-500 mb-3">
                        <span>Por: {{ $post->user->name }} {{ $post->user->lastName }}</span>
                        <span class="mx-2">|</span>
                        <span>{{ $post->creationDate->format('d/m/Y') }}</span>
                        @if($post->category)
                            <span class="mx-2">|</span>
                            <a href="{{ route('categories.show', $post->category) }}" class="text-green-600 hover:underline">
                                {{ $post->category->name }}
                            </a>
                        @endif
                    </div>
                    <p class="text-gray-700">{{ Str::limit($post->cropContent, 150) }}</p>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('cultivations.show', $post) }}" class="px-3 py-1 text-sm border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id === $post->idUser))
                        <a href="{{ route('cultivations.edit', $post) }}" class="px-3 py-1 text-sm border border-yellow-500 text-yellow-500 rounded hover:bg-yellow-50">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('cultivations.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Eliminar publicación?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-sm border border-red-500 text-red-500 rounded hover:bg-red-50">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-600">
                No hay publicaciones disponibles.
            </div>
        @endforelse
    </div>

    <div class="mt-8 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection


@extends('layouts.app')

@section('title', 'Publicaciones')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-green-800">Publicaciones de Cultivo</h1>
    @auth
        <a href="{{ route('publications.create') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
            Nueva Publicación
        </a>
    @endauth
</div>

@if($publications->isEmpty())
    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="text-gray-700">No hay publicaciones disponibles.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($publications as $publication)
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-semibold text-green-700 mb-2">
                    <a href="{{ route('publications.show', $publication) }}">{{ $publication->cropTitle }}</a>
                </h2>
                <div class="text-sm text-gray-500 mb-2">
                    <span>Por: {{ $publication->user->name }} {{ $publication->user->lastName }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $publication->creationDate->format('d/m/Y') }}</span>
                    @if($publication->category)
                        <span class="mx-2">|</span>
                        <a href="{{ route('categories.show', $publication->category) }}" class="text-green-600 hover:underline">
                            {{ $publication->category->name }}
                        </a>
                    @endif
                </div>
                <p class="text-gray-700 mb-4">{{ Str::limit($publication->cropContent, 200) }}</p>
                <a href="{{ route('publications.show', $publication) }}" class="text-green-600 hover:underline">
                    Leer más
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $publications->links() }}
    </div>
@endif
@endsection

@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 mb-10">
    <h1 class="text-3xl font-bold text-green-800 mb-4">Bienvenido al Sistema Agrícola</h1>
    <p class="text-gray-700 mb-6">Una plataforma para compartir conocimientos sobre técnicas de cultivo, experiencias agrícolas y más.</p>
    
    @guest
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-6 rounded">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-6 rounded">
                Registrarse
            </a>
        </div>
    @else
        <a href="{{ route('cultivations.create') }}" class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-6 rounded">
            Crear Publicación
        </a>
    @endguest
</div>

<div class="flex flex-col md:flex-row gap-6">
    <div class="md:w-2/3">
        <h2 class="text-2xl font-bold text-green-800 mb-4">Publicaciones Recientes</h2>
        @if($recentPublications->isEmpty())
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-gray-700">No hay publicaciones disponibles.</p>
            </div>
        @else
            @foreach($recentPublications as $publication)
                <div class="bg-white shadow-md rounded-lg p-6 mb-4 hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">
                        <a href="{{ route('cultivations.show', $publication) }}">{{ $publication->cropTitle }}</a>
                    </h3>
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
                    <p class="text-gray-700 mb-4">{{ Str::limit($publication->cropContent, 150) }}</p>
                    <a href="{{ route('cultivations.show', $publication) }}" class="text-green-600 hover:underline">
                        Leer más
                    </a>
                </div>
            @endforeach
            <div class="mt-4">
                <a href="{{ route('cultivations.index') }}" class="text-green-600 hover:underline font-semibold">
                    Ver todas las publicaciones
                </a>
            </div>
        @endif
    </div>
    
    <div class="md:w-1/3">
        <h2 class="text-2xl font-bold text-green-800 mb-4">Categorías</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            @if($categories->isEmpty())
                <p class="text-gray-700">No hay categorías disponibles.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <li class="py-2">
                            <a href="{{ route('categories.show', $category) }}" class="flex justify-between items-center text-gray-700 hover:text-green-600">
                                <span>{{ $category->name }}</span>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $category->cultivation_publications_count }} publicaciones
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('categories.index') }}" class="text-green-600 hover:underline font-semibold">
                        Ver todas las categorías
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
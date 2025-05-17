@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

        <div class="mb-6 border-b pb-4">
            <h2 class="text-3xl font-bold text-green-700 mb-2">
                {{ $category->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Creado el: {{ $category->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-700 mb-2">Descripción</h4>
            <p class="text-gray-800">{{ $category->description }}</p>
        </div>

        <div class="mb-6">
            <h4 class="text-lg font-semibold text-gray-700 mb-3">Cultivos en esta categoría</h4>
            @if($category->cultivationPublications->count() > 0)
                <ul class="list-group space-y-2">
                    @foreach($category->cultivationPublications as $cultivation)
                        <li class="list-group-item flex justify-between items-center bg-gray-50 border rounded px-4 py-2 hover:bg-gray-100 transition">
                            <a href="{{ route('cultivations.show', $cultivation->id) }}" class="text-green-700 font-medium hover:underline">
                                {{ $cultivation->cropTitle }}
                            </a>
                            <span class="text-sm text-gray-600">
                                {{ $cultivation->created_at->format('d/m/Y') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-info mt-2">
                    No hay cultivos registrados en esta categoría.
                </div>
            @endif
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>

            <div class="flex gap-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-warning">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar esta categoría?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

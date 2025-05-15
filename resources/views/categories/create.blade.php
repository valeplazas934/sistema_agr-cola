@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-6">Crear Nueva Categoría</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold mb-1">Nombre de la Categoría</label>
                <input type="text" name="name" id="name" required
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-green-500">
            </div>

            <div class="mb-6">
                <label for="description" class="block text-lg font-semibold mb-1">Descripción</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-green-500"
                    required>{{ old('description') }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('categories.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Volver
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-semibold">
                    Guardar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

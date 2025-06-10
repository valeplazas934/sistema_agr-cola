@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-extrabold text-green-700">Categorías de Cultivos</h2>
        <a href="{{ route('categories.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-md shadow-md transition">
            <i class="fas fa-plus mr-2"></i> Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if($categories->count())
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-600 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-green-600 uppercase tracking-wider">Fecha de Creación</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-green-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ Str::limit($category->description, 60) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-1">
                            <a href="{{ route('categories.show', $category->id) }}" 
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm" 
                            title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if(auth()->user() && auth()->user()->isAdmin())
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm"
                                title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" 
                                    onsubmit="return confirm('¿Está seguro que desea eliminar esta categoría?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>

    @else
        <div class="p-4 bg-yellow-100 text-yellow-700 rounded-md text-center font-medium">
            No hay categorías registradas actualmente.
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Gestión de Usuarios</h1>

    {{-- Tabla de usuarios --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg">
            <thead class="bg-green-100 text-green-800">
                <tr>
                    <th class="py-2 px-4 text-left">id</th>
                    <th class="py-2 px-4 text-left">Nombre</th>
                    <th class="py-2 px-4 text-left">Email</th>
                    <th class="py-2 px-4 text-left">Rol</th>
                    <th class="py-2 px-4 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $user->id }}</td>
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4 capitalize">{{ $user->role }}</td>
                        <td class="py-2 px-4">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabla de usuarios -->
        <table class="...">
            <!-- tu tabla actual -->
        </table>

        <!-- Botón para volver -->
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}"
            class="bg-green-600 hover:bg-green-500 text-white font-bold py-2 px-4 rounded inline-block">
                ← Volver al Panel
            </a>
        </div>

    </div>
</div>
@endsection
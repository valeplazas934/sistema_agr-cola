@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Panel de Administración</h1>

    {{-- Accesos directos --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <a href="{{ route('admin.users.create') }}" class="bg-green-600 text-white p-4 rounded-lg shadow hover:bg-green-700 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg">Nuevo Usuario</h3>
                <p class="text-sm text-blue-100">Crear un nuevo usuario</p>
            </div>
            <i class="fas fa-user-plus text-2xl"></i>
        </a>

        <a href="{{ route('admin.categories.create') }}" class="bg-green-600 text-white p-4 rounded-lg shadow hover:bg-green-700 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg">Nueva Categoría</h3>
                <p class="text-sm text-yellow-100">Crear una categoría</p>
            </div>
            <i class="fas fa-folder-plus text-2xl"></i>
        </a>

        <a href="{{ route('admin.cultivations.create') }}" class="bg-green-600 text-white p-4 rounded-lg shadow hover:bg-green-700 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg">Nueva Publicación</h3>
                <p class="text-sm text-green-100">Crear una publicación</p>
            </div>
            <i class="fas fa-plus-circle text-2xl"></i>
        </a>
    </div>


    <div class="text-gray-600 mb-4">
        <p><strong>Fecha actual:</strong> {{ now()->format('d/m/Y') }}</p>
    </div>

    {{-- Resumen general --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total de Usuarios</p>
                    <h2 class="text-xl font-semibold">{{ $usersCount }}</h2>
                </div>
                <i class="fas fa-users text-green-600 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Publicaciones</p>
                    <h2 class="text-xl font-semibold">{{ $cultivationsCount }}</h2>
                </div>
                <i class="fas fa-leaf text-blue-600 text-2xl"></i>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Categorías</p>
                    <h2 class="text-xl font-semibold">{{ $categoriesCount }}</h2>
                </div>
                <i class="fas fa-tags text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">

        <!-- Usuarios -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Gestión de Usuarios</h2>
            <p class="text-gray-600 mb-2">Ver, editar o eliminar usuarios registrados.</p>
            <p class="text-sm text-gray-500 mb-4">Total: <strong>{{ $totalUsers }}</strong> usuarios</p>
            <a href="{{ route('admin.users.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Administrar Usuarios
            </a>
        </div>

        <!-- Publicaciones -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Publicaciones</h2>
            <p class="text-gray-600 mb-2">Gestiona las publicaciones agrícolas.</p>
            <p class="text-sm text-gray-500 mb-4">Total: <strong>{{ $totalCultivations }}</strong> publicaciones</p>
            <a href="{{ route('admin.cultivations.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Ver Publicaciones
            </a>
        </div>

        <!-- Categorías -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Categorías</h2>
            <p class="text-gray-600 mb-2">Administra las categorías disponibles.</p>
            <p class="text-sm text-gray-500 mb-4">Total: <strong>{{ $totalCategories }}</strong> categorías</p>
            <a href="{{ route('admin.categories.index') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Ver Categorías
            </a>
        </div>

    </div>
</div>
@endsection
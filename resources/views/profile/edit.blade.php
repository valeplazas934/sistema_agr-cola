@extends('layouts.app') {{-- Usa tu layout base si es diferente --}}

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-center">
       <h1 class="text-2xl font-bold mb-6">EDITAR PERFIL</h1>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    {{-- Formulario de edición --}}
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block font-medium">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="lastName" class="block font-medium">Apellido</label>
            <input type="text" name="lastName" id="lastName" value="{{ old('lastName', $user->lastName) }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('lastName')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Botón para guardar cambios --}}
        <div class="flex justify-center">
            <button type="submit" class="text-1xl font-bold mb-6">
                GUARDAR CAMBIOS
            </button>
        </div>
    </form>
    <hr class="my-6">

    <div class="flex justify-center">
       <h2 class="text-xl font-semibold mb-4">CAMBIAR CONTRASEÑA</h2>
    </div>

    @if (session('password_status'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('password_status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="current_password" class="block font-medium">Contraseña Actual</label>
            <input type="password" name="current_password" id="current_password" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium">Nueva Contraseña</label>
            <input type="password" name="password" id="password" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="text-1xl font-bold mb-6">
                CAMBIAR CONTRASEÑA
            </button>
        </div>

    </form>


    {{-- Separador --}}
    <hr class="my-6">

    {{-- Formulario para eliminar la cuenta --}}
    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-1xl font-bold mb-6">
            Eliminar Cuenta
        </button>
    </form>
</div>
@endsection

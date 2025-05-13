@extends('layouts.app')

@section('title', 'Perfil de Usuario')

@section('content')
<div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-6">Perfil del Usuario</h2>

        <div class="mb-4">
            <strong>ID:</strong> {{ Auth::user()->id }}
        </div>
        <div class="mb-4">
            <strong>Nombre:</strong> {{ Auth::user()->name }}
        </div>
        <div class="mb-4">
            <strong>Apellido:</strong> {{ Auth::user()->lastName }}
        </div>
        <div class="mb-4">
            <strong>Email:</strong> {{ Auth::user()->email }}
        </div>
        <div class="mb-4">
            <strong>Registrado el:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}
        </div>

        <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Editar Perfil
        </a>
    </div>
</div>
@endsection


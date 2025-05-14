@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Información Personal') }}
                        </h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Nombre') }}</p>
                                <p class="mt-1">{{ $user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Apellido') }}</p>
                                <p class="mt-1">{{ $user->lastName }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Correo Electrónico') }}</p>
                                <p class="mt-1">{{ $user->email }}</p>
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
                                    @if ($user->hasVerifiedEmail())
                                        <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ __('Verificado') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ __('No Verificado') }}
                                        </span>
                                    @endif
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">{{ __('Cuenta creada el') }}</p>
                                <p class="mt-1">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-6 space-x-4">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Editar Perfil') }}
                        </a>

                        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta?');">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="block font-medium">
                                Eliminar Cuenta
                            </button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
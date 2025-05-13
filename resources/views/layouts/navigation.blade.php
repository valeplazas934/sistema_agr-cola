<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo o nombre del sistema -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-green-700">
                    Sistema Agrícola
                </a>
            </div>

            <!-- Enlaces del menú -->
            <div class="flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-700">Inicio</a>
                <a href="{{ route('publications.index') }}" class="text-gray-700 hover:text-green-700">Publicaciones</a>
                <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-green-700">Categorías</a>
            </div>

            <!-- Dropdown del usuario -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Nombre del usuario autenticado -->
                    <div class="text-gray-800">
                        Bienvenido, {{ Auth::user()->name }}
                    </div>

                    <!-- Dropdown de opciones -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Perfil -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                Perfil
                            </x-dropdown-link>

                            <!-- Cerrar sesión -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Enlaces para invitados -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-700">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

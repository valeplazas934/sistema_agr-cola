<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-green-700">
                    Sistema Agrícola
                </a>
            </div>

            <!-- Enlaces del menú -->
            <div class="flex space-x-8 items-center">
                @auth
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <!-- Menú del administrador -->
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-700">Panel de Administrador</a>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Usuarios</a>
                        <a href="{{ route('admin.cultivations.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Publicaciones</a>
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Categorías</a>
                    @else
                        <!-- Menú para usuarios normales -->
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-700">Inicio</a>
                        <a href="{{ route('cultivations.index') }}" class="text-gray-700 hover:text-green-700">Publicaciones</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-green-700">Categorías</a>
                    @endif
                @endauth
            </div>

            <!-- Dropdown del usuario -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="text-gray-800">
                        Bienvenido, {{ Auth::user()->name }}
                    </div>

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
                            
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                Perfil
                            </x-dropdown-link>
                            
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
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-700">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-700">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

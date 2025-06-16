<nav class="bg-white border-b border-gray-100" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-green-700">
                    Sistema Agrícola
                </a>
            </div>

            <!-- Botón hamburguesa (solo visible en pantallas pequeñas) -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-green-700 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Enlaces del menú (pantallas grandes) -->
            <div class="hidden sm:flex sm:items-center space-x-8">
                @auth
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-700">Panel de Administrador</a>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Usuarios</a>
                        <a href="{{ route('cultivations.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Publicaciones</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-green-700">Gestionar Categorías</a>
                    @else
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-700">Inicio</a>
                        <a href="{{ route('cultivations.index') }}" class="text-gray-700 hover:text-green-700">Publicaciones</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-green-700">Categorías</a>
                    @endif
                @endauth
            </div>

            <!-- Dropdown del usuario -->
            <div class="hidden sm:flex items-center space-x-4">
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
                            <x-dropdown-link href="{{ route('profile.show') }}">Perfil</x-dropdown-link>
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

    <!-- Menú desplegable (pantallas pequeñas) -->
    <div class="sm:hidden" x-show="open">
        <!-- Opciones de usuario (pantallas pequeñas) -->
        @auth
            <!-- Sección desplegable del usuario -->
            <div x-data="{ userMenuOpen: false }" class="border-b border-gray-200 px-4 py-3">
                <button @click="userMenuOpen = !userMenuOpen"
                        class="w-full flex items-center justify-between text-gray-800 font-semibold text-base focus:outline-none">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zM2 18a6 6 0 1116 0H2z"/>
                        </svg>
                        Bienvenido, {{ Auth::user()->name }}
                    </div>
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'rotate-180': userMenuOpen }" class="transition-transform duration-200 ease-in-out"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Opciones desplegables -->
                <div x-show="userMenuOpen" x-cloak class="mt-2 space-y-1 pl-6">
                    <a href="{{ route('profile.show') }}" class="flex items-center text-sm text-gray-700 hover:text-green-600">
                        <svg class="w-4 h-4 mr-2 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11.3 1.046A1 1 0 0112 2v2.586l.707.707a1 1 0 010 1.414L11 8l-1.707-1.707a1 1 0 010-1.414L10 4.586V2a1 1 0 011.3-.954zM4 8h3v1H4a1 1 0 000 2h3v1H4a1 1 0 100 2h3v1H4a1 1 0 100 2h6a1 1 0 100-2H7v-1h3a1 1 0 100-2H7v-1h3a1 1 0 100-2H7V8h3a1 1 0 100-2H7a1 1 0 100 2z"/>
                        </svg>
                        Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                            <svg class="w-4 h-4 mr-2 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h6a1 1 0 010 2H5v10h5a1 1 0 010 2H4a1 1 0 01-1-1V4zm12.707 5.293a1 1 0 00-1.414 1.414L16.586 12H9a1 1 0 000 2h7.586l-2.293 2.293a1 1 0 001.414 1.414l4-4a1 1 0 000-1.414l-4-4z"/>
                            </svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        @endauth

        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Panel de Administrador</a>
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Gestionar Usuarios</a>
                    <a href="{{ route('cultivations.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Gestionar Publicaciones</a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Gestionar Categorías</a>
                @else
                    <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Inicio</a>
                    <a href="{{ route('cultivations.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Publicaciones</a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Categorías</a>
                @endif
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Registrarse</a>
            @endguest
        </div>
    </div>
</nav>
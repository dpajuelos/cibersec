@if (isset($header))
    <div class="bg-slate-900">
        <nav x-data="{ open: false }"
            class="bg-gradient-to-r from-blue-900 via-slate-800 to-blue-900 border-b border-blue-500 shadow-blue-500/30 shadow-lg h-20 w-full fixed top-0 z-50 backdrop-blur-md">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex h-20 justify-between items-center">
                    <!-- Logo Section -->
                    <div class="shrink-0 flex items-center">
                        <a href="/" class="flex items-center group">
                            <img src="{{ asset('images/logo.png') }}" alt="CIBERSEC Logo"
                                class="h-12 w-12 transform group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                            <h1
                                class="text-xl font-bold ml-3 bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 text-transparent bg-clip-text hover:from-blue-300 hover:to-cyan-300 transition-all duration-300">
                                CIBERSEC-UNASAM
                            </h1>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:flex items-center space-x-8">
                        <x-nav-link href="/usuario" :active="request()->routeIs('usuarios')"
                            class="text-white hover:text-cyan-400 hover:bg-blue-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                        <x-nav-link href="/ranking" :active="request()->routeIs('ranking')"
                            class="text-white hover:text-purple-400 hover:bg-blue-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                            {{ __('Ranking') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                            class="text-white hover:text-cyan-400 hover:bg-purple-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                            {{ __('Retos') }}
                        </x-nav-link>
                    </div>

                    <!-- User Section -->
                    <div class="hidden sm:flex sm:items-center space-x-4">
                        @if (@Auth::user())
                            <!-- User Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="flex items-center text-sm border-2 border-blue-400/50 rounded-full focus:outline-none focus:border-cyan-400 hover:border-cyan-400 transition-all duration-200 p-1 bg-blue-800/20 backdrop-blur-sm">
                                        <img class="h-8 w-8 rounded-full object-cover ring-2 ring-blue-400/50"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="" />
                                        <span class="text-gray-200 ml-2 mr-3 font-medium">
                                            {{ Auth::user()->usuario }}
                                        </span>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div
                                        class="block px-4 py-2 text-xs text-gray-400 bg-slate-800 border-b border-gray-600">
                                        {{ __('Administrar cuenta') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('profile.perfil1') }}"
                                        class="text-gray-200 hover:bg-blue-800/50 hover:text-cyan-400">
                                        <i class="mr-2 fa-solid fa-user text-cyan-400"></i>
                                        {{ __('Perfil') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('profile') }}"
                                        class="text-gray-200 hover:bg-blue-800/50 hover:text-cyan-400">
                                        <i class="mr-2 fas fa-cog text-blue-400"></i> {{ __('Configuración') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-gray-600"></div>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                            class="text-gray-200 hover:bg-red-800/50 hover:text-red-400">
                                            <i class="mr-2 fas fa-sign-out-alt text-red-400"></i>
                                            {{ __('Cerrar Sesión') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>

                            <!-- Notifications -->
                            <div class="relative">
                                <button @click="open = ! open"
                                    class="flex items-center text-gray-200 hover:text-cyan-400 transition-colors bg-blue-800/30 px-3 py-2 rounded-lg">
                                    <i class="fas fa-bell text-cyan-400"></i>
                                    <span
                                        class="ml-2 bg-gradient-to-r from-cyan-400 to-blue-400 text-transparent bg-clip-text font-bold">
                                        {{ $notifications->where('is_read', false)->count() + $generalNotifications->count() }}
                                    </span>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-80 bg-slate-800/95 border border-blue-500/30 rounded-lg shadow-2xl shadow-blue-500/20 z-50 p-4 backdrop-blur-md max-h-96 overflow-y-auto"
                                    x-transition>
                                    <!-- Notification content here -->
                                    <div class="py-1">
                                        @if ($generalNotifications->isNotEmpty())
                                            <div
                                                class="font-semibold text-lg mb-2 text-center text-white border-b border-blue-500/30 pb-2">
                                                Notificaciones Generales
                                            </div>
                                            @foreach ($generalNotifications as $notification)
                                                <div
                                                    class="block px-2 py-2 text-sm text-gray-300 hover:bg-blue-800/30 rounded">
                                                    {{ $notification->message }}
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-gray-400 text-sm text-center py-4">
                                                No hay notificaciones generales.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('register') }}"
                                    class="flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200 shadow-lg hover:shadow-purple-500/25 border border-purple-500/30">
                                    <i class="fas fa-user-plus mr-2"></i> Registrarse
                                </a>
                                <a href="{{ route('login') }}"
                                    class="flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-lg hover:from-cyan-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-cyan-500/25 border border-cyan-500/30">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-cyan-400 hover:bg-blue-800/30 focus:outline-none focus:text-cyan-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }"
                class="hidden sm:hidden bg-slate-800/98 backdrop-blur-md border-t border-blue-500/30">
                <!-- Mobile menu content -->
                <div class="px-4 py-4 space-y-2">
                    @if (Auth::user())
                        <!-- User info -->
                        <div class="flex items-center pb-4 border-b border-blue-500/30">
                            <img class="h-10 w-10 rounded-full object-cover ring-2 ring-cyan-400/50"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->usuario }}" />
                            <div class="ml-3">
                                <div class="font-medium text-base text-cyan-400">{{ Auth::user()->usuario }}</div>
                                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <!-- Navigation links -->
                        <x-responsive-nav-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')"
                            class="text-gray-200 hover:text-cyan-400 hover:bg-blue-800/30">
                            {{ __('Usuarios') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('ranking') }}" :active="request()->routeIs('ranking')"
                            class="text-gray-200 hover:text-cyan-400 hover:bg-blue-800/30">
                            {{ __('Ranking') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                            class="text-gray-200 hover:text-purple-400 hover:bg-purple-800/30">
                            {{ __('Retos') }}
                        </x-responsive-nav-link>
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="#" @click.prevent="$el.closest('form').submit();"
                                class="text-gray-200 hover:text-red-400 hover:bg-red-800/30 block w-full px-3 py-2 border-l-4 border-transparent text-start text-base font-medium focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Cerrar Sesión') }}
                            </a>
                        </form>
                    @else
                        <!-- Guest navigation -->
                        <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                            class="text-gray-200 hover:text-cyan-400 hover:bg-blue-800/30">
                            {{ __('Iniciar sesión') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')"
                            class="text-gray-200 hover:text-purple-400 hover:bg-purple-800/30">
                            {{ __('Registrarse') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('usuarios') }}" :active="request()->routeIs('usuarios')"
                            class="text-gray-200 hover:text-cyan-400 hover:bg-blue-800/30">
                            {{ __('Usuarios') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('ranking') }}" :active="request()->routeIs('ranking')"
                            class="text-gray-200 hover:text-cyan-400 hover:bg-blue-800/30">
                            {{ __('Ranking') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                            class="text-gray-200 hover:text-purple-400 hover:bg-purple-800/30">
                            {{ __('Retos') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            </div>
        </nav>
    </div>
@endif

<!-- Main content with proper spacing -->
<main class="pt-20">
    {{ $slot }}
</main>

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
                            <i class="fas fa-user mr-2"></i>
                            {{ __('Usuarios') }}
                        </x-nav-link>
                        <x-nav-link href="/ranking" :active="request()->routeIs('ranking')"
                            class="text-white hover:text-purple-400 hover:bg-blue-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                            <i class="fas fa-trophy mr-2"></i>
                            {{ __('Ranking') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                            class="text-white hover:text-cyan-400 hover:bg-purple-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                            <i class="fas fa-gamepad mr-2"></i>
                            {{ __('Retos') }}
                        </x-nav-link>

                        <!-- Administración  -->
                        @if (Auth::check() && Auth::user()->roles->contains('namerol', 'Administrador'))
                            <x-nav-link href="/admin" :active="request()->routeIs('admin*')"
                                class="text-white hover:text-yellow-400 hover:bg-orange-800/30 px-3 py-2 rounded-lg transition-all duration-200 font-semibold">
                                <i class="fas fa-shield-alt mr-2"></i>
                                {{ __('Administración') }}
                            </x-nav-link>
                        @endif
                    </div>

                    <!-- User Section -->
                    <div class="hidden sm:flex sm:items-center space-x-4">
                        @if (@Auth::user())
                            @php
                                $notificaciones = Auth::user()
                                    ->notifications()
                                    ->orderBy('created_at', 'desc')
                                    ->limit(10)
                                    ->get();
                                $noLeidas = $notificaciones->where('is_read', 0)->count();
                            @endphp
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
                            <div class="relative" x-data="{ notificationsOpen: false }">
                                <button @click="notificationsOpen = !notificationsOpen"
                                    class="relative p-2 text-gray-300 hover:text-cyan-400 hover:bg-blue-800/30 rounded-lg transition-all duration-200 focus:outline-none focus:text-cyan-400">
                                    <i class="fas fa-bell text-xl"></i>
                                    @if ($noLeidas > 0)
                                        <span
                                            class="absolute -top-1 -right-1 h-5 w-5 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse border-2 border-slate-800">
                                            {{ $noLeidas > 9 ? '9+' : $noLeidas }}
                                        </span>
                                    @endif
                                </button>

                                <!-- Notifications Dropdown -->
                                <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-96 bg-slate-800/95 backdrop-blur-md rounded-xl shadow-2xl border border-slate-600/50 z-50"
                                    style="display: none;">

                                    <!-- Header del dropdown -->
                                    <div class="px-4 py-3 border-b border-slate-600/50">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-white font-semibold flex items-center">
                                                <i class="fas fa-bell mr-2 text-cyan-400"></i>
                                                Notificaciones
                                            </h3>
                                            @if ($noLeidas > 0)
                                                <button onclick="marcarTodasLeidas()"
                                                    class="text-xs text-cyan-400 hover:text-cyan-300 transition-colors">
                                                    Marcar todas como leídas
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Lista de notificaciones -->
                                    <div class="max-h-96 overflow-y-auto">
                                        @forelse($notificaciones as $notificacion)
                                            <div class="px-4 py-3 border-b border-slate-600/30 hover:bg-slate-700/30 transition-colors cursor-pointer {{ $notificacion->is_read ? '' : 'bg-blue-900/20 border-l-4 border-l-cyan-400' }}"
                                                onclick="marcarLeida({{ $notificacion->id }})">
                                                <div class="flex items-start space-x-3">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="w-8 h-8 bg-gradient-to-br {{ $notificacion->is_read ? 'from-slate-500/20 to-gray-500/20' : 'from-cyan-500/20 to-blue-500/20' }} rounded-lg flex items-center justify-center">
                                                            <i
                                                                class="fas fa-info-circle {{ $notificacion->is_read ? 'text-gray-400' : 'text-cyan-400' }} text-sm"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p
                                                            class="{{ $notificacion->is_read ? 'text-gray-300' : 'text-white font-medium' }} text-sm leading-relaxed">
                                                            {{ Str::limit($notificacion->message, 80) }}
                                                        </p>
                                                        <p
                                                            class="text-xs {{ $notificacion->is_read ? 'text-gray-500' : 'text-cyan-400' }} mt-1">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            {{ $notificacion->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    @if (!$notificacion->is_read)
                                                        <div class="flex-shrink-0">
                                                            <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="px-4 py-8 text-center">
                                                <div
                                                    class="w-12 h-12 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                                    <i class="fas fa-bell-slash text-gray-400 text-xl"></i>
                                                </div>
                                                <p class="text-gray-400 text-sm">No tienes notificaciones</p>
                                            </div>
                                        @endforelse
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

                        <!-- Administración Mobile -->
                        @if (Auth::user()->roles->contains('namerol', 'Administrador'))
                            <x-responsive-nav-link href="/admin" :active="request()->routeIs('admin')"
                                class="text-gray-200 hover:text-yellow-400 hover:bg-orange-800/30">
                                {{ __('Administración') }}
                            </x-responsive-nav-link>
                        @endif

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
    <script>
        // Función para marcar una notificación como leída
        function marcarLeida(id) {
            fetch(`/notificaciones/${id}/marcar-leida`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recargar la página para actualizar el contador
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Función para marcar todas las notificaciones como leídas
        function marcarTodasLeidas() {
            fetch('/notificaciones/marcar-todas-leidas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Recargar la página para actualizar el contador
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Función para ver todas las notificaciones (opcional)
        function verTodasNotificaciones() {
            window.location.href = '/mis-notificaciones';
        }
    </script>
@endif

<!-- Main content with proper spacing -->
<main class="pt-20">
    {{ $slot }}
</main>

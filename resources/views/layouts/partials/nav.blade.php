<nav
    class="bg-gradient-to-r from-slate-900 via-blue-900/90 to-slate-900 backdrop-blur-sm border-b border-blue-500/30 shadow-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo y título -->
            <div class="flex items-center flex-shrink-0">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="CIBERSEC Logo"
                        class="h-8 w-8 sm:h-10 sm:w-10 mr-2 sm:mr-3">
                    <div class="flex flex-col">
                        <h1
                            class="text-sm sm:text-lg font-bold bg-gradient-to-r from-cyan-400 to-purple-400 text-transparent bg-clip-text">
                            Admin Panel
                        </h1>
                        <span class="text-xs text-gray-400 hidden sm:block">CIBERSEC-UNASAM</span>
                    </div>
                </div>
            </div>

            <!-- Menú principal de navegación - Desktop -->
            <div class="hidden lg:flex lg:items-center lg:space-x-6 xl:space-x-8 lg:ml-3">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                          {{ request()->routeIs('admin.dashboard*') ? 'bg-cyan-600/20 text-cyan-400 border border-cyan-500/30' : 'text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10' }}">
                    <i class="fas fa-chart-line mr-2 group-hover:scale-110 transition-transform"></i>
                    <span class="hidden xl:block">Dashboard</span>
                </a>

                <!-- Gestión de Usuarios -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 transition-all duration-200">
                        <i class="fas fa-users mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="hidden xl:block">Usuarios</span>
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-48 bg-slate-800 border border-purple-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('admin.users') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-list mr-2"></i>Ver Usuarios
                        </a>
                        {{-- <a href="{{ route('admin.users') }}?filter=permissions"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 transition-colors">
                            <i class="fas fa-user-shield mr-2"></i>Permisos
                        </a> --}}
                        <a href="{{ route('admin.analytics.users') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>Analytics
                        </a>
                    </div>
                </div>

                <!-- Gestión de Retos -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-all duration-200">
                        <i class="fas fa-flag mr-2 group-hover:scale-110 transition-transform"></i>
                        <span class="hidden xl:block">Retos</span>
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-48 bg-slate-800 border border-blue-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('admin.challenges.create') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Crear Reto
                        </a>
                        <a href="{{ route('admin.categories') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-colors">
                            <i class="fas fa-layer-group mr-2"></i>Categorías
                        </a>
                        <a href="{{ route('admin.analytics.challenges') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>Estadísticas
                        </a>
                    </div>
                </div>
                <!-- Competencias -->
                <div class="relative">
                    <a href="{{ route('admin.competitions') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-green-400 hover:bg-green-600/10 transition-all duration-200">
                        <i class="fas fa-trophy mr-2"></i>
                        <span class="relative hidden xl:block">
                            Competencias
                        </span>
                    </a>
                </div>
                <!-- Notificaciones -->
                <div class="relative">
                    <a href="{{ route('admin.notifications') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-green-400 hover:bg-green-600/10 transition-all duration-200">
                        <i class="fas fa-bell mr-2"></i>
                        <span class="relative hidden xl:block">
                            Notificaciones
                        </span>
                    </a>
                </div>

                <!-- Configuración del Sistema -->
                {{-- <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-all duration-200">
                        <i class="fas fa-cog mr-2 group-hover:rotate-90 transition-transform"></i>
                        <span class="hidden xl:block">Sistema</span>
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-slate-800 border border-orange-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-server mr-2"></i>Estado del Sistema
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-colors">
                            <i class="fas fa-database mr-2"></i>Base de Datos
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-colors">
                            <i class="fas fa-file-alt mr-2"></i>Logs
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-tools mr-2"></i>Configuración
                        </a>
                    </div>
                </div>
            </div> --}}

                <!-- Perfil de usuario y acciones -->
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <!-- Estado del sistema - Solo visible en pantallas grandes -->
                    <div class="hidden xl:flex items-center">
                        <div
                            class="flex items-center px-3 py-1 bg-green-600/20 border border-green-500/30 rounded-full">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-2"></div>
                            <span class="text-green-400 text-xs font-medium">Sistema Online</span>
                        </div>
                    </div>

                    <!-- Indicador de estado para pantallas medianas -->
                    <div class="hidden lg:flex xl:hidden items-center">
                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                    </div>

                    <!-- Perfil del administrador -->
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 rounded-lg bg-slate-800/50 border border-slate-600/50 hover:border-cyan-500/50 transition-all duration-200">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar"
                                class="w-6 h-6 sm:w-8 sm:h-8 rounded-full">
                            <div class="text-left hidden md:block">
                                <div class="text-sm font-medium text-white truncate max-w-20 sm:max-w-24 lg:max-w-32">
                                    {{ Auth::user()->perfil?->persona?->nombres ?? 'Usuario' }}
                                </div>
                                <div class="text-xs text-gray-400 hidden lg:block">
                                    {{ Auth::user()->roles()->first()->namerol }}
                                </div>
                            </div>
                            <i
                                class="fas fa-chevron-down text-gray-400 text-xs group-hover:rotate-180 transition-transform hidden sm:block"></i>
                        </button>

                        <!-- Dropdown del perfil - Responsive -->
                        <div
                            class="absolute right-0 mt-2 w-48 sm:w-52 bg-slate-800 border border-slate-600/50 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-1">
                                <!-- Información del usuario en móviles -->
                                <div class="px-4 py-3 border-b border-slate-600/50 md:hidden">
                                    <div class="text-sm font-medium text-white truncate">
                                        {{ Auth::user()->perfil ?? 'Administrador' }}
                                    </div>
                                    <div class="text-xs text-gray-400">{{ Auth::user()->roles()->first()->namerol }}
                                    </div>
                                </div>

                                <a href="{{ route('welcome') }}"
                                    class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                                    <i class="fas fa-home mr-2 w-4"></i>
                                    <span class="truncate">Ir al Sitio Principal</span>
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                                    <i class="fas fa-user mr-2 w-4"></i>
                                    <span class="truncate">Mi Perfil</span>
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                                    <i class="fas fa-key mr-2 w-4"></i>
                                    <span class="truncate">Cambiar Contraseña</span>
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                                    <i class="fas fa-cog mr-2 w-4"></i>
                                    <span class="truncate">Configuración</span>
                                </a>

                                <hr class="border-slate-600/50 my-1">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-600/10 rounded-b-xl transition-colors">
                                        <i class="fas fa-sign-out-alt mr-2 w-4"></i>
                                        <span class="truncate">Cerrar Sesión</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de menú móvil -->
                    <button id="mobile-menu-button"
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div class="lg:hidden hidden" id="mobile-menu">
            <div class="bg-slate-800/95 backdrop-blur-md border-t border-blue-500/30 max-h-screen overflow-y-auto">

                <!-- Header del menú móvil -->
                <div class="px-4 py-4 border-b border-slate-600/50 bg-slate-900/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=0ea5e9&color=fff&size=40"
                                alt="Avatar" class="w-10 h-10 rounded-full border-2 border-cyan-500/30">
                            <div>
                                <div class="text-sm font-medium text-white">
                                    {{ Auth::user()->perfil?->persona?->nombres ?? 'Administrador' }}
                                </div>
                                <div class="text-xs text-gray-400">Super Admin</div>
                            </div>
                        </div>
                        <!-- Estado del sistema en header -->
                        <div
                            class="flex items-center px-2 py-1 bg-green-600/20 border border-green-500/30 rounded-full">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-1"></div>
                            <span class="text-green-400 text-xs font-medium">Online</span>
                        </div>
                    </div>
                </div>

                <!-- Navegación principal en tarjetas -->
                <div class="px-4 py-6 space-y-4">
                    <!-- Tarjeta de acceso rápido -->
                    <div class="bg-slate-900/50 rounded-xl p-4 border border-slate-600/30">
                        <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center">
                            <i class="fas fa-tachometer-alt mr-2 text-cyan-400"></i>
                            Acceso Rápido
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex flex-col items-center p-3 rounded-lg {{ request()->routeIs('admin.dashboard*') ? 'bg-cyan-600/20 border border-cyan-500/30' : 'bg-slate-800/50 hover:bg-cyan-600/10' }} transition-all duration-200">
                                <i class="fas fa-chart-line text-cyan-400 text-lg mb-1"></i>
                                <span class="text-xs text-gray-300">Dashboard</span>
                            </a>

                            <a href="{{ route('admin.notifications') }}"
                                class="flex flex-col items-center p-3 rounded-lg bg-slate-800/50 hover:bg-green-600/10 transition-all duration-200 relative">
                                <i class="fas fa-bell text-green-400 text-lg mb-1"></i>
                                <span class="text-xs text-gray-300">Notificaciones</span>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tarjeta de Gestión -->
                    <div class="bg-slate-900/50 rounded-xl p-4 border border-slate-600/30">
                        <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center">
                            <i class="fas fa-cogs mr-2 text-purple-400"></i>
                            Gestión
                        </h3>

                        <!-- Usuarios -->
                        <div class="mb-4">
                            <button id="users-toggle"
                                class="w-full flex items-center justify-between p-3 bg-slate-800/50 rounded-lg hover:bg-purple-600/10 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-purple-400 mr-3"></i>
                                    <span class="text-sm text-gray-300">Usuarios</span>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform"
                                    id="users-icon"></i>
                            </button>
                            <div class="hidden mt-2 ml-6 space-y-2" id="users-menu">
                                <a href="{{ route('admin.users') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-purple-400 transition-colors">
                                    <i class="fas fa-list mr-2 w-4"></i>Ver Usuarios
                                </a>
                                <a href="{{ route('admin.users') }}?filter=permissions"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-purple-400 transition-colors">
                                    <i class="fas fa-user-shield mr-2 w-4"></i>Permisos
                                </a>
                                <a href="{{ route('admin.analytics.users') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-purple-400 transition-colors">
                                    <i class="fas fa-chart-bar mr-2 w-4"></i>Analytics
                                </a>
                            </div>
                        </div>

                        <!-- Retos -->
                        <div>
                            <button id="challenges-toggle"
                                class="w-full flex items-center justify-between p-3 bg-slate-800/50 rounded-lg hover:bg-blue-600/10 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-flag text-blue-400 mr-3"></i>
                                    <span class="text-sm text-gray-300">Retos</span>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform"
                                    id="challenges-icon"></i>
                            </button>
                            <div class="hidden mt-2 ml-6 space-y-2" id="challenges-menu">
                                <a href="{{ route('admin.challenges') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                    <i class="fas fa-list mr-2 w-4"></i>Ver Retos
                                </a>
                                <a href="{{ route('admin.challenges.create') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                    <i class="fas fa-plus mr-2 w-4"></i>Crear Reto
                                </a>
                                <a href="{{ route('admin.categories') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                    <i class="fas fa-layer-group mr-2 w-4"></i>Categorías
                                </a>
                                <a href="{{ route('admin.analytics.challenges') }}"
                                    class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                    <i class="fas fa-chart-bar mr-2 w-4"></i>Estadísticas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Sistema -->
                    <div class="bg-slate-900/50 rounded-xl p-4 border border-slate-600/30">
                        <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center">
                            <i class="fas fa-server mr-2 text-orange-400"></i>
                            Sistema
                        </h3>
                        <button id="system-toggle"
                            class="w-full flex items-center justify-between p-3 bg-slate-800/50 rounded-lg hover:bg-orange-600/10 transition-colors">
                            <div class="flex items-center">
                                <i class="fas fa-cog text-orange-400 mr-3"></i>
                                <span class="text-sm text-gray-300">Configuración</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform"
                                id="system-icon"></i>
                        </button>
                        <div class="hidden mt-2 ml-6 space-y-2" id="system-menu">
                            <a href="#"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-orange-400 transition-colors">
                                <i class="fas fa-server mr-2 w-4"></i>Estado del Sistema
                            </a>
                            <a href="#"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-orange-400 transition-colors">
                                <i class="fas fa-database mr-2 w-4"></i>Base de Datos
                            </a>
                            <a href="#"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-orange-400 transition-colors">
                                <i class="fas fa-file-alt mr-2 w-4"></i>Logs
                            </a>
                            <a href="#"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-orange-400 transition-colors">
                                <i class="fas fa-tools mr-2 w-4"></i>Configuración
                            </a>
                        </div>
                    </div>

                    <!-- Tarjeta de Cuenta -->
                    <div class="bg-slate-900/50 rounded-xl p-4 border border-slate-600/30">
                        <h3 class="text-sm font-semibold text-gray-300 mb-3 flex items-center">
                            <i class="fas fa-user mr-2 text-cyan-400"></i>
                            Mi Cuenta
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('welcome') }}"
                                class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-cyan-600/10 transition-colors">
                                <i class="fas fa-home text-cyan-400 mr-3"></i>
                                <span class="text-sm text-gray-300">Ir al Sitio Principal</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-cyan-600/10 transition-colors">
                                <i class="fas fa-user text-cyan-400 mr-3"></i>
                                <span class="text-sm text-gray-300">Mi Perfil</span>
                            </a>
                            <a href="#"
                                class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-cyan-600/10 transition-colors">
                                <i class="fas fa-key text-cyan-400 mr-3"></i>
                                <span class="text-sm text-gray-300">Cambiar Contraseña</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer del menú móvil -->
                <div class="px-4 py-4 border-t border-slate-600/50 bg-slate-900/50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center p-3 bg-red-600/20 border border-red-500/30 rounded-lg text-red-400 hover:bg-red-600/30 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="font-medium">Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');

        // Cambiar icono del botón
        const icon = this.querySelector('i');
        if (menu.classList.contains('hidden')) {
            icon.className = 'fas fa-bars text-lg';
        } else {
            icon.className = 'fas fa-times text-lg';
        }
    });

    // Cerrar menú móvil al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('mobile-menu');
        const button = document.getElementById('mobile-menu-button');

        if (!menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.add('hidden');
            button.querySelector('i').className = 'fas fa-bars text-lg';
        }
    });

    // Toggle functions para submenús móviles
    function setupToggle(toggleId, menuId, iconId) {
        document.getElementById(toggleId).addEventListener('click', function() {
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(iconId);

            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    }

    // Configurar toggles
    setupToggle('users-toggle', 'users-menu', 'users-icon');
    setupToggle('challenges-toggle', 'challenges-menu', 'challenges-icon');
    setupToggle('system-toggle', 'system-menu', 'system-icon');
</script>

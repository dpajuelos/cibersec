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
            </div>

            <!-- Perfil de usuario y acciones -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Estado del sistema -->

                <!-- Indicador de estado para pantallas medianas -->
                <div class="hidden lg:flex xl:hidden items-center">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                </div>

                <!-- Perfil del administrador -->
                <div class="relative group">
                    <button
                        class="flex items-center space-x-2 sm:space-x-3 px-2 sm:px-3 py-2 rounded-lg bg-slate-800/50 border border-slate-600/50 hover:border-cyan-500/50 transition-all duration-200">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 flex-shrink-0">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar"
                                class="w-full h-full object-cover rounded-full border border-slate-500/30">
                        </div>
                        <div class="text-left hidden md:block min-w-0">
                            <div class="text-sm font-medium text-white truncate max-w-20 sm:max-w-24 lg:max-w-32">
                                {{ Auth::user()->perfil?->persona?->nombres ?? 'Usuario' }}
                            </div>
                            <div class="text-xs text-gray-400 hidden lg:block truncate">
                                {{ Auth::user()->roles()->first()?->namerol ?? 'Usuario' }}
                            </div>
                        </div>
                        <i
                            class="fas fa-chevron-down text-gray-400 text-xs group-hover:rotate-180 transition-transform hidden sm:block flex-shrink-0"></i>
                    </button>

                    <!-- Dropdown del perfil - Responsive -->
                    <div
                        class="absolute right-0 mt-2 w-48 sm:w-52 bg-slate-800 border border-slate-600/50 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-1">
                            <!-- Información del usuario en móviles -->
                            <div class="px-4 py-3 border-b border-slate-600/50 md:hidden">
                                <div class="text-sm font-medium text-white truncate">
                                    {{ Auth::user()->perfil?->persona?->nombres ?? 'Administrador' }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ Auth::user()->roles()->first()?->namerol ?? 'Usuario' }}
                                </div>
                            </div>

                            <a href="{{ route('welcome') }}"
                                class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                                <i class="fas fa-home mr-2 w-4"></i>
                                <span class="truncate">Ir al Sitio Principal</span>
                            </a>
                            <!-- <a href="#"
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
                            </a>-->

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
                    <i id="mobile-menu-icon" class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Menú móvil -->
        <div class="lg:hidden" id="mobile-menu" style="display: none;">
            <div class="bg-slate-800/95 backdrop-blur-md border-t border-blue-500/30 max-h-screen overflow-y-auto">
                <!-- Header del menú móvil -->
                <div class="px-4 py-4 border-b border-slate-600/50 bg-slate-900/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 flex-shrink-0">
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="Avatar"
                                    class="w-full h-full object-cover rounded-full border-2 border-cyan-500/30">
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-sm font-medium text-white truncate">
                                    {{ Auth::user()->perfil?->persona?->nombres ?? 'Administrador' }}
                                </div>
                                <div class="text-xs text-gray-400 truncate">
                                    {{ Auth::user()->roles()->first()?->namerol ?? 'Usuario' }}
                                </div>
                            </div>
                        </div>
                        <!-- Estado del sistema en header -->
                        <div
                            class="flex items-center px-2 py-1 bg-green-600/20 border border-green-500/30 rounded-full flex-shrink-0">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-1"></div>
                            <span class="text-green-400 text-xs font-medium">Online</span>
                        </div>
                    </div>
                </div>

                <!-- Navegación principal -->
                <div class="px-4 py-6 space-y-4">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-lg {{ request()->routeIs('admin.dashboard*') ? 'bg-cyan-600/20 text-cyan-400 border border-cyan-500/30' : 'bg-slate-800/50 hover:bg-cyan-600/10 text-gray-300' }} transition-all duration-200">
                        <i class="fas fa-chart-line text-cyan-400 mr-3 flex-shrink-0"></i>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <!-- Usuarios -->
                    <div class="space-y-2">
                        <button id="users-toggle"
                            class="w-full flex items-center justify-between p-3 bg-slate-800/50 rounded-lg hover:bg-purple-600/10 transition-colors text-gray-300">
                            <div class="flex items-center">
                                <i class="fas fa-users text-purple-400 mr-3 flex-shrink-0"></i>
                                <span class="text-sm font-medium">Usuarios</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform flex-shrink-0"
                                id="users-icon"></i>
                        </button>
                        <div class="hidden ml-6 space-y-2" id="users-menu">
                            <a href="{{ route('admin.users') }}"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-purple-400 transition-colors">
                                <i class="fas fa-list mr-2 w-4 flex-shrink-0"></i>Ver Usuarios
                            </a>
                            <a href="{{ route('admin.analytics.users') }}"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-purple-400 transition-colors">
                                <i class="fas fa-chart-bar mr-2 w-4 flex-shrink-0"></i>Analytics
                            </a>
                        </div>
                    </div>

                    <!-- Retos -->
                    <div class="space-y-2">
                        <button id="challenges-toggle"
                            class="w-full flex items-center justify-between p-3 bg-slate-800/50 rounded-lg hover:bg-blue-600/10 transition-colors text-gray-300">
                            <div class="flex items-center">
                                <i class="fas fa-flag text-blue-400 mr-3 flex-shrink-0"></i>
                                <span class="text-sm font-medium">Retos</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform flex-shrink-0"
                                id="challenges-icon"></i>
                        </button>
                        <div class="hidden ml-6 space-y-2" id="challenges-menu">
                            <a href="{{ route('admin.challenges.create') }}"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fas fa-plus mr-2 w-4 flex-shrink-0"></i>Crear Reto
                            </a>
                            <a href="{{ route('admin.categories') }}"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fas fa-layer-group mr-2 w-4 flex-shrink-0"></i>Categorías
                            </a>
                            <a href="{{ route('admin.analytics.challenges') }}"
                                class="flex items-center p-2 text-sm text-gray-400 hover:text-blue-400 transition-colors">
                                <i class="fas fa-chart-bar mr-2 w-4 flex-shrink-0"></i>Estadísticas
                            </a>
                        </div>
                    </div>

                    <!-- Competencias -->
                    <a href="{{ route('admin.competitions') }}"
                        class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-green-600/10 transition-colors text-gray-300">
                        <i class="fas fa-trophy text-green-400 mr-3 flex-shrink-0"></i>
                        <span class="text-sm font-medium">Competencias</span>
                    </a>

                    <!-- Notificaciones -->
                    <a href="{{ route('admin.notifications') }}"
                        class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-green-600/10 transition-colors text-gray-300 relative">
                        <i class="fas fa-bell text-green-400 mr-3 flex-shrink-0"></i>
                        <span class="text-sm font-medium">Notificaciones</span>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center flex-shrink-0">3</span>
                    </a>

                    <!-- Ir al sitio principal -->
                    <a href="{{ route('welcome') }}"
                        class="flex items-center p-3 bg-slate-800/50 rounded-lg hover:bg-cyan-600/10 transition-colors text-gray-300">
                        <i class="fas fa-home text-cyan-400 mr-3 flex-shrink-0"></i>
                        <span class="text-sm font-medium">Ir al Sitio Principal</span>
                    </a>
                </div>

                <!-- Footer del menú móvil -->
                <div class="px-4 py-4 border-t border-slate-600/50 bg-slate-900/50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center p-3 bg-red-600/20 border border-red-500/30 rounded-lg text-red-400 hover:bg-red-600/30 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2 flex-shrink-0"></i>
                            <span class="font-medium">Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle mobile menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');

        if (mobileMenuButton && mobileMenu && mobileMenuIcon) {
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();

                if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                    mobileMenu.style.display = 'block';
                    mobileMenuIcon.className = 'fas fa-times text-lg';
                } else {
                    mobileMenu.style.display = 'none';
                    mobileMenuIcon.className = 'fas fa-bars text-lg';
                }
            });
        }

        // Cerrar menú móvil al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            if (mobileMenu && mobileMenuButton) {
                if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    mobileMenu.style.display = 'none';
                    if (mobileMenuIcon) {
                        mobileMenuIcon.className = 'fas fa-bars text-lg';
                    }
                }
            }
        });

        // Toggle functions para submenús móviles
        function setupToggle(toggleId, menuId, iconId) {
            const toggle = document.getElementById(toggleId);
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(iconId);

            if (toggle && menu && icon) {
                toggle.addEventListener('click', function() {
                    if (menu.style.display === 'none' || menu.style.display === '') {
                        menu.style.display = 'block';
                        menu.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        menu.style.display = 'none';
                        menu.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }
                });
            }
        }

        // Configurar toggles
        setupToggle('users-toggle', 'users-menu', 'users-icon');
        setupToggle('challenges-toggle', 'challenges-menu', 'challenges-icon');

        // Cerrar menú móvil al cambiar el tamaño de ventana a desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && mobileMenu) {
                mobileMenu.style.display = 'none';
                if (mobileMenuIcon) {
                    mobileMenuIcon.className = 'fas fa-bars text-lg';
                }
            }
        });
    });
</script>

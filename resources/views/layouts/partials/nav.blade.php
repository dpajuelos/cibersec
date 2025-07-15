<nav
    class="bg-gradient-to-r from-slate-900 via-blue-900/90 to-slate-900 backdrop-blur-md border-b border-blue-500/30 shadow-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo y título -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="CIBERSEC Logo" class="h-10 w-10 mr-3">
                    <div class="flex flex-col">
                        <h1
                            class="text-lg font-bold bg-gradient-to-r from-cyan-400 to-purple-400 text-transparent bg-clip-text">
                            Admin Panel
                        </h1>
                        <span class="text-xs text-gray-400">CIBERSEC-UNASAM</span>
                    </div>
                </div>
            </div>

            <!-- Menú principal de navegación -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                          {{ request()->routeIs('admin.dashboard*') ? 'bg-cyan-600/20 text-cyan-400 border border-cyan-500/30' : 'text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10' }}">
                    <i class="fas fa-chart-line mr-2 group-hover:scale-110 transition-transform"></i>
                    Dashboard
                </a>

                <!-- Gestión de Usuarios -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 transition-all duration-200">
                        <i class="fas fa-users mr-2 group-hover:scale-110 transition-transform"></i>
                        Usuarios
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-48 bg-slate-800 border border-purple-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('admin.users') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-list mr-2"></i>
                            Ver Usuarios
                        </a>
                        <a href="{{ route('admin.users') }}?filter=permissions"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 transition-colors">
                            <i class="fas fa-user-shield mr-2"></i>
                            Permisos
                        </a>
                        <a href="{{ route('admin.analytics.users') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-purple-400 hover:bg-purple-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Analytics
                        </a>
                    </div>
                </div>

                <!-- Gestión de Retos -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-all duration-200">
                        <i class="fas fa-flag mr-2 group-hover:scale-110 transition-transform"></i>
                        Retos
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute left-0 mt-2 w-48 bg-slate-800 border border-blue-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('admin.challenges') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-list mr-2"></i>
                            Ver Retos
                        </a>
                        <a href="{{ route('admin.challenges.create') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Crear Reto
                        </a>
                        <a href="{{ route('admin.categories') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 transition-colors">
                            <i class="fas fa-layer-group mr-2"></i>
                            Categorías
                        </a>
                        <a href="{{ route('admin.analytics.challenges') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-blue-400 hover:bg-blue-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Estadísticas
                        </a>
                    </div>
                </div>

                <!-- Notificaciones -->
                <div class="relative">
                    <a href="{{ route('admin.notifications') }}"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-green-400 hover:bg-green-600/10 transition-all duration-200">
                        <i class="fas fa-bell mr-2"></i>
                        <span class="relative">
                            Notificaciones
                            <!-- Badge de notificaciones pendientes -->
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                3
                            </span>
                        </span>
                    </a>
                </div>

                <!-- Configuración del Sistema -->
                <div class="relative group">
                    <button
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-all duration-200">
                        <i class="fas fa-cog mr-2 group-hover:rotate-90 transition-transform"></i>
                        Sistema
                        <i class="fas fa-chevron-down ml-2 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-slate-800 border border-orange-500/30 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-server mr-2"></i>
                            Estado del Sistema
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-colors">
                            <i class="fas fa-database mr-2"></i>
                            Base de Datos
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 transition-colors">
                            <i class="fas fa-file-alt mr-2"></i>
                            Logs
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-orange-400 hover:bg-orange-600/10 rounded-b-xl transition-colors">
                            <i class="fas fa-tools mr-2"></i>
                            Configuración
                        </a>
                    </div>
                </div>
            </div>

            <!-- Perfil de usuario y acciones -->
            <div class="flex items-center space-x-4">
                <!-- Estado del sistema -->
                <div class="hidden md:flex items-center">
                    <div class="flex items-center px-3 py-1 bg-green-600/20 border border-green-500/30 rounded-full">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-2"></div>
                        <span class="text-green-400 text-xs font-medium">Sistema Online</span>
                    </div>
                </div>

                <!-- Perfil del administrador -->
                <div class="relative group">
                    <button
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-slate-800/50 border border-slate-600/50 hover:border-cyan-500/50 transition-all duration-200">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=0ea5e9&color=fff&size=32"
                            alt="Avatar" class="w-8 h-8 rounded-full">
                        <div class="text-left hidden sm:block">
                            <div class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Administrador' }}
                            </div>
                            <div class="text-xs text-gray-400">Super Admin</div>
                        </div>
                        <i
                            class="fas fa-chevron-down text-gray-400 text-xs group-hover:rotate-180 transition-transform"></i>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-48 bg-slate-800 border border-slate-600/50 rounded-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('welcome') }}"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 rounded-t-xl transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Ir al Sitio Principal
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                            <i class="fas fa-user mr-2"></i>
                            Mi Perfil
                        </a>
                        <a href="#"
                            class="block px-4 py-3 text-sm text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10 transition-colors">
                            <i class="fas fa-key mr-2"></i>
                            Cambiar Contraseña
                        </a>
                        <hr class="border-slate-600/50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-600/10 rounded-b-xl transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div class="md:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-slate-800/90 backdrop-blur-md border-t border-blue-500/30">
            <a href="{{ route('admin.dashboard') }}"
                class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-cyan-400 hover:bg-cyan-600/10">
                <i class="fas fa-chart-line mr-2"></i>Dashboard
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-purple-400 hover:bg-purple-600/10">
                <i class="fas fa-users mr-2"></i>Usuarios
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-blue-400 hover:bg-blue-600/10">
                <i class="fas fa-flag mr-2"></i>Retos
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-green-400 hover:bg-green-600/10">
                <i class="fas fa-bell mr-2"></i>Notificaciones
            </a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-orange-400 hover:bg-orange-600/10">
                <i class="fas fa-cog mr-2"></i>Sistema
            </a>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    const mobileMenuButton = document.createElement('button');
    mobileMenuButton.className =
        'md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white';
    mobileMenuButton.innerHTML = '<i class="fas fa-bars"></i>';
    mobileMenuButton.onclick = () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    };
</script>

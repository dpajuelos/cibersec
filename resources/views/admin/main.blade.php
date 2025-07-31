<x-admin-layout>
    <div class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header del Dashboard -->
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600/20 to-purple-600/20 border border-cyan-400/30 rounded-full text-cyan-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-crown mr-3 animate-pulse"></i>
                    <span>Panel de Administración</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-black mb-6 text-white">
                    Bienvenido al
                    <span
                        class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 text-transparent bg-clip-text">
                        Control Center
                    </span>
                </h1>

                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Gestiona usuarios, retos, categorías y supervisa el estado general de la plataforma CiberSec
                    UNASAM
                </p>
            </div>

            <!-- Estadísticas Principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Usuarios -->
                <div
                    class="group bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-cyan-500/30 hover:border-cyan-400/60 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/20">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-cyan-500/20 rounded-xl group-hover:bg-cyan-500/30 transition-colors">
                            <i class="fas fa-users text-cyan-400 text-2xl"></i>
                        </div>
                        <span class="text-xs font-medium text-cyan-400 bg-cyan-400/20 px-2 py-1 rounded-full">
                            +12% vs mes anterior
                        </span>
                    </div>
                    <div class="text-3xl font-black text-cyan-400 mb-2">{{ \App\Models\User::count() }}</div>
                    <div class="text-gray-300 text-sm font-medium">Usuarios Registrados</div>
                    <div class="w-full bg-cyan-900/30 rounded-full h-2 mt-3">
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full w-4/5"></div>
                    </div>
                </div>

                <!-- Retos Activos -->
                <div
                    class="group bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30 hover:border-purple-400/60 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-500/20 rounded-xl group-hover:bg-purple-500/30 transition-colors">
                            <i class="fas fa-flag text-purple-400 text-2xl"></i>
                        </div>
                        <span class="text-xs font-medium text-purple-400 bg-purple-400/20 px-2 py-1 rounded-full">
                            Activos
                        </span>
                    </div>
                    <div class="text-3xl font-black text-purple-400 mb-2">45</div>
                    <div class="text-gray-300 text-sm font-medium">Retos Disponibles</div>
                    <div class="flex justify-center mt-3 space-x-1">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"
                                style="animation-delay: {{ $i * 100 }}ms"></div>
                        @endfor
                    </div>
                </div>

                <!-- Submissions Hoy -->
                <div
                    class="group bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-green-500/30 hover:border-green-400/60 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-500/20 rounded-xl group-hover:bg-green-500/30 transition-colors">
                            <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                        </div>
                        <span class="text-xs font-medium text-green-400 bg-green-400/20 px-2 py-1 rounded-full">
                            Hoy
                        </span>
                    </div>
                    <div class="text-3xl font-black text-green-400 mb-2">127</div>
                    <div class="text-gray-300 text-sm font-medium">Envíos Recibidos</div>
                    <div class="text-xs text-green-400 mt-2 font-medium">
                        <i class="fas fa-trending-up mr-1"></i>
                        +15% vs ayer
                    </div>
                </div>

                <!-- Sistema Status -->
                <div
                    class="group bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-blue-500/30 hover:border-blue-400/60 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/20">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-500/20 rounded-xl group-hover:bg-blue-500/30 transition-colors">
                            <i class="fas fa-server text-blue-400 text-2xl"></i>
                        </div>
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse mr-2"></div>
                            <span class="text-xs font-medium text-green-400">Online</span>
                        </div>
                    </div>
                    <div class="text-3xl font-black text-blue-400 mb-2">99.9%</div>
                    <div class="text-gray-300 text-sm font-medium">Uptime del Sistema</div>
                    <div class="text-xs text-blue-400 mt-2 font-medium">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Todos los servicios operativos
                    </div>
                </div>
            </div>

            <!-- Acceso Rápido a Funciones -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Gestión de Usuarios -->
                <div
                    class="group bg-gradient-to-br from-purple-900/40 to-pink-900/40 backdrop-blur-md rounded-2xl p-8 border border-purple-500/30 hover:border-purple-400/60 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <div class="flex items-center mb-6">
                        <div
                            class="p-4 bg-purple-500/20 rounded-xl mr-4 group-hover:bg-purple-500/30 transition-colors">
                            <i
                                class="fas fa-users-cog text-purple-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-purple-400 group-hover:text-purple-300 transition-colors">
                            Gestión de Usuarios</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Administra cuentas de usuario, asigna roles y permisos, y supervisa la actividad de los
                        participantes en tiempo real.
                    </p>
                    <div class="flex space-x-3">
                        <span class="bg-purple-400/20 text-purple-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-user-shield mr-1"></i>
                            Permisos
                        </span>
                        <span class="bg-purple-400/20 text-purple-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Analytics
                        </span>
                    </div>
                </div>

                <!-- Gestión de Retos -->
                <div
                    class="group bg-gradient-to-br from-blue-900/40 to-cyan-900/40 backdrop-blur-md rounded-2xl p-8 border border-blue-500/30 hover:border-blue-400/60 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <div class="flex items-center mb-6">
                        <div class="p-4 bg-blue-500/20 rounded-xl mr-4 group-hover:bg-blue-500/30 transition-colors">
                            <i
                                class="fas fa-flag text-blue-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-400 group-hover:text-blue-300 transition-colors">
                            Gestión de Retos</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Crea, edita y organiza retos CTF. Gestiona categorías, dificultades y supervisa las
                        estadísticas de resolución.
                    </p>
                    <div class="flex space-x-3">
                        <span class="bg-blue-400/20 text-blue-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-plus mr-1"></i>
                            Crear
                        </span>
                        <span class="bg-blue-400/20 text-blue-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-layer-group mr-1"></i>
                            Categorías
                        </span>
                    </div>
                </div>

                <!-- Sistema de Notificaciones -->
                <div
                    class="group bg-gradient-to-br from-green-900/40 to-teal-900/40 backdrop-blur-md rounded-2xl p-8 border border-green-500/30 hover:border-green-400/60 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <div class="flex items-center mb-6">
                        <div class="p-4 bg-green-500/20 rounded-xl mr-4 group-hover:bg-green-500/30 transition-colors">
                            <i
                                class="fas fa-bell text-green-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-green-400 group-hover:text-green-300 transition-colors">
                            Notificaciones</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Envía anuncios importantes, notifica cambios del sistema y mantén informada a toda la
                        comunidad.
                    </p>
                    <div class="flex space-x-3">
                        <span class="bg-green-400/20 text-green-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-broadcast-tower mr-1"></i>
                            Broadcast
                        </span>
                        <span class="bg-green-400/20 text-green-400 px-3 py-1 rounded-full text-xs font-medium">
                            <i class="fas fa-clock mr-1"></i>
                            Programar
                        </span>
                    </div>
                </div>
            </div>

            <!-- Alertas y Estado del Sistema -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Actividad Reciente -->
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-slate-600/50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-history mr-3 text-cyan-400"></i>
                            Actividad Reciente
                        </h3>
                        <a href="#" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium">Ver
                            todo</a>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="flex items-center space-x-4 p-3 bg-green-900/20 border border-green-500/20 rounded-lg">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-white">Nuevo usuario registrado</div>
                                <div class="text-xs text-gray-400">carlos.mendez@unasam.edu.pe - hace 5 min</div>
                            </div>
                        </div>

                        <div
                            class="flex items-center space-x-4 p-3 bg-blue-900/20 border border-blue-500/20 rounded-lg">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-white">Reto resuelto</div>
                                <div class="text-xs text-gray-400">Hash Cracker - Cryptography - hace 12 min</div>
                            </div>
                        </div>

                        <div
                            class="flex items-center space-x-4 p-3 bg-purple-900/20 border border-purple-500/20 rounded-lg">
                            <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-white">Nuevo reto añadido</div>
                                <div class="text-xs text-gray-400">SQL Injection Advanced - Web - hace 1h</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estado del Sistema -->
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-slate-600/50">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-server mr-3 text-green-400"></i>
                        Estado del Sistema
                    </h3>

                    <div class="space-y-4">
                        <div
                            class="flex items-center justify-between p-3 bg-green-900/20 border border-green-500/20 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-3 animate-pulse"></div>
                                <span class="text-white font-medium">Base de Datos</span>
                            </div>
                            <span class="text-green-400 text-sm font-medium">Operativo</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 bg-green-900/20 border border-green-500/20 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-3 animate-pulse"></div>
                                <span class="text-white font-medium">Servidor Web</span>
                            </div>
                            <span class="text-green-400 text-sm font-medium">Operativo</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 bg-yellow-900/20 border border-yellow-500/20 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-400 rounded-full mr-3 animate-pulse"></div>
                                <span class="text-white font-medium">CDN</span>
                            </div>
                            <span class="text-yellow-400 text-sm font-medium">Degradado</span>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 bg-green-900/20 border border-green-500/20 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-3 animate-pulse"></div>
                                <span class="text-white font-medium">API</span>
                            </div>
                            <span class="text-green-400 text-sm font-medium">Operativo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-cyan-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-blue-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
    </div>
</x-admin-layout>

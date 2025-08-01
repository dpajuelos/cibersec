<x-admin-layout>
    @section('title', 'Gestión de Notificaciones')
    @push('scripts')
        @vite('resources/js/admin/notificaciones.js')
    @endpush
    <div
        class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-purple-900 to-slate-800 min-h-screen py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-purple-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-green-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600/20 to-green-600/20 border border-purple-400/30 rounded-full text-purple-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-bell mr-3 animate-pulse"></i>
                    <span>Sistema de Notificaciones</span>
                </div>

                <div class="flex justify-between items-center">
                    <h1 class="text-4xl md:text-5xl font-black text-white">
                        <span
                            class="bg-gradient-to-r from-purple-400 via-green-400 to-teal-400 text-transparent bg-clip-text">
                            Notificaciones
                        </span>
                    </h1>
                    <button id="crear-notificacion-btn"
                        class="group bg-gradient-to-r from-purple-600 to-green-600 hover:from-purple-500 hover:to-green-500 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-purple-500/25 border border-purple-400/30">
                        <i class="fas fa-plus mr-3 group-hover:rotate-180 transition-transform duration-300"></i>
                        Nueva Notificación
                    </button>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-purple-400">{{ $totalNotificaciones ?? 0 }}</div>
                            <div class="text-gray-300 text-sm">Total Enviadas</div>
                        </div>
                        <div class="p-3 bg-purple-500/20 rounded-xl">
                            <i class="fas fa-paper-plane text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-green-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-green-400">{{ $notificacionesLeidas ?? 0 }}</div>
                            <div class="text-gray-300 text-sm">Leídas</div>
                        </div>
                        <div class="p-3 bg-green-500/20 rounded-xl">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-yellow-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-yellow-400">{{ $notificacionesPendientes ?? 0 }}</div>
                            <div class="text-gray-300 text-sm">Pendientes</div>
                        </div>
                        <div class="p-3 bg-yellow-500/20 rounded-xl">
                            <i class="fas fa-clock text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-teal-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-teal-400">{{ $usuariosActivos ?? 0 }}</div>
                            <div class="text-gray-300 text-sm">Usuarios Activos</div>
                        </div>
                        <div class="p-3 bg-teal-500/20 rounded-xl">
                            <i class="fas fa-users text-teal-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-8 mb-8 border border-slate-600/50 shadow-2xl">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-search mr-3 text-purple-400"></i>
                    Búsqueda de Notificaciones
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Buscar por mensaje</label>
                        <div class="relative">
                            <input type="text" id="buscar-notificacion" placeholder="Buscar notificaciones..."
                                class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Estado</label>
                        <select id="filtro-estado"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los estados</option>
                            <option value="1">Leídas</option>
                            <option value="0">No leídas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Tipo</label>
                        <select id="filtro-tipo"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los tipos</option>
                            <option value="general">General</option>
                            <option value="especifica">Específica</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button id="limpiar-filtros"
                            class="w-full bg-gradient-to-r from-slate-600 to-gray-600 hover:from-slate-500 hover:to-gray-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg shadow-slate-500/25 font-medium">
                            <i class="fas fa-eraser mr-2"></i>Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla de Notificaciones -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-slate-600/50">
                <div class="px-8 py-6 border-b border-slate-600/50">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-list mr-3 text-green-400"></i>
                        Historial de Notificaciones
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2"></i>ID
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-envelope mr-2"></i>Mensaje
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2"></i>Destinatario
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-eye mr-2"></i>Estado
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2"></i>Fecha
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-purple-400 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla-notificaciones" class="bg-slate-800/30 divide-y divide-slate-600/30">
                            @forelse ($notificaciones ?? [] as $notificacion)
                                <tr class="hover:bg-slate-700/30 transition-colors duration-200 notificacion-row">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-green-500/20 rounded-xl flex items-center justify-center">
                                                <span class="text-purple-400 font-bold">#{{ $notificacion->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-comment-alt text-green-400 text-lg"></i>
                                            </div>
                                            <div class="max-w-xs">
                                                <div class="text-lg font-bold text-white notificacion-mensaje">
                                                    {{ Str::limit($notificacion->message, 50) }}
                                                </div>
                                                <div class="text-sm text-gray-400">
                                                    <i class="fas fa-bell mr-1"></i>
                                                    Notificación del sistema
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        @if ($notificacion->fk_idusuario)
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-user text-blue-400 text-sm"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-medium text-blue-400">
                                                        {{ $notificacion->usuario->usuario ?? 'Usuario específico' }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">Específica</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-orange-500/20 to-red-500/20 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-users text-orange-400 text-sm"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-medium text-orange-400">Todos los
                                                        usuarios</span>
                                                    <span class="text-xs text-gray-500">General</span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium 
                                            {{ $notificacion->is_read ? 'bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-400/30' : 'bg-gradient-to-r from-yellow-500/20 to-orange-500/20 text-yellow-300 border border-yellow-400/30' }}">
                                            <div
                                                class="w-2 h-2 rounded-full mr-2 {{ $notificacion->is_read ? 'bg-green-400' : 'bg-yellow-400 animate-pulse' }}">
                                            </div>
                                            {{ $notificacion->is_read ? 'Leída' : 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-300">
                                                {{ $notificacion->created_at->format('d/m/Y') }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $notificacion->created_at->format('H:i') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex space-x-3">
                                            <button data-action="ver" data-id="{{ $notificacion->id }}"
                                                class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Ver detalles">
                                                <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                            </button>
                                            <button data-action="eliminar" data-id="{{ $notificacion->id }}"
                                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Eliminar notificación">
                                                <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-bell-slash text-gray-400 text-2xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-white mb-2">No hay notificaciones
                                                </h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{ request('search') ? 'No se encontraron resultados para tu búsqueda.' : 'Aún no has enviado ninguna notificación.' }}
                                                </p>
                                            </div>
                                            @if (!request('search'))
                                                <button
                                                    onclick="document.getElementById('crear-notificacion-btn').click()"
                                                    class="mt-4 bg-gradient-to-r from-purple-600 to-green-600 hover:from-purple-500 hover:to-green-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Enviar primera notificación
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if (isset($notificaciones) && $notificaciones->hasPages())
                    <div class="px-8 py-6 border-t border-slate-600/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                Mostrando {{ $notificaciones->firstItem() }} a {{ $notificaciones->lastItem() }} de
                                {{ $notificaciones->total() }} notificaciones
                            </div>
                            <div class="flex space-x-2">
                                {{ $notificaciones->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para crear/enviar notificaciones -->
    <div id="notificacion-modal"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div
            class="bg-slate-800/90 backdrop-blur-md rounded-2xl p-8 w-full max-w-2xl mx-4 border border-slate-600/50 transform scale-90 transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-paper-plane mr-3 text-purple-400"></i>
                    <span id="modal-title">Enviar Nueva Notificación</span>
                </h3>
                <button id="cerrar-modal" class="text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="notificacion-form" class="space-y-6">
                <!-- Tipo de notificación -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">Tipo de Notificación</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipo_notificacion" value="general" checked
                                class="sr-only peer">
                            <div
                                class="p-4 bg-slate-700/50 border border-slate-600 rounded-xl peer-checked:border-orange-400 peer-checked:bg-orange-500/20 transition-all duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-orange-400 text-xl mr-3"></i>
                                    <div>
                                        <div class="font-medium text-white">General</div>
                                        <div class="text-sm text-gray-400">Para todos los usuarios</div>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipo_notificacion" value="especifica" class="sr-only peer">
                            <div
                                class="p-4 bg-slate-700/50 border border-slate-600 rounded-xl peer-checked:border-blue-400 peer-checked:bg-blue-500/20 transition-all duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-blue-400 text-xl mr-3"></i>
                                    <div>
                                        <div class="font-medium text-white">Específica</div>
                                        <div class="text-sm text-gray-400">Para un usuario</div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Selector de usuario (solo para notificaciones específicas) -->
                <div id="usuario-selector" class="hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-3">Buscar Usuario</label>
                    <div class="relative">
                        <input type="text" id="buscar-usuario"
                            placeholder="Escribe el nombre o email del usuario..."
                            class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <!-- Resultados de búsqueda -->
                        <div id="usuarios-resultado"
                            class="absolute top-full left-0 right-0 bg-slate-700 border border-slate-600 rounded-xl mt-1 max-h-60 overflow-y-auto z-10 hidden">
                            <!-- Los resultados se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                    <!-- Usuario seleccionado -->
                    <div id="usuario-seleccionado"
                        class="hidden mt-4 p-4 bg-blue-500/20 border border-blue-400/30 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-500/30 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-400"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-white" id="usuario-nombre"></div>
                                    <div class="text-sm text-blue-300" id="usuario-email"></div>
                                </div>
                            </div>
                            <button type="button" id="remover-usuario" class="text-red-400 hover:text-red-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="usuario-id" name="usuario_id">
                </div>

                <!-- Mensaje -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3">Mensaje de la Notificación</label>
                    <textarea id="mensaje-notificacion" name="mensaje" rows="4"
                        placeholder="Escribe aquí el mensaje que quieres enviar..."
                        class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300 resize-none"
                        required></textarea>
                    <div class="text-xs text-gray-400 mt-2">
                        <span id="contador-caracteres">0</span>/500 caracteres
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex space-x-4 pt-6">
                    <button type="button" id="cancelar-modal"
                        class="flex-1 bg-gradient-to-r from-gray-600 to-slate-600 hover:from-gray-500 hover:to-slate-500 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </button>
                    <button type="submit" id="enviar-notificacion"
                        class="flex-1 bg-gradient-to-r from-purple-600 to-green-600 hover:from-purple-500 hover:to-green-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-500/25 font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar Notificación
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-purple-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-green-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-teal-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
        <div
            class="absolute bottom-1/4 left-1/2 w-1 h-1 bg-purple-300 rounded-full opacity-25 animate-pulse delay-500">
        </div>
    </div>
</x-admin-layout>

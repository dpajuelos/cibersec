<x-admin-layout>
    @section('title', 'Gestión de Usuarios')
    @push('scripts')
        @vite('resources/js/admin/usuario.js')
    @endpush
    <div
        class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-blue-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/3 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border border-blue-400/30 rounded-full text-blue-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-users mr-3 animate-pulse"></i>
                    <span>Gestión de Usuarios</span>
                </div>

                <div class="flex justify-between items-center">
                    <h1 class="text-4xl md:text-5xl font-black text-white relative">
                        <span class="text-transparent bg-clip-text bg-white animate-pulse">
                            Usuarios
                        </span>
                        <span class="absolute inset-0 text-blue-400 opacity-50 blur-sm">
                            Usuarios
                        </span>
                    </h1>
                    <button id="crear-usuario-btn"
                        class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-blue-500/25 border border-blue-400/30">
                        <i class="fas fa-user-plus mr-3 group-hover:rotate-180 transition-transform duration-300"></i>
                        Nuevo Usuario
                    </button>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-blue-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-blue-400">{{ $usuarios->total() }}</div>
                            <div class="text-gray-300 text-sm">Total Usuarios</div>
                        </div>
                        <div class="p-3 bg-blue-500/20 rounded-xl">
                            <i class="fas fa-users text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-emerald-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-emerald-400">
                                {{ $usuarios->where('fk_idestados', 1)->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Activos</div>
                        </div>
                        <div class="p-3 bg-emerald-500/20 rounded-xl">
                            <i class="fas fa-user-check text-emerald-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-cyan-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-cyan-400">
                                {{ $usuarios->filter(function ($u) {return $u->roles->isNotEmpty();})->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Con Roles</div>
                        </div>
                        <div class="p-3 bg-cyan-500/20 rounded-xl">
                            <i class="fas fa-user-shield text-cyan-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-amber-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-amber-400">
                                {{ $usuarios->where('fec_registro', '>=', now()->subMonth())->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Este Mes</div>
                        </div>
                        <div class="p-3 bg-amber-500/20 rounded-xl">
                            <i class="fas fa-user-clock text-amber-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-8 mb-8 border border-slate-600/50 shadow-2xl">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-filter mr-3 text-blue-400"></i>
                    Filtros de Usuario
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Buscar Usuario</label>
                        <div class="relative">
                            <input type="text" id="buscar-usuario" placeholder="Nombre, email..."
                                class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Estado</label>
                        <select id="filtro-estado"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los estados</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->idestados }}">{{ $estado->name_state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Rol</label>
                        <select id="filtro-rol"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los roles</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->idroles }}">{{ $rol->namerol }}</option>
                            @endforeach
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

            <!-- Tabla de Usuarios -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-slate-600/50">
                <div class="px-8 py-6 border-b border-slate-600/50">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-list mr-3 text-cyan-400"></i>
                        Lista de Usuarios
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2"></i>N°
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2"></i>Usuario
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-envelope mr-2"></i>Email
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-shield-alt mr-2"></i>Roles
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2"></i>Estado
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2"></i>Registro
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-blue-400 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla-usuarios" class="bg-slate-800/30 divide-y divide-slate-600/30">
                            @forelse ($usuarios as $index => $usuario)
                                <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                                    <!-- Número de registro -->
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-xl flex items-center justify-center">
                                                <span class="text-lg font-bold text-blue-400">
                                                    {{ ($usuarios->currentPage() - 1) * $usuarios->perPage() + $index + 1 }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Usuario -->
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                                                @if ($usuario->profile_photo_url)
                                                    <img class="w-10 h-10 rounded-xl object-cover"
                                                        src="{{ $usuario->profile_photo_url }}"
                                                        alt="{{ $usuario->usuario }}">
                                                @else
                                                    <i class="fas fa-user text-cyan-400"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-lg font-bold text-white">{{ $usuario->usuario }}
                                                </div>
                                                @if ($usuario->perfil && $usuario->perfil->persona)
                                                    <div class="text-sm text-gray-400">
                                                        {{ $usuario->perfil->persona->nombres }}
                                                        {{ $usuario->perfil->persona->ape_paterno }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="px-6 py-6">
                                        <div class="text-sm text-white">{{ $usuario->email }}</div>
                                        @if ($usuario->perfil && $usuario->perfil->universidad)
                                            <div class="text-xs text-blue-300 flex items-center mt-1">
                                                <i class="fas fa-university mr-1"></i>
                                                {{ Str::limit($usuario->perfil->universidad->nomuniversidad, 25) }}
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Roles -->
                                    <td class="px-6 py-6">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($usuario->roles as $rol)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-indigo-500/20 to-blue-500/20 text-gray-200 border border-indigo-400/30">
                                                    <i class="fas fa-shield-alt mr-1"></i>
                                                    {{ $rol->namerol }}
                                                </span>
                                            @empty
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-500/20 to-slate-500/20 text-gray-400 border border-gray-500/30">
                                                    <i class="fas fa-minus mr-1"></i>
                                                    Sin roles
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <!-- Estado -->
                                    <td class="px-6 py-6">
                                        @if ($usuario->fk_idestados == 1)
                                            <div class="inline-flex items-center space-x-2">
                                                <div class="relative">
                                                    <div class="w-3 h-3 bg-emerald-400 rounded-full"></div>
                                                    <div
                                                        class="absolute inset-0 w-3 h-3 bg-emerald-400 rounded-full animate-ping opacity-75">
                                                    </div>
                                                </div>
                                                <span class="text-sm font-medium text-gray-300">Activo</span>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center space-x-2">
                                                <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                                <span class="text-sm font-medium text-red-300">Suspendido</span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Fecha de registro -->
                                    <td class="px-6 py-6">
                                        <div class="text-sm text-white">
                                            {{ \Carbon\Carbon::parse($usuario->fec_registro)->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($usuario->fec_registro)->diffForHumans() }}
                                        </div>
                                    </td>

                                    <!-- Acciones -->
                                    <td class="px-6 py-6">
                                        <div class="flex space-x-2">
                                            <button data-action="ver" data-id="{{ $usuario->idusuario }}"
                                                class="group p-3 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 hover:from-cyan-500/30 hover:to-blue-500/30 text-cyan-300 border border-cyan-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Ver detalles">
                                                <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                            </button>
                                            <button data-action="editar" data-id="{{ $usuario->idusuario }}"
                                                class="group p-3 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 hover:from-blue-500/30 hover:to-indigo-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Editar usuario">
                                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button data-action="toggle-estado" data-id="{{ $usuario->idusuario }}"
                                                class="group p-3 bg-gradient-to-r from-amber-500/20 to-yellow-500/20 hover:from-amber-500/30 hover:to-yellow-500/30 text-amber-300 border border-amber-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="{{ $usuario->fk_idestados == 1 ? 'Desactivar' : 'Activar' }} usuario">
                                                <i
                                                    class="fas {{ $usuario->fk_idestados == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }} group-hover:scale-110 transition-transform"></i>
                                            </button>
                                            <button data-action="eliminar" data-id="{{ $usuario->idusuario }}"
                                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Eliminar usuario">
                                                <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-6">
                                            <div
                                                class="w-20 h-20 bg-gradient-to-br from-slate-600/20 to-slate-500/20 rounded-2xl flex items-center justify-center border border-slate-600/30">
                                                <i class="fas fa-users text-slate-400 text-3xl"></i>
                                            </div>
                                            <div class="text-center max-w-sm">
                                                <h3 class="text-xl font-bold text-white mb-2">
                                                    {{ request('search') ? 'No se encontraron usuarios' : 'No hay usuarios registrados' }}
                                                </h3>
                                                <p class="text-slate-400 text-sm leading-relaxed">
                                                    @if (request('search'))
                                                        No encontramos usuarios que coincidan con tu búsqueda.
                                                    @else
                                                        Comienza agregando usuarios al sistema para gestionar el acceso.
                                                    @endif
                                                </p>
                                            </div>
                                            @if (!request('search'))
                                                <button onclick="document.getElementById('crear-usuario-btn').click()"
                                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg shadow-blue-500/20 font-medium">
                                                    <i class="fas fa-user-plus mr-2"></i>
                                                    Crear primer usuario
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
                @if ($usuarios->hasPages())
                    <div
                        class="px-8 py-6 border-t border-slate-700/30 bg-gradient-to-r from-slate-800/50 to-slate-700/50">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <div class="text-sm text-slate-400">
                                Mostrando <span class="font-semibold text-white">{{ $usuarios->firstItem() }}</span> a
                                <span class="font-semibold text-white">{{ $usuarios->lastItem() }}</span> de
                                <span class="font-semibold text-white">{{ $usuarios->total() }}</span> usuarios
                            </div>
                            <div class="flex space-x-2">
                                {{ $usuarios->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Incluir el modal -->
    @include('admin.components.usuario-modal')

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/6 left-1/6 w-2 h-2 bg-blue-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-2/3 right-1/5 w-1.5 h-1.5 bg-cyan-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/3 left-2/3 w-2 h-2 bg-emerald-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
        <div class="absolute bottom-1/3 left-1/2 w-1 h-1 bg-blue-300 rounded-full opacity-25 animate-pulse delay-500">
        </div>
    </div>
</x-admin-layout>

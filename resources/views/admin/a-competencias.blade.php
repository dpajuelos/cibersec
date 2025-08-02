<x-admin-layout>
    @section('title', 'Gestión de Competencias')
    @push('scripts')
        @vite('resources/js/admin/competencia.js')
    @endpush
    <div
        class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-orange-900 to-slate-800 min-h-screen py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-orange-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600/20 to-amber-600/20 border border-orange-400/30 rounded-full text-orange-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-trophy mr-3 animate-pulse"></i>
                    <span>Gestión de Competencias CTF</span>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white text-center sm:text-left">
                        <span
                            class="bg-gradient-to-r from-orange-400 via-amber-400 to-yellow-400 text-transparent bg-clip-text">
                            Competencias
                        </span>
                    </h1>
                    <button id="crear-competencia-btn"
                        class="group bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white px-6 py-3 sm:px-8 sm:py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-orange-500/25 border border-orange-400/30 w-full sm:w-auto">
                        <i class="fas fa-plus mr-3 group-hover:rotate-180 transition-transform duration-300"></i>
                        Nueva Competencia
                    </button>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-orange-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-orange-400">{{ $competencias->count() }}</div>
                            <div class="text-gray-300 text-sm">Total Competencias</div>
                        </div>
                        <div class="p-3 bg-orange-500/20 rounded-xl">
                            <i class="fas fa-trophy text-orange-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-green-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-green-400">
                                {{ $competencias->where('estado.estadocompe', 'Activa')->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Activas</div>
                        </div>
                        <div class="p-3 bg-green-500/20 rounded-xl">
                            <i class="fas fa-play-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-blue-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-blue-400">
                                {{ $competencias->where('estado.estadocompe', 'Programada')->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Programadas</div>
                        </div>
                        <div class="p-3 bg-blue-500/20 rounded-xl">
                            <i class="fas fa-clock text-blue-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-amber-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-amber-400">
                                {{ $tiposCompetencia->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Tipos Disponibles</div>
                        </div>
                        <div class="p-3 bg-amber-500/20 rounded-xl">
                            <i class="fas fa-tags text-amber-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-8 mb-8 border border-slate-600/50 shadow-2xl">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-search mr-3 text-orange-400"></i>
                    Búsqueda de Competencias
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Buscar por nombre</label>
                        <div class="relative">
                            <input type="text" id="buscar-competencia" placeholder="Nombre de la competencia..."
                                class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Estado</label>
                        <select id="filtro-estado"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los estados</option>
                            @foreach ($estadosCompetencia as $estado)
                                <option value="{{ $estado->idestado_compe }}">{{ $estado->estadocompe }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Tipo</label>
                        <select id="filtro-tipo"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los tipos</option>
                            @foreach ($tiposCompetencia as $tipo)
                                <option value="{{ $tipo->idtipo_compe }}">{{ $tipo->tipocompe }}</option>
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

            <!-- Tabla de Competencias -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-slate-600/50">
                <div class="px-8 py-6 border-b border-slate-600/50">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-list mr-3 text-amber-400"></i>
                        Lista de Competencias
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-trophy mr-2"></i>Competencia
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2"></i>Tipo
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2"></i>Fechas
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2"></i>Estado
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-flag mr-2"></i>Retos
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-orange-400 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla-competencias" class="bg-slate-800/30 divide-y divide-slate-600/30">
                            @forelse ($competencias as $competencia)
                                <tr class="hover:bg-slate-700/30 transition-colors duration-200 competencia-row">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-trophy text-orange-400 text-lg"></i>
                                            </div>
                                            <div>
                                                <div class="text-lg font-bold text-white competencia-nombre">
                                                    {{ $competencia->nomcompe }}
                                                </div>
                                                <div class="text-sm text-gray-400 max-w-xs">
                                                    {{ Str::limit($competencia->descripcion, 60) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-amber-500/20 to-yellow-500/20 text-amber-300 border border-amber-400/30">
                                            <i class="fas fa-tag mr-2"></i>
                                            {{ $competencia->tipo->tipocompe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col space-y-1">
                                            <div class="flex items-center text-sm text-gray-300">
                                                <i class="fas fa-play text-green-400 mr-2"></i>
                                                <span class="font-medium">Inicio:</span>
                                                <span
                                                    class="ml-1">{{ \Carbon\Carbon::parse($competencia->fec_inicio)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-300">
                                                <i class="fas fa-stop text-red-400 mr-2"></i>
                                                <span class="font-medium">Fin:</span>
                                                <span
                                                    class="ml-1">{{ \Carbon\Carbon::parse($competencia->fec_final)->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <i class="fas fa-clock mr-1"></i>
                                                Duración:
                                                {{ \Carbon\Carbon::parse($competencia->fec_inicio)->diffInHours(\Carbon\Carbon::parse($competencia->fec_final)) }}
                                                horas
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        @php
                                            $estadoColors = [
                                                'En Curso' =>
                                                    'from-green-500/20 to-emerald-500/20 text-green-300 border-green-400/30',
                                                'Abierta' =>
                                                    'from-blue-500/20 to-cyan-500/20 text-blue-300 border-blue-400/30',
                                                'Cerrada' =>
                                                    'from-gray-500/20 to-slate-500/20 text-gray-300 border-gray-400/30',
                                                'Cancelada' =>
                                                    'from-red-500/20 to-pink-500/20 text-red-300 border-red-400/30',
                                            ];
                                            $colorClass =
                                                $estadoColors[$competencia->estado->estadocompe] ??
                                                'from-gray-500/20 to-slate-500/20 text-gray-300 border-gray-400/30';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r {{ $colorClass }}">
                                            <div
                                                class="w-2 h-2 rounded-full mr-2 
                                                {{ $competencia->estado->estadocompe == 'Activa' ? 'bg-green-400 animate-pulse' : '' }}
                                                {{ $competencia->estado->estadocompe == 'Programada' ? 'bg-blue-400' : '' }}
                                                {{ $competencia->estado->estadocompe == 'Finalizada' ? 'bg-gray-400' : '' }}
                                                {{ $competencia->estado->estadocompe == 'Cancelada' ? 'bg-red-400' : '' }}">
                                            </div>
                                            {{ $competencia->estado->estadocompe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-flag text-cyan-400 text-sm"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-xl font-bold text-cyan-400">{{ $competencia->retos_count ?? 0 }}</span>
                                                <span class="text-xs text-gray-500">
                                                    {{ $competencia->retos_count == 1 ? 'reto' : 'retos' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex space-x-3">
                                            <button data-action="ver" data-id="{{ $competencia->idcompetencia }}"
                                                class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Ver detalles">
                                                <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                            </button>
                                            <button data-action="editar" data-id="{{ $competencia->idcompetencia }}"
                                                class="group p-3 bg-gradient-to-r from-amber-500/20 to-orange-500/20 hover:from-amber-500/30 hover:to-orange-500/30 text-amber-300 border border-amber-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Editar competencia">
                                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button data-action="retos" data-id="{{ $competencia->idcompetencia }}"
                                                class="group p-3 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 text-purple-300 border border-purple-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Gestionar retos">
                                                <i class="fas fa-flag group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button data-action="eliminar"
                                                data-id="{{ $competencia->idcompetencia }}"
                                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105 {{ $competencia->retos_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                title="{{ $competencia->retos_count > 0 ? 'No se puede eliminar: tiene retos asociados' : 'Eliminar competencia' }}"
                                                {{ $competencia->retos_count > 0 ? 'disabled' : '' }}>
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
                                                <i class="fas fa-trophy text-gray-400 text-2xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-white mb-2">No hay competencias</h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{ request('search') ? 'No se encontraron resultados para tu búsqueda.' : 'Aún no has creado ninguna competencia.' }}
                                                </p>
                                            </div>
                                            @if (!request('search'))
                                                <button
                                                    onclick="document.getElementById('crear-competencia-btn').click()"
                                                    class="mt-4 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Crear primera competencia
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
                @if ($competencias->hasPages())
                    <div class="px-8 py-6 border-t border-slate-600/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                Mostrando {{ $competencias->firstItem() }} a {{ $competencias->lastItem() }} de
                                {{ $competencias->total() }} competencias
                            </div>
                            <div class="flex space-x-2">
                                {{ $competencias->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Incluir el modal -->
    {{-- @include('admin.components.competencia-modal') --}}

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-orange-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-amber-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-yellow-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
        <div
            class="absolute bottom-1/4 left-1/2 w-1 h-1 bg-orange-300 rounded-full opacity-25 animate-pulse delay-500">
        </div>
    </div>
</x-admin-layout>

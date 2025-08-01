<x-admin-layout>
    @section('title', 'Gestión de Retos')
    @push('scripts')
        @vite('resources/js/admin/retos.js')
    @endpush
    <div
        class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 min-h-screen py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-cyan-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600/20 to-purple-600/20 border border-cyan-400/30 rounded-full text-cyan-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-flag mr-3 animate-pulse"></i>
                    <span>Gestión de Retos CTF</span>
                </div>

                <div class="flex justify-between items-center">
                    <h1 class="text-4xl md:text-5xl font-black text-white">
                        <span
                            class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 text-transparent bg-clip-text">
                            Retos CTF
                        </span>
                    </h1>
                    <button id="crear-reto-btn"
                        class="group bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-cyan-500/25 border border-cyan-400/30">
                        <i class="fas fa-plus mr-3 group-hover:rotate-180 transition-transform duration-300"></i>
                        Crear Reto
                    </button>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-cyan-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-cyan-400">{{ $retos->count() }}</div>
                            <div class="text-gray-300 text-sm">Total Retos</div>
                        </div>
                        <div class="p-3 bg-cyan-500/20 rounded-xl">
                            <i class="fas fa-flag text-cyan-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-green-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-green-400">
                                {{ $retos->where('estadoReto.estadoreto', 'Activo')->count() }}</div>
                            <div class="text-gray-300 text-sm">Activos</div>
                        </div>
                        <div class="p-3 bg-green-500/20 rounded-xl">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-purple-400">{{ $categorias->count() }}</div>
                            <div class="text-gray-300 text-sm">Categorías</div>
                        </div>
                        <div class="p-3 bg-purple-500/20 rounded-xl">
                            <i class="fas fa-layer-group text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-yellow-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-yellow-400">{{ $niveles->count() }}</div>
                            <div class="text-gray-300 text-sm">Niveles</div>
                        </div>
                        <div class="p-3 bg-yellow-500/20 rounded-xl">
                            <i class="fas fa-chart-line text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-8 mb-8 border border-slate-600/50 shadow-2xl">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-filter mr-3 text-cyan-400"></i>
                    Filtros de Búsqueda
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Categoría</label>
                        <select id="filtro-categoria"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todas las categorías</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->idcategoria }}">{{ $categoria->nomcategoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Nivel</label>
                        <select id="filtro-nivel"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los niveles</option>
                            @foreach ($niveles as $nivel)
                                <option value="{{ $nivel->idnivel_reto }}">{{ $nivel->nomnivelreto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Estado</label>
                        <select id="filtro-estado"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                            <option value="">Todos los estados</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->idestado_reto }}">{{ $estado->estadoreto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button id="aplicar-filtros"
                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg shadow-green-500/25 font-medium">
                            <i class="fas fa-search mr-2"></i>Filtrar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla de Retos -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-slate-600/50">
                <div class="px-8 py-6 border-b border-slate-600/50">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-list mr-3 text-purple-400"></i>
                        Lista de Retos
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-flag mr-2"></i>Reto
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-layer-group mr-2"></i>Categoría
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-chart-line mr-2"></i>Nivel
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-star mr-2"></i>Puntos
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2"></i>Estado
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-file mr-2"></i>Archivos
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla-retos" class="bg-slate-800/30 divide-y divide-slate-600/30">
                            @foreach ($retos as $reto)
                                <tr class="hover:bg-slate-700/30 transition-colors duration-200"
                                    data-categoria="{{ $reto->fk_categoria }}" data-nivel="{{ $reto->fk_nivel }}"
                                    data-estado="{{ $reto->fk_estado_reto }}">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-flag text-cyan-400 text-lg"></i>
                                            </div>
                                            <div>
                                                <div class="text-lg font-bold text-white">{{ $reto->nomreto }}</div>
                                                <div class="text-sm text-gray-400 max-w-xs truncate">
                                                    {{ Str::limit($reto->descripcion, 60) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-500/20 to-cyan-500/20 text-blue-300 border border-blue-400/30">
                                            <i class="fas fa-tag mr-2"></i>
                                            {{ $reto->categoria->nomcategoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        @php
                                            $nivelColors = [
                                                'Fácil' =>
                                                    'from-green-500/20 to-emerald-500/20 text-green-300 border-green-400/30',
                                                'Medio' =>
                                                    'from-yellow-500/20 to-orange-500/20 text-yellow-300 border-yellow-400/30',
                                                'Difícil' =>
                                                    'from-red-500/20 to-pink-500/20 text-red-300 border-red-400/30',
                                            ];
                                            $colorClass =
                                                $nivelColors[$reto->nivel->nomnivelreto] ??
                                                'from-gray-500/20 to-slate-500/20 text-gray-300 border-gray-400/30';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r {{ $colorClass }}">
                                            <i class="fas fa-signal mr-2"></i>
                                            {{ $reto->nivel->nomnivelreto }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <i class="fas fa-star text-yellow-400 mr-2"></i>
                                            <span class="text-xl font-bold text-yellow-400">{{ $reto->puntos }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium 
                                            {{ $reto->estadoReto->estadoreto == 'Activo' ? 'bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-400/30' : 'bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 border border-red-400/30' }}">
                                            <div
                                                class="w-2 h-2 rounded-full mr-2 {{ $reto->estadoReto->estadoreto == 'Activo' ? 'bg-green-400 animate-pulse' : 'bg-red-400' }}">
                                            </div>
                                            {{ $reto->estadoReto->estadoreto }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        @if ($reto->archivo)
                                            <a href="{{ $reto->archivo->getUrlCompletatAttribute() }}"
                                                target="_blank"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/20 to-pink-500/20 text-purple-300 border border-purple-400/30 rounded-full hover:from-purple-500/30 hover:to-pink-500/30 transition-all duration-300">
                                                <i class="fas fa-download mr-2"></i>
                                                Descargar
                                            </a>
                                        @else
                                            <span
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500/20 to-slate-500/20 text-gray-400 border border-gray-500/30 rounded-full">
                                                <i class="fas fa-file-slash mr-2"></i>
                                                Sin archivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex space-x-3">
                                            <button data-action="editar" data-id="{{ $reto->idretos }}"
                                                class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button data-action="eliminar" data-id="{{ $reto->idretos }}"
                                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir el modal -->
    @include('admin.components.reto-modal')

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-cyan-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-blue-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
    </div>
</x-admin-layout>

<x-admin-layout>
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
                                            <button onclick="editarReto({{ $reto->idretos }})"
                                                class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button onclick="eliminarReto({{ $reto->idretos }})"
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

    <!-- Modal para Crear/Editar Reto -->
    <div id="modal-reto"
        class="flex hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 items-center justify-center p-4">
        <div
            class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl shadow-2xl max-w-6xl w-full max-h-[95vh] overflow-y-auto border border-slate-600/50">
            <!-- Header del Modal -->
            <div class="px-8 py-6 border-b border-slate-600/50 bg-gradient-to-r from-slate-700/50 to-slate-800/50">
                <div class="flex justify-between items-center">
                    <h3 id="modal-titulo" class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-flag mr-3 text-cyan-400"></i>
                        Crear Nuevo Reto
                    </h3>
                    <button id="cerrar-modal"
                        class="text-gray-400 hover:text-white p-2 hover:bg-slate-700/50 rounded-xl transition-all duration-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form id="form-reto" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="reto-id" name="reto_id">

                <div class="px-8 py-6 space-y-8">
                    <!-- Información Básica -->
                    <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                        <h4 class="text-xl font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-info-circle mr-3 text-blue-400"></i>
                            Información Básica
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Nombre del Reto</label>
                                <input type="text" id="nomreto" name="nomreto" required
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                                    placeholder="Ej: SQL Injection Basic">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Puntos</label>
                                <input type="number" id="puntos" name="puntos" required min="0"
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                                    placeholder="100">
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-300 mb-3">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4" required
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                                placeholder="Describe el reto y proporciona las instrucciones necesarias..."></textarea>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-300 mb-3">Flag</label>
                            <input type="text" id="flag" name="flag" required
                                class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300"
                                placeholder="flag{example_flag_here}">
                        </div>
                    </div>

                    <!-- Configuración -->
                    <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                        <h4 class="text-xl font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-cogs mr-3 text-purple-400"></i>
                            Configuración
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Categoría</label>
                                <select id="fk_categoria" name="fk_categoria" required
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->idcategoria }}">{{ $categoria->nomcategoria }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Nivel</label>
                                <select id="fk_nivel" name="fk_nivel" required
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                                    <option value="">Seleccionar nivel</option>
                                    @foreach ($niveles as $nivel)
                                        <option value="{{ $nivel->idnivel_reto }}">{{ $nivel->nomnivelreto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Competencia</label>
                                <select id="fk_competencia" name="fk_competencia" required
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                                    <option value="">Seleccionar competencia</option>
                                    @foreach ($competencias as $competencia)
                                        <option value="{{ $competencia->idcompetencia }}">
                                            {{ $competencia->nomcompe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-3">Estado</label>
                                <select id="fk_estado_reto" name="fk_estado_reto" required
                                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                                    <option value="">Seleccionar estado</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->idestado_reto }}">{{ $estado->estadoreto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Archivo -->
                    <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                        <h4 class="text-xl font-bold text-white mb-6 flex items-center">
                            <i class="fas fa-file-upload mr-3 text-green-400"></i>
                            Archivo del Reto
                        </h4>
                        <div
                            class="border-2 border-dashed border-slate-600 rounded-2xl p-8 text-center hover:border-cyan-400/50 transition-colors duration-300">
                            <div class="space-y-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl flex items-center justify-center mx-auto">
                                    <i class="fas fa-cloud-upload-alt text-cyan-400 text-2xl"></i>
                                </div>
                                <div>
                                    <label for="archivo" class="cursor-pointer">
                                        <span class="text-cyan-400 hover:text-cyan-300 font-medium text-lg">Subir
                                            archivo</span>
                                        <input id="archivo" name="archivo" type="file" class="sr-only">
                                    </label>
                                    <p class="text-gray-400 mt-2">o arrastra y suelta aquí</p>
                                </div>
                                <p class="text-sm text-gray-500">PNG, JPG, PDF, ZIP hasta 10MB</p>
                            </div>
                        </div>
                        <div id="archivo-actual" class="mt-4 hidden">
                            <div class="bg-slate-700/50 rounded-xl p-4 border border-slate-600">
                                <p class="text-sm text-gray-300">Archivo actual:
                                    <span id="nombre-archivo-actual" class="font-medium text-white"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Pistas -->
                    <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-xl font-bold text-white flex items-center">
                                <i class="fas fa-lightbulb mr-3 text-yellow-400"></i>
                                Pistas
                            </h4>
                            <button type="button" id="agregar-pista"
                                class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 text-white px-4 py-2 rounded-xl transition-all duration-300 transform hover:scale-105 text-sm font-medium">
                                <i class="fas fa-plus mr-2"></i>Agregar Pista
                            </button>
                        </div>
                        <div id="container-pistas" class="space-y-4">
                            <!-- Las pistas se añadirán dinámicamente aquí -->
                        </div>
                    </div>
                </div>

                <!-- Footer del Modal -->
                <div
                    class="px-8 py-6 border-t border-slate-600/50 bg-gradient-to-r from-slate-700/50 to-slate-800/50 flex justify-end space-x-4">
                    <button type="button" id="cancelar-btn"
                        class="px-6 py-3 bg-slate-600 hover:bg-slate-500 text-white rounded-xl transition-all duration-300 font-medium">
                        <i class="fas fa-times mr-2"></i>Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 font-medium shadow-lg shadow-cyan-500/25">
                        <i class="fas fa-save mr-2"></i>Guardar Reto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let pistasCounter = 0;
        let isEditing = false;

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
        });

        function initializeEventListeners() {
            // Modal
            document.getElementById('crear-reto-btn').addEventListener('click', abrirModalCrear);
            document.getElementById('cerrar-modal').addEventListener('click', cerrarModal);
            document.getElementById('cancelar-btn').addEventListener('click', cerrarModal);

            // Form
            document.getElementById('form-reto').addEventListener('submit', guardarReto);

            // Pistas
            document.getElementById('agregar-pista').addEventListener('click', agregarPista);

            // Archivo
            document.getElementById('archivo').addEventListener('change', manejarCambioArchivo);

            // Filtros
            document.getElementById('aplicar-filtros').addEventListener('click', aplicarFiltros);

            // Cerrar modal al hacer clic fuera
            document.getElementById('modal-reto').addEventListener('click', function(e) {
                if (e.target === this) {
                    cerrarModal();
                }
            });
        }

        function aplicarFiltros() {
            const categoria = document.getElementById('filtro-categoria').value;
            const nivel = document.getElementById('filtro-nivel').value;
            const estado = document.getElementById('filtro-estado').value;

            const filas = document.querySelectorAll('#tabla-retos tr[data-categoria]');

            filas.forEach(fila => {
                let mostrar = true;

                if (categoria && fila.dataset.categoria !== categoria) {
                    mostrar = false;
                }
                if (nivel && fila.dataset.nivel !== nivel) {
                    mostrar = false;
                }
                if (estado && fila.dataset.estado !== estado) {
                    mostrar = false;
                }

                fila.style.display = mostrar ? '' : 'none';
            });
        }

        function abrirModalCrear() {
            isEditing = false;
            document.getElementById('modal-titulo').innerHTML =
                '<i class="fas fa-plus mr-3 text-cyan-400"></i>Crear Nuevo Reto';
            document.getElementById('form-reto').reset();
            document.getElementById('reto-id').value = '';
            document.getElementById('archivo-actual').classList.add('hidden');
            limpiarPistas();
            document.getElementById('modal-reto').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modal-reto').classList.add('hidden');
            limpiarPistas();
        }

        function agregarPista() {
            pistasCounter++;
            const container = document.getElementById('container-pistas');
            const pistaDiv = document.createElement('div');
            pistaDiv.className =
                'flex space-x-4 items-center pista-item bg-slate-700/50 p-4 rounded-xl border border-slate-600';
            pistaDiv.innerHTML = `
                <div class="flex-1">
                    <input type="text" name="pistas[${pistasCounter}][contenido]" placeholder="Contenido de la pista" 
                        class="w-full px-4 py-3 bg-slate-600/50 border border-slate-500 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                </div>
                <div class="w-32">
                    <input type="number" name="pistas[${pistasCounter}][valor]" placeholder="Valor" min="0"
                        class="w-full px-4 py-3 bg-slate-600/50 border border-slate-500 rounded-xl text-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                </div>
                <button type="button" onclick="eliminarPista(this)" 
                    class="p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(pistaDiv);
        }

        function eliminarPista(button) {
            button.closest('.pista-item').remove();
        }

        function limpiarPistas() {
            document.getElementById('container-pistas').innerHTML = '';
            pistasCounter = 0;
        }

        function manejarCambioArchivo(event) {
            const file = event.target.files[0];
            if (file) {
                console.log('Archivo seleccionado:', file.name);
                // Aquí puedes agregar lógica adicional para mostrar el archivo seleccionado
            }
        }

        async function guardarReto(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const retoId = formData.get('reto_id');
            const url = isEditing ? `/admin/challenges/${retoId}` : '/admin/challenges';
            const method = 'POST';

            if (isEditing) {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Mostrar mensaje de éxito
                    showNotification('success', isEditing ? 'Reto actualizado correctamente' :
                        'Reto creado correctamente');

                    cerrarModal();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    // Manejar errores de validación o del servidor
                    let errorMessage = 'Error al guardar el reto';

                    if (result.message) {
                        errorMessage = result.message;
                    } else if (result.errors) {
                        // Si hay errores de validación, mostrar el primero
                        const firstError = Object.values(result.errors)[0];
                        errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                    }

                    showNotification('error', errorMessage);
                    console.error('Error del servidor:', result);
                }
            } catch (error) {
                console.error('Error de red:', error);
                showNotification('error', 'Error de conexión al guardar el reto');
            }
        }

        async function editarReto(id) {
            try {
                const response = await fetch(`/admin/challenges/${id}/edit`);
                const reto = await response.json();

                isEditing = true;
                document.getElementById('modal-titulo').innerHTML =
                    '<i class="fas fa-edit mr-3 text-cyan-400"></i>Editar Reto';

                // Llenar el formulario con los datos del reto
                document.getElementById('reto-id').value = reto.idretos;
                document.getElementById('nomreto').value = reto.nomreto;
                document.getElementById('puntos').value = reto.puntos;
                document.getElementById('descripcion').value = reto.descripcion;
                document.getElementById('flag').value = reto.flag;
                document.getElementById('fk_categoria').value = reto.fk_categoria;
                document.getElementById('fk_nivel').value = reto.fk_nivel;
                document.getElementById('fk_competencia').value = reto.fk_competencia;
                document.getElementById('fk_estado_reto').value = reto.fk_estado_reto;

                // Mostrar archivo actual si existe
                if (reto.archivo) {
                    document.getElementById('archivo-actual').classList.remove('hidden');
                    document.getElementById('nombre-archivo-actual').textContent = reto.archivo.nombre;
                }

                // Mostrar pistas existentes con advertencia
                limpiarPistas();
                if (reto.pistas && reto.pistas.length > 0) {
                    // Mostrar advertencia
                    const pistasContainer = document.getElementById('container-pistas');
                    const advertencia = document.createElement('div');
                    advertencia.className = 'bg-yellow-600/20 border border-yellow-500/30 rounded-xl p-4 mb-4';
                    advertencia.innerHTML = `
                        <div class="flex items-center text-yellow-300">
                            <i class="fas fa-info-circle mr-3"></i>
                            <div>
                                <p class="font-medium">Pistas existentes:</p>
                                <p class="text-sm mt-1">Las pistas que ya existen se mantienen. Solo puedes agregar nuevas pistas.</p>
                                <p class="text-sm">Para eliminar pistas, usa el botón de eliminar individual si no tienen registros asociados.</p>
                            </div>
                        </div>
                    `;
                    pistasContainer.appendChild(advertencia);

                    // Mostrar pistas existentes (solo lectura)
                    reto.pistas.forEach((pista, index) => {
                        const pistaDiv = document.createElement('div');
                        pistaDiv.className =
                            'flex space-x-4 items-center bg-slate-600/30 p-4 rounded-xl border border-slate-500/50';
                        pistaDiv.innerHTML = `
                            <div class="flex-1">
                                <input type="text" value="${pista.contenido}" readonly
                                    class="w-full px-4 py-3 bg-slate-500/30 border border-slate-400/50 rounded-xl text-gray-300 cursor-not-allowed">
                            </div>
                            <div class="w-32">
                                <input type="number" value="${pista.valor}" readonly
                                    class="w-full px-4 py-3 bg-slate-500/30 border border-slate-400/50 rounded-xl text-gray-300 cursor-not-allowed">
                            </div>
                            <div class="flex space-x-2">
                                <span class="px-3 py-2 bg-blue-600/20 text-blue-300 text-xs rounded-lg border border-blue-500/30">
                                    Existente
                                </span>
                                <button type="button" onclick="eliminarPistaExistente(${reto.idretos}, ${pista.idpistas}, this)" 
                                    class="p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                        pistasContainer.appendChild(pistaDiv);
                    });
                }

                document.getElementById('modal-reto').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                showNotification('error', 'Error al cargar los datos del reto');
            }
        }

        // Reemplazar la función eliminarReto existente
        async function eliminarReto(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este reto? Esta acción no se puede deshacer.')) {
                try {
                    const response = await fetch(`/admin/challenges/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        showNotification('success', result.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showNotification('error', result.message || 'Error al eliminar el reto');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('error', 'Error de conexión al eliminar el reto');
                }
            }
        }

        // Mejorar también la función eliminarPistaExistente
        async function eliminarPistaExistente(retoId, pistaId, button) {
            if (confirm('¿Estás seguro de que quieres eliminar esta pista? Esta acción no se puede deshacer.')) {
                try {
                    const response = await fetch(`/admin/challenges/${retoId}/pistas/${pistaId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        showNotification('success', result.message);
                        button.closest('.flex').remove();
                    } else {
                        showNotification('error', result.message || 'Error al eliminar la pista');
                    }
                } catch (error) {
                    console.error('Error completo:', error);
                    showNotification('error', 'Error de conexión al eliminar la pista');
                }
            }
        }

        function showNotification(type, message) {
            // Crear elemento de notificación
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-4 rounded-xl shadow-2xl z-[60] transform translate-x-full transition-transform duration-300 ${
                type === 'success' 
                ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white border border-green-400/30' 
                : 'bg-gradient-to-r from-red-600 to-pink-600 text-white border border-red-400/30'
            }`;

            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Mostrar notificación
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Ocultar después de 3 segundos
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-cyan-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-blue-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
    </div>
</x-admin-layout>

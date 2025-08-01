<div id="modal-reto" class="flex hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 items-center justify-center p-4">
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
                        <i class="fas fa-file-archive mr-3 text-green-400"></i>
                        Archivo del Reto
                        <span
                            class="ml-2 text-xs bg-blue-600/20 text-blue-300 px-2 py-1 rounded-lg border border-blue-500/30">
                            Máximo 1 archivo
                        </span>
                    </h4>

                    <!-- Área de subida de archivo (solo cuando no hay archivo) -->
                    <div id="upload-area"
                        class="border-2 border-dashed border-slate-600 rounded-2xl p-8 text-center hover:border-cyan-400/50 transition-all duration-300 cursor-pointer">
                        <div class="space-y-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-2xl flex items-center justify-center mx-auto transition-all duration-300">
                                <i class="fas fa-cloud-upload-alt text-cyan-400 text-2xl"></i>
                            </div>
                            <div>
                                <label for="archivo" class="cursor-pointer block">
                                    <span
                                        class="text-cyan-400 hover:text-cyan-300 font-medium text-lg transition-colors duration-300">Subir
                                        archivo</span>
                                    <input id="archivo" name="archivo" type="file" class="sr-only"
                                        accept=".zip,.rar">
                                </label>
                                <p class="text-gray-400 mt-2 text-sm">
                                    <i class="fas fa-hand-pointer mr-1"></i>Haz clic aquí o
                                    <span class="font-medium text-cyan-400">arrastra y suelta</span> tu archivo
                                </p>
                            </div>
                            <div class="bg-blue-600/10 border border-blue-500/30 rounded-xl p-4">
                                <p class="text-sm text-blue-300 font-medium mb-2">
                                    <i class="fas fa-info-circle mr-2"></i>Recomendaciones
                                </p>
                                <div class="text-sm text-gray-300 space-y-1">
                                    <p>• Usa archivos <strong class="text-cyan-300">ZIP</strong> o <strong
                                            class="text-cyan-300">RAR</strong> únicamente</p>
                                    <p>• Incluye todos los recursos necesarios para el reto</p>
                                    <p>• Máximo <strong class="text-cyan-300">50MB</strong> por archivo</p>
                                    <p>• Solo se permite <strong class="text-cyan-300">1 archivo por reto</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Archivo actual (cuando está editando y tiene archivo) -->
                    <div id="archivo-actual" class="hidden">
                        <div class="bg-slate-700/50 rounded-xl p-6 border border-slate-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-file-archive text-green-400 text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-green-300 font-medium">Archivo actual:</p>
                                        <p id="nombre-archivo-actual" class="font-semibold text-white text-lg"></p>
                                        <p id="size-archivo-actual" class="text-sm text-gray-400"></p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-check-circle text-green-400 text-xs mr-1"></i>
                                            <span class="text-xs text-green-300">Archivo subido correctamente</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <button type="button" id="descargar-archivo-btn"
                                        class="px-4 py-2 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 text-blue-300 border border-blue-400/30 rounded-lg hover:from-blue-500/30 hover:to-cyan-500/30 transition-all duration-300">
                                        <i class="fas fa-download mr-2"></i>Descargar
                                    </button>
                                    <button type="button" id="eliminar-archivo-btn"
                                        class="px-4 py-2 bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 border border-red-400/30 rounded-lg hover:from-red-500/30 hover:to-pink-500/30 transition-all duration-300">
                                        <i class="fas fa-trash mr-2"></i>Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Archivo seleccionado (antes de subir) -->
                    <div id="archivo-seleccionado" class="hidden">
                        <div class="bg-yellow-600/10 border border-yellow-500/30 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-file text-yellow-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-yellow-300 font-medium">Archivo seleccionado:</p>
                                        <p id="nombre-archivo-seleccionado" class="font-medium text-white"></p>
                                        <p id="size-archivo-seleccionado" class="text-xs text-yellow-400/70"></p>
                                    </div>
                                </div>
                                <button type="button" id="cancelar-archivo-btn"
                                    class="text-red-400 hover:text-red-300 p-2 hover:bg-red-500/10 rounded-lg transition-all duration-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mt-3 bg-yellow-500/10 rounded-lg p-3">
                                <p class="text-xs text-yellow-300">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Este archivo se subirá cuando guardes el reto
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Estado: Ya hay archivo y se intenta subir otro -->
                    <div id="archivo-existente-warning" class="hidden">
                        <div class="bg-orange-600/10 border border-orange-500/30 rounded-xl p-4">
                            <div class="flex items-start text-orange-300">
                                <i class="fas fa-exclamation-triangle mr-3 mt-1"></i>
                                <div>
                                    <p class="font-medium">Ya tienes un archivo subido</p>
                                    <p class="text-sm mt-1">Este reto ya tiene un archivo. Para subir uno nuevo,
                                        primero elimina el archivo actual.</p>
                                    <div class="mt-3">
                                        <button type="button" id="ir-a-archivo-actual"
                                            class="px-3 py-1 bg-orange-500/20 border border-orange-400/30 rounded-lg text-sm hover:bg-orange-500/30 transition-all duration-300">
                                            Ver archivo actual
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensaje cuando no se permite más archivos -->
                    <div id="limite-archivo" class="hidden">
                        <div class="bg-red-600/10 border border-red-500/30 rounded-xl p-4">
                            <div class="flex items-center text-red-300">
                                <i class="fas fa-ban mr-3"></i>
                                <div>
                                    <p class="font-medium">Límite de archivos alcanzado</p>
                                    <p class="text-sm mt-1">Solo se permite 1 archivo por reto. Elimina el archivo
                                        actual para subir uno nuevo.</p>
                                </div>
                            </div>
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

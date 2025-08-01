<!-- Modal para Crear/Editar Competencia -->
<div id="competencia-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden transition-all duration-300"
    style="z-index: 1000;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-600/50 w-full max-w-2xl transform transition-all duration-300 scale-95 opacity-0"
            id="modal-content">
            <!-- Header del Modal -->
            <div
                class="px-8 py-6 border-b border-slate-600/50 bg-gradient-to-r from-orange-600/10 to-amber-600/10 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-trophy text-orange-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 id="modal-title" class="text-2xl font-bold text-white">
                                {{ isset($competencia) ? 'Editar Competencia' : 'Nueva Competencia' }}
                            </h3>
                            <p class="text-gray-400 text-sm">Complete la información de la competencia</p>
                        </div>
                    </div>
                    <button id="cerrar-modal"
                        class="p-3 bg-slate-700/50 hover:bg-slate-600/50 rounded-xl transition-all duration-300 transform hover:scale-105 group">
                        <i class="fas fa-times text-gray-400 group-hover:text-white transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Formulario -->
            <form id="competencia-form" class="p-8 space-y-6">
                @csrf
                @if (isset($competencia))
                    <input type="hidden" name="competencia_id" value="{{ $competencia->idcompetencia }}">
                    <input type="hidden" id="form-method" value="PUT">
                @else
                    <input type="hidden" id="form-method" value="POST">
                @endif

                <!-- Nombre de la Competencia -->
                <div class="space-y-3">
                    <label for="nombre-competencia" class="text-sm font-bold text-orange-400 flex items-center">
                        <i class="fas fa-trophy mr-2"></i>
                        Nombre de la Competencia
                        <span class="text-red-400 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="nombre-competencia" name="nomcompe"
                            placeholder="Ej. CTF Nacional 2024, Hacking Competition..."
                            value="{{ isset($competencia) ? $competencia->nomcompe : '' }}"
                            class="w-full px-4 py-4 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                            required maxlength="255">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="space-y-3">
                    <label for="descripcion-competencia" class="text-sm font-bold text-orange-400 flex items-center">
                        <i class="fas fa-align-left mr-2"></i>
                        Descripción
                        <span class="text-red-400 ml-1">*</span>
                    </label>
                    <textarea id="descripcion-competencia" name="descripcion" rows="4"
                        placeholder="Describe la competencia, sus objetivos, reglas generales..."
                        class="w-full px-4 py-4 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300 resize-none"
                        required>{{ isset($competencia) ? $competencia->descripcion : '' }}</textarea>
                </div>

                <!-- Fechas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label for="fecha-inicio" class="text-sm font-bold text-orange-400 flex items-center">
                            <i class="fas fa-play text-green-400 mr-2"></i>
                            Fecha de Inicio
                            <span class="text-red-400 ml-1">*</span>
                        </label>
                        <input type="datetime-local" id="fecha-inicio" name="fec_inicio"
                            value="{{ isset($competencia) ? \Carbon\Carbon::parse($competencia->fec_inicio)->format('Y-m-d\TH:i') : '' }}"
                            class="w-full px-4 py-4 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                            required>
                    </div>
                    <div class="space-y-3">
                        <label for="fecha-final" class="text-sm font-bold text-orange-400 flex items-center">
                            <i class="fas fa-stop text-red-400 mr-2"></i>
                            Fecha Final
                            <span class="text-red-400 ml-1">*</span>
                        </label>
                        <input type="datetime-local" id="fecha-final" name="fec_final"
                            value="{{ isset($competencia) ? \Carbon\Carbon::parse($competencia->fec_final)->format('Y-m-d\TH:i') : '' }}"
                            class="w-full px-4 py-4 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                            required>
                    </div>
                </div>

                <!-- Tipo y Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label for="tipo-competencia" class="text-sm font-bold text-orange-400 flex items-center">
                            <i class="fas fa-tag mr-2"></i>
                            Tipo de Competencia
                            <span class="text-red-400 ml-1">*</span>
                        </label>
                        <select id="tipo-competencia" name="fk_tipo_compe"
                            class="w-full px-4 py-4 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                            required>
                            <option value="">Seleccionar tipo...</option>
                            @foreach ($tiposCompetencia as $tipo)
                                <option value="{{ $tipo->idtipo_compe }}"
                                    {{ isset($competencia) && $competencia->fk_tipo_compe == $tipo->idtipo_compe ? 'selected' : '' }}>
                                    {{ $tipo->tipocompe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label for="estado-competencia" class="text-sm font-bold text-orange-400 flex items-center">
                            <i class="fas fa-toggle-on mr-2"></i>
                            Estado
                            <span class="text-red-400 ml-1">*</span>
                        </label>
                        <select id="estado-competencia" name="fk_estado_compe"
                            class="w-full px-4 py-4 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-orange-400 focus:border-transparent transition-all duration-300"
                            required>
                            <option value="">Seleccionar estado...</option>
                            @foreach ($estadosCompetencia as $estado)
                                <option value="{{ $estado->idestado_compe }}"
                                    {{ isset($competencia) && $competencia->fk_estado_compe == $estado->idestado_compe ? 'selected' : '' }}>
                                    {{ $estado->estadocompe }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Información adicional (solo para editar) -->
                @if (isset($competencia))
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/30">
                        <h4 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle text-cyan-400 mr-2"></i>
                            Información Adicional
                        </h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-flag text-purple-400"></i>
                                </div>
                                <div>
                                    <div class="text-gray-400">Retos asociados</div>
                                    <div class="text-white font-medium">{{ $competencia->retos_count ?? 0 }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-green-400"></i>
                                </div>
                                <div>
                                    <div class="text-gray-400">Duración</div>
                                    <div class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($competencia->fec_inicio)->diffInHours(\Carbon\Carbon::parse($competencia->fec_final)) }}
                                        días
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Botones de Acción -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-600/30">
                    <button type="button" id="cancelar-btn"
                        class="px-8 py-4 bg-slate-700/50 hover:bg-slate-600/50 text-gray-300 hover:text-white border border-slate-600 rounded-xl transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit" id="guardar-btn"
                        class="group px-8 py-4 bg-gradient-to-r from-orange-600 to-amber-600 hover:from-orange-500 hover:to-amber-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-orange-500/25 border border-orange-400/30 font-medium min-w-[160px]">
                        <span id="btn-text">
                            <i class="fas fa-save mr-2 group-hover:rotate-12 transition-transform"></i>
                            {{ isset($competencia) ? 'Actualizar' : 'Crear Competencia' }}
                        </span>
                        <span id="btn-loading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Guardando...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

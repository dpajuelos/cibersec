<!-- Modal para Crear/Editar Categoría -->
<div id="categoria-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden transition-all duration-300"
    style="z-index: 1000;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-600/50 w-full max-w-lg transform transition-all duration-300 scale-95 opacity-0"
            id="modal-content">
            <!-- Header del Modal -->
            <div
                class="px-8 py-6 border-b border-slate-600/50 bg-gradient-to-r from-indigo-600/10 to-purple-600/10 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-layer-group text-indigo-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 id="modal-title" class="text-2xl font-bold text-white">Nueva Categoría</h3>
                            <p class="text-gray-400 text-sm">Complete la información de la categoría</p>
                        </div>
                    </div>
                    <button id="cerrar-modal"
                        class="p-3 bg-slate-700/50 hover:bg-slate-600/50 rounded-xl transition-all duration-300 transform hover:scale-105 group">
                        <i class="fas fa-times text-gray-400 group-hover:text-white transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Formulario -->
            <form id="categoria-form" class="p-8 space-y-6">
                @csrf
                <input type="hidden" id="categoria-id" name="categoria_id">
                <input type="hidden" id="form-method" value="POST">

                <!-- Nombre de la Categoría -->
                <div class="space-y-3">
                    <label for="nombre-categoria" class="text-sm font-bold text-indigo-400 flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        Nombre de la Categoría
                        <span class="text-red-400 ml-1">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="nombre-categoria" name="nomcategoria"
                            placeholder="Ej. Criptografía, Web Security, Forense..."
                            class="w-full px-4 py-4 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300"
                            required maxlength="100">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-folder text-gray-400"></i>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500">Máximo 100 caracteres</div>
                </div>

                <!-- Información adicional (solo para editar) -->
                <div id="info-adicional" class="hidden">
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/30">
                        <h4 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle text-cyan-400 mr-2"></i>
                            Información Adicional
                        </h4>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-flag text-purple-400"></i>
                            </div>
                            <div>
                                <div class="text-gray-400">Retos asociados</div>
                                <div id="retos-asociados" class="text-white font-medium">0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-600/30">
                    <button type="button" id="cancelar-btn"
                        class="px-8 py-4 bg-slate-700/50 hover:bg-slate-600/50 text-gray-300 hover:text-white border border-slate-600 rounded-xl transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="submit" id="guardar-btn"
                        class="group px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-indigo-500/25 border border-indigo-400/30 font-medium min-w-[140px]">
                        <span id="btn-text">
                            <i class="fas fa-save mr-2 group-hover:rotate-12 transition-transform"></i>
                            Crear Categoría
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

<!-- Modal de Confirmación para Eliminar -->
<div id="confirmar-eliminar-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden transition-all duration-300"
    style="z-index: 1000;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-red-500/30 w-full max-w-md transform transition-all duration-300 scale-95 opacity-0"
            id="eliminar-modal-content">
            <!-- Header del Modal -->
            <div
                class="px-6 py-6 border-b border-slate-600/50 bg-gradient-to-r from-red-600/10 to-pink-600/10 rounded-t-3xl">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-red-500/20 to-pink-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Confirmar Eliminación</h3>
                        <p class="text-gray-400 text-sm">Esta acción no se puede deshacer</p>
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <div class="mb-6">
                    <p class="text-gray-300 mb-4">
                        ¿Estás seguro de que deseas eliminar la categoría
                        <span id="categoria-a-eliminar" class="font-bold text-white"></span>?
                    </p>
                    <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                        <div class="flex items-center space-x-2 text-red-300 text-sm">
                            <i class="fas fa-info-circle"></i>
                            <span>Solo se pueden eliminar categorías sin retos asociados.</span>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-4">
                    <button type="button" id="cancelar-eliminar"
                        class="px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-gray-300 hover:text-white border border-slate-600 rounded-xl transition-all duration-300 font-medium">
                        <i class="fas fa-times mr-2"></i>
                        Cancelar
                    </button>
                    <button type="button" id="confirmar-eliminar"
                        class="group px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-500 hover:to-pink-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-red-500/25 border border-red-400/30 font-medium">
                        <i class="fas fa-trash mr-2 group-hover:rotate-12 transition-transform"></i>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast de Notificaciones con z-index alto -->
<div id="toast-container" class="fixed top-4 right-4 space-y-4" style="z-index: 9999;">
    <!-- Los toasts se generarán dinámicamente aquí -->
</div>

<style>
    /* Animaciones personalizadas */
    .modal-enter {
        animation: modalEnter 0.3s ease-out forwards;
    }

    .modal-leave {
        animation: modalLeave 0.3s ease-in forwards;
    }

    @keyframes modalEnter {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes modalLeave {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        to {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
    }

    /* Efecto de glow en focus */
    #categoria-form input:focus,
    #categoria-form textarea:focus,
    #categoria-form select:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1), 0 0 20px rgba(99, 102, 241, 0.3);
    }

    /* Contador de caracteres */
    #descripcion-contador {
        transition: color 0.3s ease;
    }

    #descripcion-contador.warning {
        color: #f59e0b;
    }

    #descripcion-contador.danger {
        color: #ef4444;
    }
</style>

<!-- Modal de Usuario -->
<div id="usuario-modal"
    class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div
        class="bg-slate-800/90 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-600/50 w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <!-- Header del Modal -->
        <div class="px-8 py-6 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border-b border-slate-600/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500/30 to-cyan-500/30 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 id="modal-title" class="text-2xl font-bold text-white">Detalles del Usuario</h3>
                        <p class="text-gray-400 text-sm">Información completa del usuario</p>
                    </div>
                </div>
                <button id="cerrar-modal"
                    class="text-gray-400 hover:text-white transition-colors duration-200 p-2 rounded-xl hover:bg-slate-700/50">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Contenido del Modal -->
        <div class="p-8 overflow-y-auto max-h-[calc(90vh-120px)]">
            <div id="modal-content">
                <!-- Loading State -->
                <div id="loading-state" class="flex items-center justify-center py-12">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-16 h-16 border-4 border-blue-500/30 border-t-blue-500 rounded-full animate-spin">
                        </div>
                        <p class="text-gray-400">Cargando información del usuario...</p>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div id="usuario-details" class="hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Información básica -->
                        <div class="lg:col-span-1">
                            <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                                <h4 class="text-lg font-bold text-white mb-6 flex items-center">
                                    <i class="fas fa-id-card mr-3 text-cyan-400"></i>
                                    Información Básica
                                </h4>

                                <!-- Avatar -->
                                <div class="text-center mb-6">
                                    <div id="user-avatar"
                                        class="w-24 h-24 mx-auto mb-4 rounded-xl overflow-hidden border-4 border-blue-400/30">
                                        <!-- Se llenará dinámicamente -->
                                    </div>
                                    <h5 id="user-username" class="text-xl font-bold text-white mb-1"></h5>
                                    <p id="user-email" class="text-gray-400 text-sm"></p>
                                </div>

                                <!-- Estado y ID -->
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400 text-sm">ID Usuario:</span>
                                        <span id="user-id" class="text-blue-400 font-medium"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400 text-sm">Estado:</span>
                                        <span id="user-status"
                                            class="px-3 py-1 rounded-full text-xs font-medium"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400 text-sm">Registro:</span>
                                        <span id="user-register-date" class="text-cyan-400 font-medium text-sm"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información del perfil -->
                        <div class="lg:col-span-2">
                            <div class="space-y-6">
                                <!-- Datos Personales -->
                                <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                                    <h4 class="text-lg font-bold text-white mb-6 flex items-center">
                                        <i class="fas fa-user mr-3 text-emerald-400"></i>
                                        Datos Personales
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">DNI</label>
                                            <div id="user-dni"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Nombres</label>
                                            <div id="user-names"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Apellido
                                                Paterno</label>
                                            <div id="user-paterno"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Apellido
                                                Materno</label>
                                            <div id="user-materno"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Género</label>
                                            <div id="user-gender"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Celular</label>
                                            <div id="user-phone"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Fecha de
                                                Nacimiento</label>
                                            <div id="user-birthdate"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Información Académica -->
                                <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                                    <h4 class="text-lg font-bold text-white mb-6 flex items-center">
                                        <i class="fas fa-graduation-cap mr-3 text-amber-400"></i>
                                        Información Académica
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-400 mb-2">Universidad</label>
                                            <div id="user-university"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Nivel</label>
                                            <div id="user-level"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-sm font-medium text-gray-400 mb-2">Biografía</label>
                                            <div id="user-bio"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30 min-h-[100px]">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-400 mb-2">Link
                                                Personal</label>
                                            <div id="user-link"
                                                class="text-white font-medium bg-slate-600/30 px-4 py-3 rounded-xl border border-slate-500/30">
                                                <!-- Se llenará dinámicamente -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Roles -->
                                <div class="bg-slate-700/30 rounded-2xl p-6 border border-slate-600/30">
                                    <h4 class="text-lg font-bold text-white mb-6 flex items-center">
                                        <i class="fas fa-shield-alt mr-3 text-blue-400"></i>
                                        Roles Asignados
                                    </h4>
                                    <div id="user-roles" class="flex flex-wrap gap-3">
                                        <!-- Se llenará dinámicamente -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estado de error -->
                <div id="error-state" class="hidden text-center py-12">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-16 h-16 bg-red-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">Error al cargar</h3>
                            <p class="text-gray-400">No se pudo cargar la información del usuario.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer del Modal -->
        <div class="px-8 py-4 bg-slate-700/30 border-t border-slate-600/50 flex justify-end space-x-4">
            <button id="btn-cerrar"
                class="px-6 py-3 bg-gradient-to-r from-slate-600 to-gray-600 hover:from-slate-500 hover:to-gray-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 font-medium">
                <i class="fas fa-times mr-2"></i>
                Cerrar
            </button>
        </div>
    </div>
</div>

<!-- Efectos de partículas para el modal -->
<div id="modal-particles" class="fixed inset-0 pointer-events-none overflow-hidden z-40 hidden">
    <div class="absolute top-1/4 left-1/6 w-1.5 h-1.5 bg-blue-400 rounded-full opacity-20 animate-ping"></div>
    <div class="absolute top-3/4 right-1/5 w-1 h-1 bg-cyan-400 rounded-full opacity-30 animate-pulse"></div>
    <div class="absolute top-1/2 left-3/4 w-1.5 h-1.5 bg-emerald-400 rounded-full opacity-15 animate-ping delay-1000">
    </div>
    <div class="absolute bottom-1/4 left-1/2 w-1 h-1 bg-blue-300 rounded-full opacity-25 animate-pulse delay-500">
    </div>
</div>

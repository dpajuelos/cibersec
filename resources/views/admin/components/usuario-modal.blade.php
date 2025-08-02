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
<!-- Modal Crear/Editar Usuario -->
<div id="modal-crear-usuario" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-slate-900 rounded-xl shadow-xl w-full max-w-4xl p-8 text-white">
        <h2 id="modal-usuario-titulo" class="text-2xl font-bold mb-6">Crear Usuario</h2>
        <form id="form-usuario" class="grid lg:grid-cols-2 sm:grid-cols-1 gap-6">
            <input type="hidden" id="usuario-id">

            <!-- Nombres -->
            <div>
                <label for="name" class="block text-sm font-medium mb-2">Nombres</label>
                <div class="relative">
                    <input id="name" name="name" type="text" required placeholder="Ingrese sus nombres"
                        class="w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-blue-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-user text-blue-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Usuario -->
            <div>
                <label for="usuario" class="block text-sm font-medium mb-2">Usuario</label>
                <div class="relative">
                    <input id="usuario" name="usuario" type="text" required placeholder="Nombre de usuario"
                        class="w-full bg-slate-800/60 border-2 border-indigo-500/30 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-indigo-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-user-circle text-indigo-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Apellido Paterno -->
            <div>
                <label for="paterno" class="block text-sm font-medium mb-2">Apellido Paterno</label>
                <div class="relative">
                    <input id="paterno" name="paterno" type="text" required placeholder="Apellido paterno"
                        class="w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-blue-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-user-tag text-blue-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Apellido Materno -->
            <div>
                <label for="materno" class="block text-sm font-medium mb-2">Apellido Materno</label>
                <div class="relative">
                    <input id="materno" name="materno" type="text" required placeholder="Apellido materno"
                        class="w-full bg-slate-800/60 border-2 border-indigo-500/30 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-indigo-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-user-tag text-indigo-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- DNI -->
            <div>
                <label for="dni" class="block text-sm font-medium mb-2">DNI</label>
                <div class="relative">
                    <input id="dni" name="dni" type="text" maxlength="8" required placeholder="Ingrese el DNI"
                        class="w-full bg-slate-800/60 border-2 border-purple-500/30 focus:border-purple-400 focus:ring focus:ring-purple-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-purple-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-fingerprint text-purple-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Fecha de nacimiento -->
            <div>
                <label for="fecnac" class="block text-sm font-medium mb-2">Fecha de nacimiento</label>
                <input id="fecnac" name="fecnac" type="date" required
                    class="w-full bg-slate-800/60 border-2 border-teal-500/30 focus:border-teal-400 focus:ring focus:ring-teal-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-teal-400/50">
            </div>

            <!-- Celular -->
            <div>
                <label for="celular" class="block text-sm font-medium mb-2">Celular</label>
                <div class="relative">
                    <input id="celular" name="celular" type="text" maxlength="9" required placeholder="Número de celular"
                        class="w-full bg-slate-800/60 border-2 border-green-500/30 focus:border-green-400 focus:ring focus:ring-green-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm pl-12 transition-all duration-300 hover:border-green-400/50">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <i class="fas fa-phone text-green-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Género -->
            <div>
                <label for="genero" class="block text-sm font-medium mb-2">Género</label>
                <select id="genero" name="genero" required
                    class="w-full bg-slate-800/60 border-2 border-pink-500/30 focus:border-pink-400 focus:ring focus:ring-pink-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-pink-400/50">
                    <option value="">Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            <!-- Universidad -->
            <div>
                <label for="universidad" class="block text-sm font-medium mb-2">Universidad</label>
                <select id="universidad" name="universidad" required
                    class="w-full bg-slate-800/60 border-2 border-yellow-500/30 focus:border-yellow-400 focus:ring focus:ring-yellow-400/20 text-white rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-yellow-400/50">
                    <!-- Opciones dinámicas -->
                </select>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-2">Correo</label>
                <input id="email" name="email" type="email" required placeholder="ejemplo@correo.com"
                    class="w-full bg-slate-800/60 border-2 border-rose-500/30 focus:border-rose-400 focus:ring focus:ring-rose-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-rose-400/50">
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium mb-2">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="w-full bg-slate-800/60 border-2 border-orange-500/30 focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-white rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-orange-400/50">
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirmar Contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full bg-slate-800/60 border-2 border-orange-500/30 focus:border-orange-400 focus:ring focus:ring-orange-400/20 text-white rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-orange-400/50">
            </div>

            <!-- Rol -->
            <div class="col-span-2">
                <label for="rol" class="block text-sm font-medium mb-2">Rol</label>
                <select id="rol" name="rol" required
                    class="w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring focus:ring-cyan-400/20 text-white rounded-xl backdrop-blur-sm px-4 py-2 transition-all duration-300 hover:border-cyan-400/50">
                    <option value="">Seleccione un rol</option>
                    <!-- Opciones dinámicas -->
                </select>
            </div>

            <!-- Botones -->
            <div class="col-span-2 flex justify-end gap-4 mt-6">
                <button type="button" id="btn-cancelar-usuario"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-xl transition-all">Cancelar</button>
                <button id="btnSubmit" type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition-all">Guardar</button>
            </div>
        </form>
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

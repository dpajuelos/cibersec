class CompetenciasManager {
    constructor() {
        this.modal = null;
        this.modalContent = null;
        this.modalEliminar = null;
        this.modalEliminarContent = null;
        this.form = null;
        this.currentCompetenciaId = null;
        this.isEditing = false;

        this.initializeElements();
        this.attachEventListeners();
        this.loadInitialData();
    }

    initializeElements() {
        // Elementos principales
        this.crearBtn = document.getElementById('crear-competencia-btn');
        this.buscarInput = document.getElementById('buscar-competencia');
        this.filtroEstado = document.getElementById('filtro-estado');
        this.filtroTipo = document.getElementById('filtro-tipo');
        this.limpiarFiltrosBtn = document.getElementById('limpiar-filtros');
        this.tablaCompetencias = document.getElementById('tabla-competencias');

        // Crear contenedor de toasts si no existe
        if (!document.getElementById('toast-container')) {
            const toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'fixed top-4 right-4 space-y-4';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }
    }

    attachEventListeners() {
        // Botón crear competencia
        if (this.crearBtn) {
            this.crearBtn.addEventListener('click', () => this.abrirModalCrear());
        }

        // Filtros y búsqueda
        if (this.buscarInput) {
            this.buscarInput.addEventListener('input', debounce(() => this.filtrarCompetencias(), 300));
        }

        if (this.filtroEstado) {
            this.filtroEstado.addEventListener('change', () => this.filtrarCompetencias());
        }

        if (this.filtroTipo) {
            this.filtroTipo.addEventListener('change', () => this.filtrarCompetencias());
        }

        if (this.limpiarFiltrosBtn) {
            this.limpiarFiltrosBtn.addEventListener('click', () => this.limpiarFiltros());
        }

        // Event delegation para botones de acción en la tabla
        if (this.tablaCompetencias) {
            this.tablaCompetencias.addEventListener('click', (e) => {
                const button = e.target.closest('button[data-action]');
                if (button) {
                    const action = button.dataset.action;
                    const competenciaId = button.dataset.id;
                    this.handleTableAction(action, competenciaId, button);
                }
            });
        }
    }

    loadInitialData() {
        // Cargar datos iniciales si es necesario
        console.log('CompetenciasManager inicialized');
    }

    async abrirModalCrear() {
        try {
            this.isEditing = false;
            this.currentCompetenciaId = null;

            const response = await fetch('/admin/competencias/create');
            const data = await response.json();

            if (data.html) {
                this.crearModal(data.html);
                this.configurarModal('crear');
            }
        } catch (error) {
            console.error('Error al abrir modal de crear:', error);
            this.showToast('Error al cargar el formulario', 'error');
        }
    }

    async abrirModalEditar(competenciaId) {
        try {
            this.isEditing = true;
            this.currentCompetenciaId = competenciaId;

            const response = await fetch(`/admin/competencias/${competenciaId}/edit`);
            const data = await response.json();

            if (data.html) {
                this.crearModal(data.html);
                this.configurarModal('editar');
            }
        } catch (error) {
            console.error('Error al abrir modal de editar:', error);
            this.showToast('Error al cargar el formulario de edición', 'error');
        }
    }

    crearModal(html) {
        // Eliminar modal existente si hay uno
        const existingModal = document.getElementById('competencia-modal');
        if (existingModal) {
            existingModal.remove();
        }

        // Crear nuevo modal
        const modalWrapper = document.createElement('div');
        modalWrapper.innerHTML = html;
        document.body.appendChild(modalWrapper.firstElementChild);

        // Inicializar elementos del modal
        this.modal = document.getElementById('competencia-modal');
        this.modalContent = document.getElementById('modal-content');
        this.form = document.getElementById('competencia-form');
    }

    configurarModal(modo) {
        if (!this.modal || !this.form) return;

        // Mostrar modal con animación
        this.modal.classList.remove('hidden');
        setTimeout(() => {
            this.modalContent.classList.remove('scale-95', 'opacity-0');
            this.modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        // Event listeners del modal
        this.attachModalEventListeners();

        // Configurar campos de fecha
        this.configurarCamposFecha();

        // Focus en primer campo
        const primerCampo = this.form.querySelector('input[name="nomcompe"]');
        if (primerCampo) {
            setTimeout(() => primerCampo.focus(), 300);
        }
    }

    attachModalEventListeners() {
        // Cerrar modal
        const cerrarBtn = document.getElementById('cerrar-modal');
        const cancelarBtn = document.getElementById('cancelar-btn');

        if (cerrarBtn) {
            cerrarBtn.addEventListener('click', () => this.cerrarModal());
        }

        if (cancelarBtn) {
            cancelarBtn.addEventListener('click', () => this.cerrarModal());
        }

        // Click fuera del modal
        if (this.modal) {
            this.modal.addEventListener('click', (e) => {
                if (e.target === this.modal) {
                    this.cerrarModal();
                }
            });
        }

        // Envío del formulario
        if (this.form) {
            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitForm();
            });
        }

        // Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal && !this.modal.classList.contains('hidden')) {
                this.cerrarModal();
            }
        });
    }

    configurarCamposFecha() {
        const fechaInicio = this.form.querySelector('input[name="fec_inicio"]');
        const fechaFinal = this.form.querySelector('input[name="fec_final"]');

        if (fechaInicio && fechaFinal) {
            // Configurar fecha mínima (ahora + 1 hora)
            const ahora = new Date();
            ahora.setHours(ahora.getHours() + 1);
            const minDateTime = ahora.toISOString().slice(0, 16);

            if (!this.isEditing) {
                fechaInicio.min = minDateTime;
            }

            // Actualizar fecha final cuando cambie la fecha de inicio
            fechaInicio.addEventListener('change', () => {
                if (fechaInicio.value) {
                    const fechaInicioDate = new Date(fechaInicio.value);
                    fechaInicioDate.setHours(fechaInicioDate.getHours() + 1);
                    fechaFinal.min = fechaInicioDate.toISOString().slice(0, 16);

                    if (fechaFinal.value && fechaFinal.value <= fechaInicio.value) {
                        fechaFinal.value = '';
                    }
                }
            });
        }
    }

    cerrarModal() {
        if (!this.modal) return;

        this.modalContent.classList.remove('scale-100', 'opacity-100');
        this.modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            this.modal.classList.add('hidden');
            this.modal.remove();
            this.modal = null;
            this.modalContent = null;
            this.form = null;
        }, 300);
    }

    async submitForm() {
        const submitBtn = document.getElementById('guardar-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (!submitBtn || !this.form) return;

        // Mostrar loading
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoading.classList.remove('hidden');

        try {
            const formData = new FormData(this.form);
            const url = this.isEditing
                ? `/admin/competencias/${this.currentCompetenciaId}`
                : '/admin/competencias';

            const method = this.isEditing ? 'PUT' : 'POST';

            // Convertir FormData a objeto para métodos PUT
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                        document.querySelector('input[name="_token"]')?.value
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();

            if (responseData.success) {
                this.showToast(responseData.message, 'success');
                this.cerrarModal();
                this.recargarTabla();
            } else {
                // Manejar errores de validación
                if (responseData.errors) {
                    this.mostrarErroresValidacion(responseData.errors);
                } else {
                    this.showToast(responseData.message || 'Error al procesar la solicitud', 'error');
                }
            }
        } catch (error) {
            console.error('Error en submitForm:', error);
            this.showToast('Error de conexión. Por favor, intente nuevamente.', 'error');
        } finally {
            // Ocultar loading
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
        }
    }

    mostrarErroresValidacion(errors) {
        // Limpiar errores anteriores
        this.form.querySelectorAll('.error-message').forEach(el => el.remove());
        this.form.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
            el.classList.add('border-slate-600');
        });

        // Mostrar nuevos errores
        Object.keys(errors).forEach(field => {
            const input = this.form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.remove('border-slate-600');
                input.classList.add('border-red-500');

                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-red-400 text-sm mt-1';
                errorDiv.textContent = errors[field][0];
                input.parentNode.appendChild(errorDiv);
            }
        });

        // Hacer scroll al primer error
        const firstError = this.form.querySelector('.border-red-500');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    handleTableAction(action, competenciaId, button) {
        switch (action) {
            case 'ver':
                this.verDetalles(competenciaId);
                break;
            case 'editar':
                this.abrirModalEditar(competenciaId);
                break;
            case 'retos':
                this.gestionarRetos(competenciaId);
                break;
            case 'eliminar':
                if (!button.disabled) {
                    this.confirmarEliminar(competenciaId, button);
                }
                break;
            case 'activar':
                this.activarCompetencia(competenciaId);
                break;
            case 'finalizar':
                this.finalizarCompetencia(competenciaId);
                break;
        }
    }

    async verDetalles(competenciaId) {
        try {
            const response = await fetch(`/admin/competencias/${competenciaId}`);
            const data = await response.json();

            if (data.success && data.competencia) {
                this.mostrarModalDetalles(data.competencia);
            } else {
                this.showToast('Error al cargar los detalles', 'error');
            }
        } catch (error) {
            console.error('Error al ver detalles:', error);
            this.showToast('Error de conexión', 'error');
        }
    }

    mostrarModalDetalles(competencia) {
        const modalHtml = `
            <div id="detalles-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-all duration-300" style="z-index: 1000;">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-600/50 w-full max-w-2xl transform transition-all duration-300">
                        <!-- Header -->
                        <div class="px-8 py-6 border-b border-slate-600/50 bg-gradient-to-r from-orange-600/10 to-amber-600/10 rounded-t-3xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-trophy text-orange-400 text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-white">${competencia.nomcompe}</h3>
                                        <p class="text-gray-400 text-sm">Detalles de la competencia</p>
                                    </div>
                                </div>
                                <button id="cerrar-detalles" class="p-3 bg-slate-700/50 hover:bg-slate-600/50 rounded-xl transition-all duration-300 transform hover:scale-105 group">
                                    <i class="fas fa-times text-gray-400 group-hover:text-white transition-colors"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-slate-700/30 rounded-xl p-4">
                                    <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                        <i class="fas fa-tag mr-2"></i>Tipo
                                    </h4>
                                    <p class="text-white">${competencia.tipo.tipocompe}</p>
                                </div>
                                <div class="bg-slate-700/30 rounded-xl p-4">
                                    <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                        <i class="fas fa-toggle-on mr-2"></i>Estado
                                    </h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-400/30">
                                        ${competencia.estado.estadocompe}
                                    </span>
                                </div>
                            </div>

                            <div class="bg-slate-700/30 rounded-xl p-4">
                                <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                    <i class="fas fa-align-left mr-2"></i>Descripción
                                </h4>
                                <p class="text-gray-300 leading-relaxed">${competencia.descripcion}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-slate-700/30 rounded-xl p-4">
                                    <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                        <i class="fas fa-play text-green-400 mr-2"></i>Fecha de Inicio
                                    </h4>
                                    <p class="text-white">${new Date(competencia.fec_inicio).toLocaleString('es-ES')}</p>
                                </div>
                                <div class="bg-slate-700/30 rounded-xl p-4">
                                    <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                        <i class="fas fa-stop text-red-400 mr-2"></i>Fecha Final
                                    </h4>
                                    <p class="text-white">${new Date(competencia.fec_final).toLocaleString('es-ES')}</p>
                                </div>
                            </div>

                            <div class="bg-slate-700/30 rounded-xl p-4">
                                <h4 class="text-orange-400 font-semibold mb-2 flex items-center">
                                    <i class="fas fa-flag mr-2"></i>Retos Asociados
                                </h4>
                                <div class="text-2xl font-bold text-cyan-400">${competencia.retos?.length || 0} retos</div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-8 py-6 border-t border-slate-600/50 flex justify-end">
                            <button id="cerrar-detalles-btn" class="px-6 py-3 bg-gradient-to-r from-slate-600 to-gray-600 hover:from-slate-500 hover:to-gray-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 font-medium">
                                <i class="fas fa-times mr-2"></i>Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modal = document.getElementById('detalles-modal');
        const cerrarBtns = modal.querySelectorAll('#cerrar-detalles, #cerrar-detalles-btn');

        cerrarBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                modal.remove();
            });
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }

    gestionarRetos(competenciaId) {
        // Redirigir a la página de gestión de retos de la competencia
        window.location.href = `/admin/challenges?competencia=${competenciaId}`;
    }

    confirmarEliminar(competenciaId, button) {
        const row = button.closest('tr');
        const nombreCompetencia = row.querySelector('.competencia-nombre').textContent.trim();

        const modalHtml = `
            <div id="eliminar-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-all duration-300" style="z-index: 1000;">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-red-500/30 w-full max-w-md transform transition-all duration-300">
                        <div class="px-6 py-6 border-b border-slate-600/50 bg-gradient-to-r from-red-600/10 to-pink-600/10 rounded-t-3xl">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-500/20 to-pink-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Confirmar Eliminación</h3>
                                    <p class="text-gray-400 text-sm">Esta acción no se puede deshacer</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-300 mb-4">
                                ¿Estás seguro de que deseas eliminar la competencia 
                                <span class="font-bold text-white">${nombreCompetencia}</span>?
                            </p>
                            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                                <div class="flex items-center space-x-2 text-red-300 text-sm">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Solo se pueden eliminar competencias sin retos asociados y que no estén activas.</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-end space-x-4">
                                <button id="cancelar-eliminar" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-gray-300 hover:text-white border border-slate-600 rounded-xl transition-all duration-300 font-medium">
                                    <i class="fas fa-times mr-2"></i>Cancelar
                                </button>
                                <button id="confirmar-eliminar" class="group px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-500 hover:to-pink-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-red-500/25 border border-red-400/30 font-medium">
                                    <i class="fas fa-trash mr-2 group-hover:rotate-12 transition-transform"></i>Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modal = document.getElementById('eliminar-modal');
        const cancelarBtn = document.getElementById('cancelar-eliminar');
        const confirmarBtn = document.getElementById('confirmar-eliminar');

        cancelarBtn.addEventListener('click', () => modal.remove());
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.remove();
        });

        confirmarBtn.addEventListener('click', () => {
            this.eliminarCompetencia(competenciaId);
            modal.remove();
        });
    }

    async eliminarCompetencia(competenciaId) {
        try {
            const response = await fetch(`/admin/competencias/${competenciaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                this.showToast(data.message, 'success');
                this.recargarTabla();
            } else {
                this.showToast(data.message || 'Error al eliminar la competencia', 'error');
            }
        } catch (error) {
            console.error('Error al eliminar competencia:', error);
            this.showToast('Error de conexión', 'error');
        }
    }

    async activarCompetencia(competenciaId) {
        try {
            const response = await fetch(`/admin/competencias/${competenciaId}/activate`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                this.showToast(data.message, 'success');
                this.recargarTabla();
            } else {
                this.showToast(data.message || 'Error al activar la competencia', 'error');
            }
        } catch (error) {
            console.error('Error al activar competencia:', error);
            this.showToast('Error de conexión', 'error');
        }
    }

    async finalizarCompetencia(competenciaId) {
        try {
            const response = await fetch(`/admin/competencias/${competenciaId}/finalize`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                this.showToast(data.message, 'success');
                this.recargarTabla();
            } else {
                this.showToast(data.message || 'Error al finalizar la competencia', 'error');
            }
        } catch (error) {
            console.error('Error al finalizar competencia:', error);
            this.showToast('Error de conexión', 'error');
        }
    }

    async filtrarCompetencias() {
        const search = this.buscarInput?.value || '';
        const estado = this.filtroEstado?.value || '';
        const tipo = this.filtroTipo?.value || '';

        try {
            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (estado) params.append('estado', estado);
            if (tipo) params.append('tipo', tipo);

            const response = await fetch(`/admin/competencias-filter?${params.toString()}`);
            const data = await response.json();

            if (data.success && data.competencias) {
                this.actualizarTabla(data.competencias);
            }
        } catch (error) {
            console.error('Error al filtrar:', error);
            this.showToast('Error al filtrar competencias', 'error');
        }
    }

    limpiarFiltros() {
        if (this.buscarInput) this.buscarInput.value = '';
        if (this.filtroEstado) this.filtroEstado.value = '';
        if (this.filtroTipo) this.filtroTipo.value = '';
        this.filtrarCompetencias();
    }

    async recargarTabla() {
        try {
            const response = await fetch('/admin/competencias');
            const html = await response.text();

            // Extraer solo la tabla del HTML completo
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const nuevaTabla = doc.querySelector('#tabla-competencias');

            if (nuevaTabla && this.tablaCompetencias) {
                this.tablaCompetencias.innerHTML = nuevaTabla.innerHTML;
            }

            // También actualizar las estadísticas si es necesario
            this.actualizarEstadisticas();
        } catch (error) {
            console.error('Error al recargar tabla:', error);
        }
    }

    async actualizarEstadisticas() {
        // Implementar actualización de estadísticas si es necesario
        // Por ahora, recargar la página podría ser una opción
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }

    // Nuevo método para actualizar la tabla
    actualizarTabla(competencias) {
        const tbody = this.tablaCompetencias;

        if (!tbody) return;

        if (competencias.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-trophy text-gray-400 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white mb-2">No hay competencias</h3>
                                <p class="text-gray-400 text-sm">
                                    ${this.buscarInput?.value ? 'No se encontraron resultados para tu búsqueda.' : 'Aún no has creado ninguna competencia.'}
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        } else {
            tbody.innerHTML = competencias.map(competencia => this.generarFilaCompetencia(competencia)).join('');
        }
    }

    // Método para generar una fila de competencia
    generarFilaCompetencia(competencia) {
        const estadoColors = {
            'Activa': 'from-green-500/20 to-emerald-500/20 text-green-300 border-green-400/30',
            'Programada': 'from-blue-500/20 to-cyan-500/20 text-blue-300 border-blue-400/30',
            'Finalizada': 'from-gray-500/20 to-slate-500/20 text-gray-300 border-gray-400/30',
            'Cancelada': 'from-red-500/20 to-pink-500/20 text-red-300 border-red-400/30'
        };

        const colorClass = estadoColors[competencia.estado.estadocompe] || 'from-gray-500/20 to-slate-500/20 text-gray-300 border-gray-400/30';

        const fechaInicio = new Date(competencia.fec_inicio);
        const fechaFinal = new Date(competencia.fec_final);
        const duracion = Math.ceil((fechaFinal - fechaInicio) / (1000 * 60 * 60 * 24));

        return `
            <tr class="hover:bg-slate-700/30 transition-colors duration-200 competencia-row">
                <td class="px-6 py-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-trophy text-orange-400 text-lg"></i>
                        </div>
                        <div>
                            <div class="text-lg font-bold text-white competencia-nombre">
                                ${competencia.nomcompe}
                            </div>
                            <div class="text-sm text-gray-400 max-w-xs">
                                ${competencia.descripcion.length > 60 ? competencia.descripcion.substring(0, 60) + '...' : competencia.descripcion}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-amber-500/20 to-yellow-500/20 text-amber-300 border border-amber-400/30">
                        <i class="fas fa-tag mr-2"></i>
                        ${competencia.tipo.tipocompe}
                    </span>
                </td>
                <td class="px-6 py-6">
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-play text-green-400 mr-2"></i>
                            <span class="font-medium">Inicio:</span>
                            <span class="ml-1">${fechaInicio.toLocaleDateString('es-ES')} ${fechaInicio.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' })}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-300">
                            <i class="fas fa-stop text-red-400 mr-2"></i>
                            <span class="font-medium">Fin:</span>
                            <span class="ml-1">${fechaFinal.toLocaleDateString('es-ES')} ${fechaFinal.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' })}</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            Duración: ${duracion} días
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r ${colorClass}">
                        <div class="w-2 h-2 rounded-full mr-2 ${competencia.estado.estadocompe === 'Activa' ? 'bg-green-400 animate-pulse' : competencia.estado.estadocompe === 'Programada' ? 'bg-blue-400' : competencia.estado.estadocompe === 'Finalizada' ? 'bg-gray-400' : 'bg-red-400'}"></div>
                        ${competencia.estado.estadocompe}
                    </span>
                </td>
                <td class="px-6 py-6">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-flag text-cyan-400 text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold text-cyan-400">${competencia.retos_count || 0}</span>
                            <span class="text-xs text-gray-500">
                                ${competencia.retos_count === 1 ? 'reto' : 'retos'}
                            </span>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <div class="flex space-x-3">
                        <button data-action="ver" data-id="${competencia.idcompetencia}"
                            class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                            title="Ver detalles">
                            <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                        </button>
                        <button data-action="editar" data-id="${competencia.idcompetencia}"
                            class="group p-3 bg-gradient-to-r from-amber-500/20 to-orange-500/20 hover:from-amber-500/30 hover:to-orange-500/30 text-amber-300 border border-amber-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                            title="Editar competencia">
                            <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                        </button>
                        <button data-action="retos" data-id="${competencia.idcompetencia}"
                            class="group p-3 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 text-purple-300 border border-purple-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                            title="Gestionar retos">
                            <i class="fas fa-flag group-hover:rotate-12 transition-transform"></i>
                        </button>
                        <button data-action="eliminar" data-id="${competencia.idcompetencia}"
                            class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105 ${competencia.retos_count > 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                            title="${competencia.retos_count > 0 ? 'No se puede eliminar: tiene retos asociados' : 'Eliminar competencia'}"
                            ${competencia.retos_count > 0 ? 'disabled' : ''}>
                            <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }

    showToast(message, type = 'info', duration = 4000) {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        const toastId = `toast-${Date.now()}`;
        toast.id = toastId;

        const bgColors = {
            success: 'from-green-600 to-emerald-600 border-green-400/30',
            error: 'from-red-600 to-pink-600 border-red-400/30',
            warning: 'from-yellow-600 to-orange-600 border-yellow-400/30',
            info: 'from-blue-600 to-cyan-600 border-blue-400/30'
        };

        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };

        toast.className = `
            transform transition-all duration-300 translate-x-full opacity-0
            bg-gradient-to-r ${bgColors[type]} 
            border backdrop-blur-md rounded-2xl shadow-2xl
            p-4 max-w-sm w-full
        `;

        toast.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <i class="fas ${icons[type]} text-white text-lg"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-medium leading-relaxed">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="flex-shrink-0 text-white/70 hover:text-white transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        `;

        toastContainer.appendChild(toast);

        // Animación de entrada
        setTimeout(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
        }, 100);

        // Auto-remove
        setTimeout(() => {
            if (document.getElementById(toastId)) {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }
        }, duration);
    }
}

// Función helper para debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new CompetenciasManager();
});
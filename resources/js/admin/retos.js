class RetoManager {
    constructor() {
        this.pistasCounter = 0;
        this.isEditing = false;
        this.archivoActualId = null;
        this.tieneArchivo = false;

        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.initializeEventListeners();
            this.createConfirmModal();
        });
    }

    // Crear el modal de confirmación personalizado 
    createConfirmModal() {
        const modalHTML = `
            <div id="confirm-modal" class="fixed inset-0 bg-black/90 backdrop-blur-md z-[10000] hidden items-center justify-center p-4">
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl shadow-2xl max-w-md w-full border border-slate-600/50 transform scale-95 transition-all duration-300">
                    <div class="px-8 py-6 border-b border-slate-600/50">
                        <div class="flex items-center">
                            <div id="confirm-icon" class="w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-exclamation-triangle text-2xl"></i>
                            </div>
                            <h3 id="confirm-title" class="text-xl font-bold text-white">Confirmar Acción</h3>
                        </div>
                    </div>
                    <div class="px-8 py-6">
                        <div id="confirm-message" class="text-gray-300 leading-relaxed"></div>
                    </div>
                    <div class="px-8 py-6 border-t border-slate-600/50 flex justify-end space-x-4">
                        <button id="confirm-cancel" class="px-6 py-3 bg-slate-600 hover:bg-slate-500 text-white rounded-xl transition-all duration-300 font-medium">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </button>
                        <button id="confirm-accept" class="px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-500 hover:to-pink-500 text-white rounded-xl transition-all duration-300 transform hover:scale-105 font-medium shadow-lg shadow-red-500/25">
                            <i class="fas fa-trash mr-2"></i>Eliminar
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // Event listeners para el modal
        document.getElementById('confirm-cancel').addEventListener('click', () => this.hideConfirmModal());
        document.getElementById('confirm-modal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                this.hideConfirmModal();
            }
        });
    }

    // Mostrar modal de confirmación personalizado (solo para archivos y retos)
    showConfirmModal(options = {}) {
        return new Promise((resolve) => {
            const modal = document.getElementById('confirm-modal');
            const icon = document.getElementById('confirm-icon');
            const title = document.getElementById('confirm-title');
            const message = document.getElementById('confirm-message');
            const acceptBtn = document.getElementById('confirm-accept');

            // Reducir z-index del modal principal temporalmente
            const mainModal = document.getElementById('modal-reto');
            if (mainModal && !mainModal.classList.contains('hidden')) {
                mainModal.style.zIndex = '40';
            }

            // Configurar el modal según el tipo
            if (options.type === 'delete' || options.type === 'deleteFile') {
                icon.className = 'w-12 h-12 rounded-full flex items-center justify-center mr-4 bg-red-500/20';
                icon.querySelector('i').className = 'fas fa-exclamation-triangle text-2xl text-red-400';
                acceptBtn.innerHTML = `<i class="fas fa-trash mr-2"></i>${options.acceptText || 'Eliminar'}`;
            }

            title.textContent = options.title || 'Confirmar Acción';
            message.innerHTML = options.message || '¿Estás seguro de que quieres continuar?';

            // Mostrar modal con animación
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                const content = modal.querySelector('.bg-gradient-to-br');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 50);

            // Configurar eventos una sola vez
            const handleAccept = () => {
                cleanup();
                resolve(true);
            };

            const handleCancel = () => {
                cleanup();
                resolve(false);
            };

            const cleanup = () => {
                acceptBtn.removeEventListener('click', handleAccept);
                document.getElementById('confirm-cancel').removeEventListener('click', handleCancel);
                this.hideConfirmModal();
            };

            // Agregar event listeners
            acceptBtn.addEventListener('click', handleAccept);
            document.getElementById('confirm-cancel').addEventListener('click', handleCancel);
        });
    }

    // Ocultar modal de confirmación
    hideConfirmModal() {
        const modal = document.getElementById('confirm-modal');
        const content = modal.querySelector('.bg-gradient-to-br');

        // Restaurar z-index del modal principal
        const mainModal = document.getElementById('modal-reto');
        if (mainModal && !mainModal.classList.contains('hidden')) {
            mainModal.style.zIndex = '50';
        }

        content.classList.remove('scale-100');
        content.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    initializeEventListeners() {
        // Modal
        document.getElementById('crear-reto-btn')?.addEventListener('click', () => this.abrirModalCrear());
        document.getElementById('cerrar-modal')?.addEventListener('click', () => this.cerrarModal());
        document.getElementById('cancelar-btn')?.addEventListener('click', () => this.cerrarModal());

        // Form
        document.getElementById('form-reto')?.addEventListener('submit', (e) => this.guardarReto(e));

        // Pistas
        document.getElementById('agregar-pista')?.addEventListener('click', () => this.agregarPista());

        // Delegación de eventos para botones de eliminar pistas 
        document.getElementById('container-pistas')?.addEventListener('click', (e) => {
            if (e.target.closest('.eliminar-pista-btn')) {
                e.preventDefault();
                e.stopPropagation();
                this.eliminarPista(e.target.closest('.eliminar-pista-btn'));
            }
        });

        // Archivo
        document.getElementById('archivo')?.addEventListener('change', (e) => this.manejarCambioArchivo(e));
        document.getElementById('cancelar-archivo-btn')?.addEventListener('click', () => this.cancelarSeleccionArchivo());
        document.getElementById('eliminar-archivo-btn')?.addEventListener('click', () => this.eliminarArchivoActual());
        document.getElementById('descargar-archivo-btn')?.addEventListener('click', () => this.descargarArchivo());

        // Funcionalidad de arrastrar y soltar
        this.initializeDragAndDrop();

        // Filtros
        document.getElementById('aplicar-filtros')?.addEventListener('click', () => this.aplicarFiltros());

        // Delegación de eventos para botones de acción en la tabla
        document.getElementById('tabla-retos')?.addEventListener('click', (e) => {
            const button = e.target.closest('button[data-action]');
            if (!button) return;

            const action = button.dataset.action;
            const id = button.dataset.id;

            if (action === 'editar') {
                this.editarReto(id);
            } else if (action === 'eliminar') {
                this.eliminarReto(id);
            }
        });

        // Cerrar modal al hacer clic fuera
        document.getElementById('modal-reto')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                this.cerrarModal();
            }
        });

        // Prevenir cierre del modal principal cuando se hace clic en el modal de confirmación
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const confirmModal = document.getElementById('confirm-modal');
                if (confirmModal && !confirmModal.classList.contains('hidden')) {
                    this.hideConfirmModal();
                } else {
                    const mainModal = document.getElementById('modal-reto');
                    if (mainModal && !mainModal.classList.contains('hidden')) {
                        this.cerrarModal();
                    }
                }
            }
        });
    }

    // Nueva función para inicializar drag and drop
    initializeDragAndDrop() {
        const uploadArea = document.getElementById('upload-area');
        if (!uploadArea) return;

        // Prevenir comportamiento por defecto en toda la página
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, this.preventDefaults, false);
            document.body.addEventListener(eventName, this.preventDefaults, false);
        });

        // Highlight cuando se arrastra sobre el área
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => this.highlight(uploadArea), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => this.unhighlight(uploadArea), false);
        });

        // Manejar el drop
        uploadArea.addEventListener('drop', (e) => this.handleDrop(e), false);
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    highlight(element) {
        if (this.tieneArchivo) {
            element.classList.add('border-orange-400', 'bg-orange-500/10');
            element.classList.remove('border-slate-600', 'hover:border-cyan-400/50');
        } else {
            element.classList.add('border-cyan-400', 'bg-cyan-500/10');
            element.classList.remove('border-slate-600', 'hover:border-cyan-400/50');
        }
    }

    unhighlight(element) {
        element.classList.remove('border-cyan-400', 'bg-cyan-500/10', 'border-orange-400', 'bg-orange-500/10');
        element.classList.add('border-slate-600', 'hover:border-cyan-400/50');
    }

    handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            // Verificar si ya tiene archivo
            if (this.tieneArchivo) {
                this.showNotification('warning', 'Este reto ya tiene un archivo. Elimina el archivo actual para subir uno nuevo.');
                this.mostrarArchivoExistenteWarning();
                return;
            }

            // Verificar que solo se arrastra un archivo
            if (files.length > 1) {
                this.showNotification('warning', 'Solo se permite subir un archivo por reto.');
                return;
            }

            const file = files[0];

            // Validar tipo de archivo (solo ZIP y RAR)
            const allowedTypes = ['.zip', '.rar'];
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

            if (!allowedTypes.includes(fileExtension)) {
                this.showNotification('error', 'Solo se permiten archivos ZIP y RAR para garantizar la compatibilidad.');
                return;
            }

            // Validar tamaño (50MB)
            const maxSize = 50 * 1024 * 1024; // 50MB en bytes
            if (file.size > maxSize) {
                this.showNotification('error', 'El archivo no puede superar los 50MB.');
                return;
            }

            // Simular que se seleccionó el archivo en el input
            this.assignFileToInput(file);
            this.mostrarArchivoSeleccionado(file);
        }
    }

    // Función para asignar el archivo arrastrado al input file
    assignFileToInput(file) {
        const fileInput = document.getElementById('archivo');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
    }

    // Métodos de filtros
    aplicarFiltros() {
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

    // Métodos del modal
    abrirModalCrear() {
        this.isEditing = false;
        this.archivoActualId = null;
        this.tieneArchivo = false;

        document.getElementById('modal-titulo').innerHTML =
            '<i class="fas fa-plus mr-3 text-cyan-400"></i>Crear Nuevo Reto';
        document.getElementById('form-reto').reset();
        document.getElementById('reto-id').value = '';

        this.limpiarArchivo();
        this.limpiarPistas();
        document.getElementById('modal-reto').classList.remove('hidden');
    }

    cerrarModal() {
        // Si hay un modal de confirmación activo, cerrarlo primero
        const confirmModal = document.getElementById('confirm-modal');
        if (confirmModal && !confirmModal.classList.contains('hidden')) {
            this.hideConfirmModal();
        }

        document.getElementById('modal-reto').classList.add('hidden');
        this.limpiarPistas();
        this.limpiarArchivo();
    }

    // Métodos de pistas
    agregarPista() {
        this.pistasCounter++;
        const container = document.getElementById('container-pistas');
        const pistaDiv = document.createElement('div');
        pistaDiv.className =
            'flex space-x-4 items-center pista-item bg-slate-700/50 p-4 rounded-xl border border-slate-600';
        pistaDiv.innerHTML = `
            <div class="flex-1">
                <input type="text" name="pistas[${this.pistasCounter}][contenido]" placeholder="Contenido de la pista" 
                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-500 rounded-xl text-gray-200 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
            </div>
            <div class="w-32">
                <input type="number" name="pistas[${this.pistasCounter}][valor]" placeholder="Valor" min="0"
                    class="w-full px-4 py-3 bg-slate-700/50 border border-slate-500 rounded-xl text-gray-200 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
            </div>
            <button type="button" class="eliminar-pista-btn p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(pistaDiv);
    }

    // Función simplificada para eliminar pistas (solo del DOM para pistas nuevas)
    eliminarPista(button) {
        const pistaElement = button.closest('.pista-item');
        const pistaIdInput = pistaElement.querySelector('input[name*="[id]"]');

        // Si es una pista existente (tiene ID), hacer petición al servidor
        if (pistaIdInput && pistaIdInput.value) {
            const pistaId = pistaIdInput.value;
            const retoId = document.getElementById('reto-id').value;

            if (retoId) {
                this.eliminarPistaServidor(retoId, pistaId, pistaElement);
                return;
            }
        }

        // Si es una pista nueva (sin ID), solo eliminar del DOM
        this.eliminarPistaDOM(pistaElement);
    }

    // Eliminar pista del servidor
    async eliminarPistaServidor(retoId, pistaId, pistaElement) {
        try {
            const response = await fetch(`/admin/challenges/${retoId}/pistas/${pistaId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                this.eliminarPistaDOM(pistaElement);
                this.showNotification('success', '✅ Pista eliminada correctamente');
            } else {
                this.showNotification('error', result.message || 'Error al eliminar la pista');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('error', 'Error de conexión al eliminar la pista');
        }
    }

    // Eliminar pista del DOM con animación
    eliminarPistaDOM(pistaElement) {
        // Añadir animación de salida
        pistaElement.style.transform = 'translateX(-100%)';
        pistaElement.style.opacity = '0';
        pistaElement.style.transition = 'all 0.3s ease-out';

        setTimeout(() => {
            pistaElement.remove();
        }, 300);
    }

    limpiarPistas() {
        document.getElementById('container-pistas').innerHTML = '';
        this.pistasCounter = 0;
    }

    // Métodos de archivo
    manejarCambioArchivo(event) {
        const file = event.target.files[0];

        if (!file) return;

        // Verificar si ya tiene archivo
        if (this.tieneArchivo) {
            this.showNotification('warning', 'Este reto ya tiene un archivo. Elimina el archivo actual para subir uno nuevo.');
            event.target.value = '';
            this.mostrarArchivoExistenteWarning();
            return;
        }

        // Validar tipo de archivo (solo ZIP y RAR)
        const allowedTypes = ['.zip', '.rar'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

        if (!allowedTypes.includes(fileExtension)) {
            this.showNotification('error', 'Solo se permiten archivos ZIP y RAR para garantizar la compatibilidad.');
            event.target.value = '';
            return;
        }

        // Validar tamaño (50MB)
        const maxSize = 50 * 1024 * 1024; // 50MB en bytes
        if (file.size > maxSize) {
            this.showNotification('error', 'El archivo no puede superar los 50MB.');
            event.target.value = '';
            return;
        }

        this.mostrarArchivoSeleccionado(file);
    }

    mostrarArchivoSeleccionado(file) {
        // Ocultar otras secciones
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('archivo-actual').classList.add('hidden');
        document.getElementById('archivo-existente-warning').classList.add('hidden');
        document.getElementById('limite-archivo').classList.add('hidden');

        // Mostrar archivo seleccionado
        document.getElementById('archivo-seleccionado').classList.remove('hidden');
        document.getElementById('nombre-archivo-seleccionado').textContent = file.name;
        document.getElementById('size-archivo-seleccionado').textContent = this.formatFileSize(file.size);
    }

    cancelarSeleccionArchivo() {
        document.getElementById('archivo').value = '';
        document.getElementById('archivo-seleccionado').classList.add('hidden');
        document.getElementById('archivo-existente-warning').classList.add('hidden');

        // Mostrar la sección apropiada
        if (this.tieneArchivo) {
            document.getElementById('archivo-actual').classList.remove('hidden');
            document.getElementById('upload-area').classList.add('hidden');
        } else {
            document.getElementById('upload-area').classList.remove('hidden');
            document.getElementById('archivo-actual').classList.add('hidden');
        }
    }

    mostrarArchivoExistenteWarning() {
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('archivo-seleccionado').classList.add('hidden');
        document.getElementById('archivo-existente-warning').classList.remove('hidden');

        // Configurar botón para ir al archivo actual
        document.getElementById('ir-a-archivo-actual')?.addEventListener('click', () => {
            document.getElementById('archivo-existente-warning').classList.add('hidden');
            document.getElementById('archivo-actual').classList.remove('hidden');
        });
    }

    limpiarArchivo() {
        this.tieneArchivo = false;
        this.archivoActualId = null;

        // Ocultar todas las secciones de archivo excepto el área de subida
        document.getElementById('archivo-actual').classList.add('hidden');
        document.getElementById('archivo-seleccionado').classList.add('hidden');
        document.getElementById('limite-archivo').classList.add('hidden');
        document.getElementById('archivo-existente-warning').classList.add('hidden');
        document.getElementById('upload-area').classList.remove('hidden');

        // Limpiar input
        document.getElementById('archivo').value = '';
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    descargarArchivo() {
        const url = document.getElementById('descargar-archivo-btn').dataset.url;
        if (url) {
            window.open(url, '_blank');
        }
    }

    async eliminarArchivoActual() {
        if (!this.archivoActualId) {
            this.showNotification('error', 'No se puede identificar el archivo a eliminar.');
            return;
        }

        const confirmed = await this.showConfirmModal({
            type: 'deleteFile',
            title: 'Eliminar Archivo',
            message: `
                <div class="space-y-3">
                    <p class="text-gray-300">¿Estás seguro de que quieres eliminar este archivo?</p>
                    <div class="bg-orange-600/10 border border-orange-500/30 rounded-xl p-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-orange-400 mr-3 mt-1"></i>
                            <div class="text-sm">
                                <p class="text-orange-300 font-medium mb-1">Esta acción no se puede deshacer</p>
                                <p class="text-gray-400">Los participantes no podrán descargar el archivo una vez eliminado.</p>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            acceptText: 'Eliminar Archivo'
        });

        if (!confirmed) return;

        try {
            const response = await fetch(`/admin/challenges/${this.archivoActualId}/archivo`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                this.showNotification('success', '✅ Archivo eliminado correctamente');
                this.limpiarArchivo();
                // Mostrar área de subida
                document.getElementById('upload-area').classList.remove('hidden');
            } else {
                this.showNotification('error', result.message || 'Error al eliminar el archivo');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('error', 'Error de conexión al eliminar el archivo');
        }
    }

    // Métodos de CRUD
    async guardarReto(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const retoId = formData.get('reto_id');
        const url = this.isEditing ? `/admin/challenges/${retoId}` : '/admin/challenges';
        const method = 'POST';

        if (this.isEditing) {
            formData.append('_method', 'PUT');
        }

        try {
            const response = await fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                this.showNotification('success', this.isEditing ? '✅ Reto actualizado correctamente' : '✅ Reto creado correctamente');
                this.cerrarModal();
                setTimeout(() => {
                    location.reload();
                }, 1500); // Aumentado para que se vea la notificación
            } else {
                let errorMessage = 'Error al guardar el reto';

                if (result.message) {
                    errorMessage = result.message;
                } else if (result.errors) {
                    const firstError = Object.values(result.errors)[0];
                    errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                }

                this.showNotification('error', errorMessage);
                console.error('Error del servidor:', result);
            }
        } catch (error) {
            console.error('Error de red:', error);
            this.showNotification('error', 'Error de conexión al guardar el reto');
        }
    }

    async editarReto(id) {
        try {
            const response = await fetch(`/admin/challenges/${id}/edit`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const reto = await response.json();

            if (reto.success === false) {
                throw new Error(reto.message || 'Error desconocido al cargar el reto');
            }

            this.isEditing = true;
            this.archivoActualId = id;

            document.getElementById('modal-titulo').innerHTML =
                '<i class="fas fa-edit mr-3 text-cyan-400"></i>Editar Reto';

            // Llenar formulario
            document.getElementById('reto-id').value = reto.idretos;
            document.getElementById('nomreto').value = reto.nomreto || '';
            document.getElementById('puntos').value = reto.puntos || '';
            document.getElementById('descripcion').value = reto.descripcion || '';
            document.getElementById('flag').value = reto.flag || '';
            document.getElementById('fk_categoria').value = reto.fk_categoria || '';
            document.getElementById('fk_nivel').value = reto.fk_nivel || '';
            document.getElementById('fk_competencia').value = reto.fk_competencia || '';
            document.getElementById('fk_estado_reto').value = reto.fk_estado_reto || '';

            // Manejar archivo con mejor lógica
            if (reto.archivo && reto.archivo.nombre) {
                this.tieneArchivo = true;
                this.mostrarArchivoActual(reto.archivo);
            } else {
                this.tieneArchivo = false;
                this.limpiarArchivo();
            }

            // Manejar pistas
            this.limpiarPistas();
            if (reto.pistas && reto.pistas.length > 0) {
                this.mostrarPistasExistentes(reto);
            }

            document.getElementById('modal-reto').classList.remove('hidden');
        } catch (error) {
            console.error('Error completo:', error);
            this.showNotification('error', 'Error al cargar los datos del reto: ' + error.message);
        }
    }

    mostrarArchivoActual(archivo) {
        // Ocultar todas las otras secciones
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('archivo-seleccionado').classList.add('hidden');
        document.getElementById('archivo-existente-warning').classList.add('hidden');
        document.getElementById('limite-archivo').classList.add('hidden');

        // Mostrar archivo actual
        document.getElementById('archivo-actual').classList.remove('hidden');
        document.getElementById('nombre-archivo-actual').textContent = archivo.nombre;
        document.getElementById('size-archivo-actual').textContent = 'Archivo del reto';

        // Construir la URL 
        const baseUrl = window.location.origin;
        document.getElementById('descargar-archivo-btn').dataset.url = `${baseUrl}/${archivo.url}`;
    }

    mostrarPistasExistentes(reto) {
        this.limpiarPistas();

        if (reto.pistas && reto.pistas.length > 0) {
            reto.pistas.forEach((pista, index) => {
                this.pistasCounter++;
                const container = document.getElementById('container-pistas');
                const pistaDiv = document.createElement('div');
                pistaDiv.className = 'flex space-x-4 items-center pista-item bg-slate-700/50 p-4 rounded-xl border border-slate-600';
                pistaDiv.innerHTML = `
                    <div class="flex-1">
                        <input type="text" name="pistas[${this.pistasCounter}][contenido]" 
                            value="${pista.contenido || ''}" 
                            placeholder="Contenido de la pista" 
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-gray-200 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                        <input type="hidden" name="pistas[${this.pistasCounter}][id]" value="${pista.idpistas || ''}">
                    </div>
                    <div class="w-32">
                        <input type="number" name="pistas[${this.pistasCounter}][valor]" 
                            value="${pista.valor || ''}" 
                            placeholder="Valor" min="0"
                            class="w-full px-4 py-3 bg-slate-700/50 border border-slate-600/50 rounded-xl text-gray-200 focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition-all duration-300">
                    </div>
                    <button type="button" class="eliminar-pista-btn p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                container.appendChild(pistaDiv);
            });
        }
    }

    // Añadir la función eliminarReto
    async eliminarReto(id) {
        const confirmed = await this.showConfirmModal({
            type: 'delete',
            title: 'Eliminar Reto',
            message: `
                <div class="space-y-4">
                    <p class="text-gray-300">¿Estás seguro de que quieres eliminar este reto?</p>
                    <div class="bg-red-600/10 border border-red-500/30 rounded-xl p-4">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                            <div class="text-sm">
                                <p class="text-red-300 font-medium mb-2">Esta acción eliminará permanentemente:</p>
                                <ul class="text-gray-400 space-y-1 ml-2">
                                    <li class="flex items-center"><i class="fas fa-circle text-xs mr-2 text-red-400"></i>El reto y toda su información</li>
                                    <li class="flex items-center"><i class="fas fa-circle text-xs mr-2 text-red-400"></i>Todas las pistas asociadas</li>
                                    <li class="flex items-center"><i class="fas fa-circle text-xs mr-2 text-red-400"></i>Archivos adjuntos</li>
                                    <li class="flex items-center"><i class="fas fa-circle text-xs mr-2 text-red-400"></i>Progreso de participantes</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-600/10 border border-gray-500/30 rounded-xl p-3">
                        <p class="text-sm text-gray-400 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                            Esta acción no se puede deshacer
                        </p>
                    </div>
                </div>
            `,
            acceptText: 'Eliminar Reto'
        });

        if (!confirmed) return;

        try {
            const response = await fetch(`/admin/challenges/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                this.showNotification('success', '✅ Reto eliminado correctamente');
                setTimeout(() => {
                    location.reload();
                }, 1500); // Aumentado para que se vea la notificación
            } else {
                this.showNotification('error', result.message || 'Error al eliminar el reto');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showNotification('error', 'Error de conexión al eliminar el reto');
        }
    }

    // Mejorar la función de notificaciones con z-index más alto
    showNotification(type, message) {
        // Crear contenedor de notificaciones si no existe
        let notificationContainer = document.getElementById('notification-container');
        if (!notificationContainer) {
            notificationContainer = document.createElement('div');
            notificationContainer.id = 'notification-container';
            notificationContainer.className = 'fixed top-4 right-4 z-[10001] space-y-4';
            document.body.appendChild(notificationContainer);
        }

        const notification = document.createElement('div');
        const bgClass = {
            'success': 'bg-gradient-to-r from-green-600 to-emerald-600 border-green-400/30',
            'error': 'bg-gradient-to-r from-red-600 to-pink-600 border-red-400/30',
            'warning': 'bg-gradient-to-r from-yellow-600 to-orange-600 border-yellow-400/30'
        };

        const iconClass = {
            'success': 'fa-check-circle',
            'error': 'fa-exclamation-circle',
            'warning': 'fa-exclamation-triangle'
        };

        notification.className = `px-6 py-4 rounded-xl shadow-2xl transform translate-x-full transition-all duration-300 text-white border max-w-sm ${bgClass[type] || bgClass.error}`;

        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${iconClass[type] || iconClass.error} mr-3 text-lg"></i>
                <span class="font-medium">${message}</span>
                <button class="ml-4 text-white/70 hover:text-white transition-colors duration-200">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        `;

        // Agregar evento de cierre manual
        notification.querySelector('button').addEventListener('click', () => {
            this.removeNotification(notification);
        });

        notificationContainer.appendChild(notification);

        // Animación de entrada
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
        }, 100);

        // Auto-eliminar después de 5 segundos
        setTimeout(() => {
            this.removeNotification(notification);
        }, 5000);
    }

    // Función auxiliar para remover notificaciones
    removeNotification(notification) {
        if (notification && notification.parentNode) {
            notification.classList.remove('translate-x-0');
            notification.classList.add('translate-x-full');

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }
    }
}

// Inicializar el manager
const retoManager = new RetoManager();

// Funciones globales para los botones onclick
function editarReto(id) {
    retoManager.editarReto(id);
}

function eliminarReto(id) {
    retoManager.eliminarReto(id);
}
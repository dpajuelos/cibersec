import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    // Variables globales
    let categoriaActual = null;
    let busquedaTimeout = null;

    // Elementos del DOM
    const modal = document.getElementById('categoria-modal');
    const modalContent = document.getElementById('modal-content');
    const modalEliminar = document.getElementById('confirmar-eliminar-modal');
    const modalEliminarContent = document.getElementById('eliminar-modal-content');
    const form = document.getElementById('categoria-form');
    const tablaCategorias = document.getElementById('tabla-categorias');
    const buscarInput = document.getElementById('buscar-categoria');
    const limpiarBtn = document.getElementById('limpiar-filtros');

    // Event Listeners principales
    document.getElementById('crear-categoria-btn').addEventListener('click', abrirModalCrear);
    document.getElementById('cerrar-modal').addEventListener('click', cerrarModal);
    document.getElementById('cancelar-btn').addEventListener('click', cerrarModal);
    document.getElementById('cancelar-eliminar').addEventListener('click', cerrarModalEliminar);
    document.getElementById('confirmar-eliminar').addEventListener('click', eliminarCategoria);

    form.addEventListener('submit', guardarCategoria);
    buscarInput.addEventListener('input', function () {
        clearTimeout(busquedaTimeout);
        busquedaTimeout = setTimeout(() => {
            buscarCategorias(this.value);
        }, 300);
    });
    limpiarBtn.addEventListener('click', limpiarFiltros);

    // Event delegation para botones de la tabla
    if (tablaCategorias) {
        tablaCategorias.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-action]');
            if (!btn || btn.disabled) return;

            const action = btn.getAttribute('data-action');
            const id = btn.getAttribute('data-id');

            if (action === 'editar') {
                abrirModalEditar(id);
            } else if (action === 'eliminar') {
                abrirModalEliminar(id);
            }
        });
    }

    // Cerrar modal al hacer clic fuera
    modal?.addEventListener('click', function (e) {
        if (e.target === modal) cerrarModal();
    });

    modalEliminar?.addEventListener('click', function (e) {
        if (e.target === modalEliminar) cerrarModalEliminar();
    });

    // Funciones principales
    function abrirModalCrear() {
        categoriaActual = null;
        document.getElementById('modal-title').textContent = 'Nueva Categoría';
        document.getElementById('btn-text').innerHTML = '<i class="fas fa-save mr-2 group-hover:rotate-12 transition-transform"></i>Crear Categoría';
        document.getElementById('form-method').value = 'POST';

        // Ocultar secciones que no se usan para crear
        const infoAdicional = document.getElementById('info-adicional');
        if (infoAdicional) infoAdicional.classList.add('hidden');

        limpiarFormulario();
        mostrarModal();
    }

    async function abrirModalEditar(id) {
        try {
            const response = await axios.get(`/admin/categories/${id}`);
            const categoria = response.data;

            categoriaActual = categoria;
            document.getElementById('modal-title').textContent = 'Editar Categoría';
            document.getElementById('btn-text').innerHTML = '<i class="fas fa-save mr-2 group-hover:rotate-12 transition-transform"></i>Actualizar Categoría';
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('categoria-id').value = categoria.idcategoria;
            document.getElementById('nombre-categoria').value = categoria.nomcategoria;

            // Mostrar información adicional si existe
            const infoAdicional = document.getElementById('info-adicional');
            if (infoAdicional) {
                infoAdicional.classList.remove('hidden');
                const retosAsociados = document.getElementById('retos-asociados');
                if (retosAsociados) {
                    retosAsociados.textContent = categoria.retos_count || 0;
                }
            }

            mostrarModal();
        } catch (error) {
            console.error('Error al cargar categoría:', error);
            mostrarToast('Error al cargar la categoría', 'error');
        }
    }

    function abrirModalEliminar(id) {
        const fila = document.querySelector(`[data-id="${id}"]`).closest('tr');
        const nombre = fila.querySelector('.categoria-nombre').textContent.trim();

        categoriaActual = { id, nombre };
        document.getElementById('categoria-a-eliminar').textContent = nombre;
        mostrarModalEliminar();
    }

    async function guardarCategoria(e) {
        e.preventDefault();

        if (!validarFormulario()) return;

        const formData = new FormData(form);
        const method = document.getElementById('form-method').value;
        const url = method === 'POST'
            ? '/admin/categories'
            : `/admin/categories/${categoriaActual.idcategoria}`;

        try {
            mostrarCargandoBoton(true);

            const config = {
                method: method === 'PUT' ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                data: {
                    nomcategoria: formData.get('nomcategoria')
                }
            };

            await axios(url, config);

            mostrarToast(
                method === 'POST' ? 'Categoría creada exitosamente' : 'Categoría actualizada exitosamente',
                'success'
            );

            cerrarModal();

            // Recargar las categorías sin refrescar toda la página
            setTimeout(() => {
                cargarCategorias(buscarInput.value.trim());
            }, 500);

        } catch (error) {
            console.error('Error al guardar:', error);
            const mensaje = error.response?.data?.message || 'Error al guardar la categoría';
            mostrarToast(mensaje, 'error');
        } finally {
            mostrarCargandoBoton(false);
        }
    }

    async function eliminarCategoria() {
        if (!categoriaActual) return;

        try {
            await axios.delete(`/admin/categories/${categoriaActual.id}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            mostrarToast('Categoría eliminada exitosamente', 'success');
            cerrarModalEliminar();

            // Recargar las categorías sin refrescar toda la página
            setTimeout(() => {
                cargarCategorias(buscarInput.value.trim());
            }, 500);

        } catch (error) {
            console.error('Error al eliminar:', error);
            const mensaje = error.response?.data?.message || 'Error al eliminar la categoría';
            mostrarToast(mensaje, 'error');
        }
    }

    async function buscarCategorias(termino) {
        try {
            mostrarCargandoTabla(true);

            const response = await axios.get('/admin/categories/search', {
                params: { search: termino }
            });

            actualizarTabla(response.data);

        } catch (error) {
            console.error('Error en búsqueda:', error);
            mostrarToast('Error al buscar categorías', 'error');
        } finally {
            mostrarCargandoTabla(false);
        }
    }

    async function cargarCategorias(termino = '') {
        try {
            mostrarCargandoTabla(true);

            const response = await axios.get('/admin/categories/search', {
                params: { search: termino }
            });

            actualizarTabla(response.data);

        } catch (error) {
            console.error('Error al cargar categorías:', error);
            mostrarToast('Error al cargar categorías', 'error');
        } finally {
            mostrarCargandoTabla(false);
        }
    }

    function actualizarTabla(data) {
        const tbody = document.getElementById('tabla-categorias');

        if (data.categorias.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-layer-group text-gray-400 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white mb-2">No hay categorías</h3>
                                <p class="text-gray-400 text-sm">
                                    ${buscarInput.value.trim() ? 'No se encontraron resultados para tu búsqueda.' : 'Aún no has creado ninguna categoría.'}
                                </p>
                            </div>
                            ${!buscarInput.value.trim() ? `
                                <button onclick="document.getElementById('crear-categoria-btn').click()"
                                    class="mt-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    Crear primera categoría
                                </button>
                            ` : ''}
                        </div>
                    </td>
                </tr>
            `;
        } else {
            tbody.innerHTML = data.categorias.map(categoria => `
                <tr class="hover:bg-slate-700/30 transition-colors duration-200 categoria-row">
                    <td class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                                <span class="text-indigo-400 font-bold">#${categoria.idcategoria}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-layer-group text-purple-400 text-lg"></i>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-white categoria-nombre">
                                    ${categoria.nomcategoria}
                                </div>
                                <div class="text-sm text-gray-400">
                                    <i class="fas fa-tag mr-1"></i>
                                    Categoría de retos
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-flag text-cyan-400 text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xl font-bold text-cyan-400">${categoria.retos_count || 0}</span>
                                <span class="text-xs text-gray-500">
                                    ${categoria.retos_count == 1 ? 'reto' : 'retos'}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex space-x-3">
                            <button data-action="editar" data-id="${categoria.idcategoria}"
                                class="group p-3 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 text-purple-300 border border-purple-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                title="Editar categoría">
                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                            </button>
                            <button data-action="eliminar" data-id="${categoria.idcategoria}"
                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105 ${categoria.retos_count > 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                                title="${categoria.retos_count > 0 ? 'No se puede eliminar: tiene retos asociados' : 'Eliminar categoría'}"
                                ${categoria.retos_count > 0 ? 'disabled' : ''}>
                                <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }
    }

    function mostrarCargandoTabla(mostrar) {
        const tbody = document.getElementById('tabla-categorias');
        if (mostrar) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin text-indigo-400 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white mb-2">Cargando...</h3>
                                <p class="text-gray-400 text-sm">Buscando categorías</p>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        }
    }

    function limpiarFiltros() {
        buscarInput.value = '';
        cargarCategorias();
    }

    // Funciones auxiliares
    function mostrarModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.add('modal-enter');
            modalContent.classList.remove('scale-95', 'opacity-0');
        }, 50);
    }

    function cerrarModal() {
        modalContent.classList.add('modal-leave');
        setTimeout(() => {
            modal.classList.add('hidden');
            modalContent.classList.remove('modal-enter', 'modal-leave');
            modalContent.classList.add('scale-95', 'opacity-0');
            limpiarFormulario();
        }, 300);
    }

    function mostrarModalEliminar() {
        modalEliminar.classList.remove('hidden');
        setTimeout(() => {
            modalEliminarContent.classList.add('modal-enter');
            modalEliminarContent.classList.remove('scale-95', 'opacity-0');
        }, 50);
    }

    function cerrarModalEliminar() {
        modalEliminarContent.classList.add('modal-leave');
        setTimeout(() => {
            modalEliminar.classList.add('hidden');
            modalEliminarContent.classList.remove('modal-enter', 'modal-leave');
            modalEliminarContent.classList.add('scale-95', 'opacity-0');
        }, 300);
    }

    function limpiarFormulario() {
        form.reset();
        document.getElementById('categoria-id').value = '';
    }

    function validarFormulario() {
        const nombre = document.getElementById('nombre-categoria').value.trim();

        if (!nombre) {
            mostrarToast('El nombre de la categoría es obligatorio', 'error');
            document.getElementById('nombre-categoria').focus();
            return false;
        }

        if (nombre.length > 100) {
            mostrarToast('El nombre no puede exceder 100 caracteres', 'error');
            return false;
        }

        return true;
    }

    function mostrarCargandoBoton(mostrar) {
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');
        const btn = document.getElementById('guardar-btn');

        if (mostrar) {
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btn.disabled = true;
        } else {
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
            btn.disabled = false;
        }
    }

    function mostrarToast(mensaje, tipo = 'info') {
        // Crear o obtener el container con z-index más alto
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'fixed top-4 right-4 space-y-4';
            container.style.zIndex = '9999'; // Z-index muy alto
            document.body.appendChild(container);
        }

        const toastId = 'toast-' + Date.now();

        const colores = {
            success: 'from-green-600 to-emerald-600 border-green-400/30',
            error: 'from-red-600 to-pink-600 border-red-400/30',
            warning: 'from-yellow-600 to-orange-600 border-yellow-400/30',
            info: 'from-blue-600 to-cyan-600 border-blue-400/30'
        };

        const iconos = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };

        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `bg-gradient-to-r ${colores[tipo]} text-white px-6 py-4 rounded-2xl shadow-2xl border backdrop-blur-md transform translate-x-full transition-all duration-300`;
        toast.style.zIndex = '10000'; // Z-index aún más alto para el toast individual

        toast.innerHTML = `
            <div class="flex items-center space-x-3">
                <i class="fas ${iconos[tipo]} text-lg"></i>
                <span class="font-medium">${mensaje}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/70 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        container.appendChild(toast);

        // Animar entrada
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto-remove después de 5 segundos
        setTimeout(() => {
            if (document.getElementById(toastId)) {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }
});
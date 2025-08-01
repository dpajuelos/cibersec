document.addEventListener('DOMContentLoaded', function () {
    // Referencias a elementos del DOM
    const modal = document.getElementById('notificacion-modal');
    const abrirModalBtn = document.getElementById('crear-notificacion-btn');
    const cerrarModalBtn = document.getElementById('cerrar-modal');
    const cancelarModalBtn = document.getElementById('cancelar-modal');
    const form = document.getElementById('notificacion-form');
    const tipoRadios = document.querySelectorAll('input[name="tipo_notificacion"]');
    const usuarioSelector = document.getElementById('usuario-selector');
    const buscarUsuarioInput = document.getElementById('buscar-usuario');
    const usuariosResultado = document.getElementById('usuarios-resultado');
    const usuarioSeleccionado = document.getElementById('usuario-seleccionado');
    const mensajeTextarea = document.getElementById('mensaje-notificacion');
    const contadorCaracteres = document.getElementById('contador-caracteres');
    const limpiarFiltrosBtn = document.getElementById('limpiar-filtros');

    // Variables globales
    let usuarioSeleccionadoId = null;
    let timeoutBusqueda = null;

    // Abrir modal
    abrirModalBtn.addEventListener('click', () => {
        modal.classList.remove('opacity-0', 'invisible');
        modal.querySelector('.bg-slate-800\\/90').classList.remove('scale-90');
        modal.querySelector('.bg-slate-800\\/90').classList.add('scale-100');
        mensajeTextarea.focus();
    });

    // Cerrar modal
    function cerrarModal() {
        modal.classList.add('opacity-0', 'invisible');
        modal.querySelector('.bg-slate-800\\/90').classList.add('scale-90');
        modal.querySelector('.bg-slate-800\\/90').classList.remove('scale-100');

        // Resetear formulario
        form.reset();
        usuarioSelector.classList.add('hidden');
        usuarioSeleccionado.classList.add('hidden');
        usuariosResultado.classList.add('hidden');
        usuarioSeleccionadoId = null;
        contadorCaracteres.textContent = '0';

        // Marcar "General" por defecto
        document.querySelector('input[name="tipo_notificacion"][value="general"]').checked = true;
    }

    cerrarModalBtn.addEventListener('click', cerrarModal);
    cancelarModalBtn.addEventListener('click', cerrarModal);

    // Cerrar modal al hacer clic fuera
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            cerrarModal();
        }
    });

    // Manejar cambio de tipo de notificación
    tipoRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'especifica') {
                usuarioSelector.classList.remove('hidden');
            } else {
                usuarioSelector.classList.add('hidden');
                usuarioSeleccionado.classList.add('hidden');
                usuariosResultado.classList.add('hidden');
                usuarioSeleccionadoId = null;
            }
        });
    });

    // Búsqueda de usuarios en tiempo real
    buscarUsuarioInput.addEventListener('input', function () {
        const query = this.value.trim();

        clearTimeout(timeoutBusqueda);

        if (query.length < 2) {
            usuariosResultado.classList.add('hidden');
            return;
        }

        timeoutBusqueda = setTimeout(() => {
            buscarUsuarios(query);
        }, 300);
    });

    function buscarUsuarios(query) {
        fetch(`/admin/notificaciones/buscar/usuarios?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(usuarios => {
                mostrarResultadosUsuarios(usuarios);
            })
            .catch(error => {
                console.error('Error al buscar usuarios:', error);
                mostrarNotificacion('Error al buscar usuarios', 'error');
            });
    }

    function mostrarResultadosUsuarios(usuarios) {
        if (usuarios.length === 0) {
            usuariosResultado.innerHTML = `
                <div class="p-4 text-center text-gray-400">
                    <i class="fas fa-user-times mb-2 text-xl"></i>
                    <p>No se encontraron usuarios</p>
                </div>
            `;
        } else {
            usuariosResultado.innerHTML = usuarios.map(usuario => `
                <div class="p-3 hover:bg-slate-600 cursor-pointer border-b border-slate-600 last:border-b-0 usuario-item" 
                     data-id="${usuario.id}" 
                     data-name="${usuario.name}" 
                     data-email="${usuario.email}">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-500/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <div class="font-medium text-white">${usuario.name}</div>
                            <div class="text-sm text-gray-400">${usuario.email}</div>
                        </div>
                    </div>
                </div>
            `).join('');

            // Agregar event listeners a los resultados
            usuariosResultado.querySelectorAll('.usuario-item').forEach(item => {
                item.addEventListener('click', () => {
                    seleccionarUsuario(
                        item.dataset.id,
                        item.dataset.name,
                        item.dataset.email
                    );
                });
            });
        }

        usuariosResultado.classList.remove('hidden');
    }

    function seleccionarUsuario(id, name, email) {
        usuarioSeleccionadoId = id;
        document.getElementById('usuario-id').value = id;
        document.getElementById('usuario-nombre').textContent = name;
        document.getElementById('usuario-email').textContent = email;

        usuarioSeleccionado.classList.remove('hidden');
        usuariosResultado.classList.add('hidden');
        buscarUsuarioInput.value = '';
    }

    // Remover usuario seleccionado
    document.getElementById('remover-usuario').addEventListener('click', () => {
        usuarioSeleccionado.classList.add('hidden');
        usuarioSeleccionadoId = null;
        document.getElementById('usuario-id').value = '';
        buscarUsuarioInput.value = '';
    });

    // Contador de caracteres
    mensajeTextarea.addEventListener('input', function () {
        const length = this.value.length;
        contadorCaracteres.textContent = length;

        if (length > 500) {
            contadorCaracteres.classList.add('text-red-400');
            contadorCaracteres.classList.remove('text-gray-400');
        } else {
            contadorCaracteres.classList.remove('text-red-400');
            contadorCaracteres.classList.add('text-gray-400');
        }
    });

    // Enviar notificación
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();
        const tipoSeleccionado = document.querySelector('input[name="tipo_notificacion"]:checked').value;

        formData.append('mensaje', mensajeTextarea.value);
        formData.append('tipo_notificacion', tipoSeleccionado);

        if (tipoSeleccionado === 'especifica') {
            if (!usuarioSeleccionadoId) {
                mostrarNotificacion('Debe seleccionar un usuario para notificaciones específicas', 'error');
                return;
            }
            formData.append('usuario_id', usuarioSeleccionadoId);
        }

        // Deshabilitar botón de envío
        const btnEnviar = document.getElementById('enviar-notificacion');
        const textoOriginal = btnEnviar.innerHTML;
        btnEnviar.disabled = true;
        btnEnviar.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enviando...';

        fetch('/admin/notificaciones', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarNotificacion(data.message, 'success');
                    cerrarModal();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    mostrarNotificacion(data.message || 'Error al enviar la notificación', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Error al enviar la notificación', 'error');
            })
            .finally(() => {
                btnEnviar.disabled = false;
                btnEnviar.innerHTML = textoOriginal;
            });
    });

    // Filtros y búsqueda
    const buscarInput = document.getElementById('buscar-notificacion');
    const filtroEstado = document.getElementById('filtro-estado');
    const filtroTipo = document.getElementById('filtro-tipo');
    let timeoutFiltro = null;

    function aplicarFiltros() {
        clearTimeout(timeoutFiltro);
        timeoutFiltro = setTimeout(() => {
            const filtros = {
                buscar: buscarInput.value,
                estado: filtroEstado.value,
                tipo: filtroTipo.value
            };

            filtrarNotificaciones(filtros);
        }, 500);
    }

    buscarInput.addEventListener('input', aplicarFiltros);
    filtroEstado.addEventListener('change', aplicarFiltros);
    filtroTipo.addEventListener('change', aplicarFiltros);

    function filtrarNotificaciones(filtros) {
        const formData = new FormData();
        Object.keys(filtros).forEach(key => {
            if (filtros[key]) {
                formData.append(key, filtros[key]);
            }
        });

        fetch('/admin/notificaciones/filtrar', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    actualizarTablaNotificaciones(data.notificaciones);
                }
            })
            .catch(error => {
                console.error('Error al filtrar:', error);
            });
    }

    function actualizarTablaNotificaciones(notificaciones) {
        const tbody = document.getElementById('tabla-notificaciones');

        if (notificaciones.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-search text-gray-400 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white mb-2">No se encontraron resultados</h3>
                                <p class="text-gray-400 text-sm">Intenta con otros criterios de búsqueda.</p>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = notificaciones.map(notificacion => `
            <tr class="hover:bg-slate-700/30 transition-colors duration-200 notificacion-row">
                <td class="px-6 py-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-green-500/20 rounded-xl flex items-center justify-center">
                            <span class="text-purple-400 font-bold">#${notificacion.id}</span>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-comment-alt text-green-400 text-lg"></i>
                        </div>
                        <div class="max-w-xs">
                            <div class="text-lg font-bold text-white notificacion-mensaje">
                                ${notificacion.mensaje.length > 50 ? notificacion.mensaje.substring(0, 50) + '...' : notificacion.mensaje}
                            </div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-bell mr-1"></i>
                                Notificación del sistema
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    ${notificacion.tipo === 'especifica' ? `
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-400 text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-blue-400">${notificacion.usuario}</span>
                                <span class="text-xs text-gray-500">Específica</span>
                            </div>
                        </div>
                    ` : `
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-orange-500/20 to-red-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-users text-orange-400 text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-orange-400">Todos los usuarios</span>
                                <span class="text-xs text-gray-500">General</span>
                            </div>
                        </div>
                    `}
                </td>
                <td class="px-6 py-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ${notificacion.estado
                ? 'bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-400/30'
                : 'bg-gradient-to-r from-yellow-500/20 to-orange-500/20 text-yellow-300 border border-yellow-400/30'
            }">
                        <div class="w-2 h-2 rounded-full mr-2 ${notificacion.estado ? 'bg-green-400' : 'bg-yellow-400 animate-pulse'}"></div>
                        ${notificacion.estado ? 'Leída' : 'Pendiente'}
                    </span>
                </td>
                <td class="px-6 py-6">
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-300">${notificacion.fecha}</span>
                        <span class="text-xs text-gray-500">${notificacion.hora}</span>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <div class="flex space-x-3">
                        <button data-action="ver" data-id="${notificacion.id}"
                            class="group p-3 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 hover:from-blue-500/30 hover:to-cyan-500/30 text-blue-300 border border-blue-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                            title="Ver detalles">
                            <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                        </button>
                        <button data-action="eliminar" data-id="${notificacion.id}"
                            class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                            title="Eliminar notificación">
                            <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        // Reagregar event listeners
        agregarEventListenersAcciones();
    }

    // Limpiar filtros
    limpiarFiltrosBtn.addEventListener('click', () => {
        buscarInput.value = '';
        filtroEstado.value = '';
        filtroTipo.value = '';
        location.reload();
    });

    // Acciones de la tabla
    function agregarEventListenersAcciones() {
        document.querySelectorAll('[data-action="ver"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.target.closest('button').dataset.id;
                verNotificacion(id);
            });
        });

        document.querySelectorAll('[data-action="eliminar"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.target.closest('button').dataset.id;
                eliminarNotificacion(id);
            });
        });
    }

    function verNotificacion(id) {
        fetch(`/admin/notificaciones/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarDetalleNotificacion(data.notificacion);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Error al cargar los detalles', 'error');
            });
    }

    function mostrarDetalleNotificacion(notificacion) {
        const modalDetalle = document.createElement('div');
        modalDetalle.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50';
        modalDetalle.innerHTML = `
            <div class="bg-slate-800/90 backdrop-blur-md rounded-2xl p-8 w-full max-w-lg mx-4 border border-slate-600/50">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-eye mr-3 text-blue-400"></i>
                        Detalles de Notificación
                    </h3>
                    <button class="cerrar-detalle text-gray-400 hover:text-white transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="p-4 bg-slate-700/50 rounded-xl">
                        <label class="text-sm font-medium text-gray-300">ID</label>
                        <p class="text-white font-bold">#${notificacion.id}</p>
                    </div>
                    
                    <div class="p-4 bg-slate-700/50 rounded-xl">
                        <label class="text-sm font-medium text-gray-300">Mensaje</label>
                        <p class="text-white mt-1">${notificacion.mensaje}</p>
                    </div>
                    
                    <div class="p-4 bg-slate-700/50 rounded-xl">
                        <label class="text-sm font-medium text-gray-300">Destinatario</label>
                        <p class="text-white mt-1">${notificacion.usuario}</p>
                        <span class="text-xs text-gray-400">${notificacion.tipo}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-700/50 rounded-xl">
                            <label class="text-sm font-medium text-gray-300">Estado</label>
                            <p class="text-white mt-1">${notificacion.estado}</p>
                        </div>
                        
                        <div class="p-4 bg-slate-700/50 rounded-xl">
                            <label class="text-sm font-medium text-gray-300">Fecha</label>
                            <p class="text-white mt-1">${notificacion.fecha}</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end mt-6">
                    <button class="cerrar-detalle bg-gradient-to-r from-gray-600 to-slate-600 hover:from-gray-500 hover:to-slate-500 text-white px-6 py-3 rounded-xl transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>Cerrar
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(modalDetalle);

        modalDetalle.querySelectorAll('.cerrar-detalle').forEach(btn => {
            btn.addEventListener('click', () => {
                document.body.removeChild(modalDetalle);
            });
        });

        modalDetalle.addEventListener('click', (e) => {
            if (e.target === modalDetalle) {
                document.body.removeChild(modalDetalle);
            }
        });
    }

    function eliminarNotificacion(id) {
        if (!confirm('¿Estás seguro de que quieres eliminar esta notificación?')) {
            return;
        }

        fetch(`/admin/notificaciones/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mostrarNotificacion(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    mostrarNotificacion(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarNotificacion('Error al eliminar la notificación', 'error');
            });
    }

    // Función para mostrar notificaciones toast
    function mostrarNotificacion(mensaje, tipo = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-2xl transform translate-x-full transition-all duration-300 ${tipo === 'success' ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white' :
                tipo === 'error' ? 'bg-gradient-to-r from-red-600 to-pink-600 text-white' :
                    'bg-gradient-to-r from-blue-600 to-cyan-600 text-white'
            }`;

        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${tipo === 'success' ? 'fa-check-circle' :
                tipo === 'error' ? 'fa-exclamation-circle' :
                    'fa-info-circle'
            } mr-3 text-lg"></i>
                <span class="font-medium">${mensaje}</span>
                <button class="ml-4 text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(toast);

        // Mostrar toast
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto-ocultar después de 5 segundos
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 5000);

        // Cerrar al hacer clic en X
        toast.querySelector('button').addEventListener('click', () => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        });
    }

    // Inicializar event listeners para acciones existentes
    agregarEventListenersAcciones();
});
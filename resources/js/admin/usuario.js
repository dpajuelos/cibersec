document.addEventListener('DOMContentLoaded', function () {
    console.log('Usuario.js cargado'); // Debug

    const modal = document.getElementById('usuario-modal');
    const modalParticles = document.getElementById('modal-particles');
    const loadingState = document.getElementById('loading-state');
    const usuarioDetails = document.getElementById('usuario-details');
    const errorState = document.getElementById('error-state');

    if (!modal) {
        console.error('Modal no encontrado');
        return;
    }

    // Abrir modal con event delegation
    document.addEventListener('click', function (e) {
        const verBtn = e.target.closest('[data-action="ver"]');
        if (verBtn) {
            console.log('Botón ver clickeado'); // Debug
            const usuarioId = verBtn.dataset.id;
            console.log('Usuario ID:', usuarioId); // Debug
            abrirModal(usuarioId);
        }
    });

    // Cerrar modal
    document.addEventListener('click', function (e) {
        if (e.target.closest('#cerrar-modal') ||
            e.target.closest('#btn-cerrar') ||
            (e.target === modal && !e.target.closest('.bg-slate-800'))) {
            cerrarModal();
        }
    });

    function abrirModal(usuarioId) {
        console.log('Abriendo modal para usuario:', usuarioId); // Debug
        modal.classList.remove('hidden');
        if (modalParticles) modalParticles.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        mostrarLoading();
        cargarUsuario(usuarioId);
    }

    function cerrarModal() {
        console.log('Cerrando modal'); // Debug
        modal.classList.add('hidden');
        if (modalParticles) modalParticles.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function mostrarLoading() {
        if (loadingState) loadingState.classList.remove('hidden');
        if (usuarioDetails) usuarioDetails.classList.add('hidden');
        if (errorState) errorState.classList.add('hidden');
    }

    function mostrarError() {
        if (loadingState) loadingState.classList.add('hidden');
        if (usuarioDetails) usuarioDetails.classList.remove('hidden');
        if (errorState) errorState.classList.remove('hidden');
    }

    function mostrarUsuario() {
        if (loadingState) loadingState.classList.add('hidden');
        if (usuarioDetails) usuarioDetails.classList.remove('hidden');
        if (errorState) errorState.classList.add('hidden');
    }

    async function cargarUsuario(usuarioId) {
        try {
            console.log('Cargando usuario desde API:', `/admin/usuarios/${usuarioId}`); // Debug
            const response = await fetch(`/admin/usuarios/${usuarioId}`);
            const data = await response.json();

            console.log('Respuesta de la API:', data); // Debug

            if (data.success) {
                llenarDatosUsuario(data.usuario);
                mostrarUsuario();
            } else {
                console.error('Error en la respuesta:', data);
                mostrarError();
            }
        } catch (error) {
            console.error('Error en fetch:', error);
            mostrarError();
        }
    }

    function llenarDatosUsuario(usuario) {
        console.log('Llenando datos del usuario:', usuario); // Debug

        // Información básica
        setElementText('user-id', `#${usuario.idusuario}`);
        setElementText('user-username', usuario.usuario);
        setElementText('user-email', usuario.email);

        // Avatar
        const avatarContainer = document.getElementById('user-avatar');
        if (usuario.profile_photo_path) {
            const url = `/storage/${usuario.profile_photo_path}`;
            avatarContainer.innerHTML = `<img src="${url}" alt="${usuario.usuario}" class="w-full h-full object-cover">`;
        } else {
            avatarContainer.innerHTML = `<div class="w-full h-full bg-gradient-to-br from-cyan-500/20 to-blue-500/20 flex items-center justify-center"><i class="fas fa-user text-cyan-400 text-2xl"></i></div>`;
        }


        // Estado
        const statusElement = document.getElementById('user-status');
        if (statusElement) {
            if (usuario.fk_idestados == 1) {
                statusElement.className = 'px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-emerald-500/20 to-green-500/20 text-emerald-300 border border-emerald-400/30';
                statusElement.innerHTML = '<div class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse inline-block"></div>Activo';
            } else {
                statusElement.className = 'px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 border border-red-400/30';
                statusElement.innerHTML = '<div class="w-2 h-2 bg-red-400 rounded-full mr-2 inline-block"></div>Inactivo';
            }
        }

        // Fecha de registro
        if (usuario.fec_registro) {
            const fechaRegistro = new Date(usuario.fec_registro);
            setElementText('user-register-date', fechaRegistro.toLocaleDateString('es-ES'));
        }

        // Datos personales
        if (usuario.perfil?.persona) {
            const persona = usuario.perfil.persona;
            setElementText('user-dni', persona.dni || 'No registrado');
            setElementText('user-names', persona.nombres || 'No registrado');
            setElementText('user-paterno', persona.ape_paterno || 'No registrado');
            setElementText('user-materno', persona.ape_materno || 'No registrado');
            setElementText('user-gender', persona.genero || 'No registrado');
            setElementText('user-phone', persona.celular || 'No registrado');

            const fechaNacimiento = persona.fec_nacimiento ?
                new Date(persona.fec_nacimiento).toLocaleDateString('es-ES') : 'No registrado';
            setElementText('user-birthdate', fechaNacimiento);
        } else {
            ['user-dni', 'user-names', 'user-paterno', 'user-materno', 'user-gender', 'user-phone', 'user-birthdate'].forEach(id => {
                setElementText(id, 'Sin perfil registrado');
            });
        }

        // Información académica
        if (usuario.perfil) {
            setElementText('user-university',
                usuario.perfil.universidad?.nomuniversidad || 'No registrada');
            setElementText('user-level',
                usuario.perfil.nivel?.nombre || 'No registrado');
            setElementText('user-bio',
                usuario.perfil.biografia || 'Sin biografía');

            const linkElement = document.getElementById('user-link');
            if (linkElement) {
                if (usuario.perfil.link) {
                    linkElement.innerHTML = `<a href="${usuario.perfil.link}" target="_blank" class="text-cyan-400 hover:text-cyan-300 underline">${usuario.perfil.link}</a>`;
                } else {
                    linkElement.textContent = 'Sin link registrado';
                }
            }
        } else {
            setElementText('user-university', 'Sin perfil registrado');
            setElementText('user-level', 'Sin perfil registrado');
            setElementText('user-bio', 'Sin perfil registrado');
            setElementText('user-link', 'Sin perfil registrado');
        }

        // Roles
        const rolesContainer = document.getElementById('user-roles');
        if (rolesContainer) {
            if (usuario.roles?.length > 0) {
                rolesContainer.innerHTML = usuario.roles.map(rol => `
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-500/20 to-cyan-500/20 text-blue-300 border border-blue-400/30">
                        <i class="fas fa-shield-alt mr-2"></i>
                        ${rol.namerol || rol.nombre}
                    </span>
                `).join('');
            } else {
                rolesContainer.innerHTML = `
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-500/20 text-gray-400 border border-gray-500/30">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Sin roles asignados
                    </span>
                `;
            }
        }
    }

    function setElementText(id, text) {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = text;
        } else {
            console.warn(`Elemento con ID ${id} no encontrado`);
        }
    }

    // Escape key para cerrar modal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            cerrarModal();
        }
    });



    // Modal para crear o editar usuario
    document.getElementById('crear-usuario-btn').addEventListener('click', () => {
        abrirModalCrearUsuario();
    });

    const btnCancelar = document.getElementById('btn-cancelar-usuario');
    if (btnCancelar) {
        btnCancelar.addEventListener('click', cerrarModalUsuario);
    }

    // Función global para cerrar el modal
    function cerrarModalUsuario() {
        document.getElementById('modal-crear-usuario').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }




    function abrirModalCrearUsuario() {
        document.body.classList.add('overflow-hidden');

        // ✅ Primero declarar el form
        const form = document.getElementById('form-usuario');

        // ✅ Resetear formulario y estado
        form.reset();
        form.removeAttribute('data-editar');
        form.removeAttribute('data-id');

        // ✅ Título y visibilidad
        document.getElementById('modal-usuario-titulo').innerText = 'Crear Usuario';
        document.getElementById('usuario-id').value = '';
        document.getElementById('modal-crear-usuario').classList.remove('hidden');

        // ✅ Campos
        document.getElementById('dni').readOnly = false;
        document.getElementById('btnSubmit').textContent = 'Crear';
        document.getElementById('password').placeholder = 'Ingresar contraseña';
        document.getElementById('password_confirmation').placeholder = 'Repetir contraseña';

        document.getElementById('password').setAttribute('required', true);
        document.getElementById('password_confirmation').setAttribute('required', true);

        // ✅ Cargar datos después de que el DOM esté limpio y listo
        cargarUniversidades();
        cargarRoles();
    }


    
    // Cargar universidades para el select
    async function cargarUniversidades() {
        const response = await fetch('/admin/api/universidades');
        const universidades = await response.json();
        const select = document.getElementById('universidad');
        select.innerHTML = '<option value="">Seleccione</option>';
        universidades.forEach(u => {
            select.innerHTML += `<option value="${u.iduniversidad}">${u.nomuniversidad}</option>`;
        });
    }

    // Cargar roles para el select
    async function cargarRoles() {
        const response = await fetch('/admin/api/roles');
        const roles = await response.json();
        const select = document.getElementById('rol');
        select.innerHTML = '<option value="">Seleccione</option>';
        roles.forEach(r => {
            select.innerHTML += `<option value="${r.idroles}">${r.namerol}</option>`;
        });
    }


    // Escuchar clics en botones con data-action="editar"
        document.querySelectorAll('[data-action="editar"]').forEach(button => {
            button.addEventListener('click', async function () {
                document.body.classList.add('overflow-hidden');
                cargarUniversidades();
                cargarRoles();
                const userId = this.getAttribute('data-id');

                try {
                    // Llamar al endpoint que devuelve los datos del usuario
                    const response = await fetch(`/admin/usuarios/${userId}`);
                    const data = await response.json();
                    const usuario = data.usuario;

                    // Llenar campos del formulario
                    document.getElementById('name').value = usuario.perfil.persona.nombres;
                    document.getElementById('paterno').value = usuario.perfil.persona.ape_paterno;
                    document.getElementById('materno').value = usuario.perfil.persona.ape_materno;
                    document.getElementById('dni').value = usuario.perfil.persona.dni;
                    document.getElementById('fecnac').value = usuario.perfil.persona.fec_nacimiento;
                    document.getElementById('genero').value = usuario.perfil.persona.genero;
                    document.getElementById('email').value = usuario.email;
                    document.getElementById('usuario').value = usuario.usuario;
                    document.getElementById('celular').value = usuario.perfil.persona.celular;
                    document.getElementById('universidad').value = usuario.perfil.fk_universidad;


                    // ✅ Corregido: Rol
                    if (usuario.roles.length > 0) {
                        document.getElementById('rol').value = usuario.roles[0].idroles;
                    } else {
                        document.getElementById('rol').value = "";
                    }

                    // Deshabilitar campos que no deberían cambiar
                    document.getElementById('dni').readOnly = true;

                    // Cambiar el texto del botón y guardar el id
                    const form = document.getElementById('form-usuario');
                    form.setAttribute('data-editar', 'true');
                    form.setAttribute('data-id', userId);

                    document.getElementById('btnSubmit').textContent = 'Actualizar';
                    document.getElementById('modal-usuario-titulo').textContent = 'Actualizar Usuario';
                    document.getElementById('password').placeholder = 'Ingresar nueva contraseña (opcional)';
                    document.getElementById('password_confirmation').placeholder = 'Repertir nueva contraseña (opcional)';
                    document.getElementById('password').removeAttribute('required');
                    document.getElementById('password_confirmation').removeAttribute('required');
                    // Mostrar el modal (ajusta según cómo lo uses, por ejemplo Alpine.js o Bootstrap)
                    document.getElementById('modal-crear-usuario').classList.remove('hidden');
                } catch (error) {
                    console.error('Error al cargar usuario:', error);
                    alert('Error al cargar datos del usuario.');
                }
            });
        });

        // Escuchar el envío del formulario
        document.getElementById('form-usuario').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = this;
            const esEdicion = form.getAttribute('data-editar') === 'true';
            const userId = form.getAttribute('data-id');

            // ✅ Corrección aquí
            const url = esEdicion ? `/admin/api/usuarios/${userId}` : '/admin/api/register';
            const method = 'POST'; // Laravel acepta POST con _method=PUT

            const formData = new FormData(form);

            // ✅ Agregar token CSRF
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', token);

            if (esEdicion) {
                formData.append('_method', 'PUT'); // Para que Laravel lo interprete correctamente
            }

            try {
                const response = await fetch(url, {
                    method: method,
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    alert(esEdicion ? 'Usuario actualizado correctamente.' : 'Usuario creado correctamente.');
                    location.reload();
                } else {
                    console.error(data);
                    alert('Error: ' + (data.message || 'Ocurrió un error.'));
                }
            } catch (error) {
                console.error(error);
                alert('Error al procesar la solicitud.');
            }
        });
    // Escuchar clics en botones con data-action="eliminar"
    document.querySelectorAll('[data-action="eliminar"]').forEach(button => {
        button.addEventListener('click', async function () {
            const userId = this.getAttribute('data-id');

            if (!confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
                return;
            }

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/admin/api/usuarios/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    alert(result.message || 'Usuario eliminado correctamente.');
                    location.reload();
                } else {
                    alert('Error al eliminar: ' + (result.message || ''));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Ocurrió un error al intentar eliminar el usuario.');
            }
        });
    });

    document.querySelectorAll('.toggle-estado').forEach(toggle => {
        toggle.addEventListener('change', async function () {
            const userId = this.dataset.id;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/admin/api/usuarios/${userId}/estado`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    
                    location.reload();
                } else {
                    console.error(data);
                    alert('Error al cambiar el estado.');
                    this.checked = !this.checked; // Revertir visualmente
                }
            } catch (error) {
                console.error(error);
                alert('Error al comunicarse con el servidor.');
                this.checked = !this.checked;
            }
        });
    });





});
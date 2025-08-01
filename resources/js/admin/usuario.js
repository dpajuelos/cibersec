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
        if (avatarContainer) {
            if (usuario.profile_photo_url) {
                avatarContainer.innerHTML = `<img src="${usuario.profile_photo_url}" alt="${usuario.usuario}" class="w-full h-full object-cover">`;
            } else {
                avatarContainer.innerHTML = `<div class="w-full h-full bg-gradient-to-br from-cyan-500/20 to-blue-500/20 flex items-center justify-center"><i class="fas fa-user text-cyan-400 text-2xl"></i></div>`;
            }
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
});
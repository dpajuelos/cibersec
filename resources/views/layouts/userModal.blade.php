<!-- User Modal -->
<div id="userModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/70 backdrop-blur-sm">
    <div class="relative w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <!-- Modal Content -->
        <div
            class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl border border-slate-700/50 shadow-2xl backdrop-blur-md">
            <!-- Modal Header -->
            <div
                class="relative bg-gradient-to-r from-blue-600/20 to-purple-600/20 px-8 py-6 border-b border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/5 to-purple-400/5"></div>
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <img id="modalUserImage" src="" alt=""
                                class="w-16 h-16 rounded-full object-cover ring-2 ring-cyan-400 shadow-lg">
                            <div id="modalUserStatus"
                                class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-slate-800">
                            </div>
                        </div>
                        <div>
                            <h3 id="modalUserName" class="text-2xl font-bold text-white"></h3>
                            <p id="modalUserNickname" class="text-cyan-400 font-mono text-lg"></p>
                        </div>
                    </div>
                    <button onclick="closeModal()"
                        class="group p-3 hover:bg-red-600/20 rounded-xl transition-all duration-300 border border-red-500/30 hover:border-red-400/60">
                        <i class="fas fa-times text-red-400 text-xl group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-8 max-h-[60vh] overflow-y-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Basic Info -->
                        <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                            <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                <i class="fas fa-user-circle mr-3"></i>
                                Información Personal
                            </h4>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-blue-400 w-5 mr-3"></i>
                                    <span id="modalUserEmail" class="text-gray-300"></span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-university text-purple-400 w-5 mr-3"></i>
                                    <span id="modalUserUniversity" class="text-gray-300"></span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fab fa-github text-gray-400 w-5 mr-3"></i>
                                    <a id="modalUserGithub" href="" target="_blank"
                                        class="text-purple-400 hover:text-purple-300 transition-colors"></a>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar text-green-400 w-5 mr-3"></i>
                                    <span id="modalUserRegistration" class="text-gray-300"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Description -->
                        <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                            <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                <i class="fas fa-user-edit mr-3"></i>
                                Descripción del Perfil
                            </h4>
                            <p id="modalUserDescription" class="text-gray-300 leading-relaxed"></p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Skills -->
                        <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                            <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                <i class="fas fa-code mr-3"></i>
                                Habilidades
                            </h4>
                            <div id="modalUserSkills" class="flex flex-wrap gap-2"></div>
                        </div>

                        <!-- Experience -->
                        <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                            <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                <i class="fas fa-briefcase mr-3"></i>
                                Experiencia
                            </h4>
                            <p id="modalUserExperience" class="text-gray-300 leading-relaxed"></p>
                        </div>

                        <!-- Competencias -->
                        <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                            <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                <i class="fas fa-trophy mr-3"></i>
                                Competencias
                            </h4>
                            <div id="modalUserCompetencias" class="space-y-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(usuario, nickname) {
        // Mostrar el modal con animación
        const modal = document.getElementById('userModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // Usar un selector más específico para el contenedor del modal body
        const modalBody = modal.querySelector('.p-8');

        // Mostrar un indicador de carga
        modalBody.innerHTML = `
            <div class="flex items-center justify-center p-12">
                <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-cyan-500"></div>
                <span class="ml-3 text-cyan-400">Buscando usuario en la Matrix...</span>
            </div>

        `;

        // Hacer la petición AJAX para obtener los datos del usuario
        fetch(`/usuarios/${encodeURIComponent(usuario)}/${encodeURIComponent(nickname)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    // Mostrar mensaje de error creativo
                    showErrorState(data);
                    return;
                }

                // Restaurar estructura original del modal
                modalBody.innerHTML = `
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Basic Info -->
                            <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                                <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                    <i class="fas fa-user-circle mr-3"></i>
                                    Información Personal
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope text-blue-400 w-5 mr-3"></i>
                                        <span id="modalUserEmail" class="text-gray-300"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-university text-purple-400 w-5 mr-3"></i>
                                        <span id="modalUserUniversity" class="text-gray-300"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fab fa-github text-gray-400 w-5 mr-3"></i>
                                        <a id="modalUserGithub" href="" target="_blank"
                                            class="text-purple-400 hover:text-purple-300 transition-colors"></a>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar text-green-400 w-5 mr-3"></i>
                                        <span id="modalUserRegistration" class="text-gray-300"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Description -->
                            <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                                <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                    <i class="fas fa-user-edit mr-3"></i>
                                    Descripción del Perfil
                                </h4>
                                <p id="modalUserDescription" class="text-gray-300 leading-relaxed"></p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Competencias -->
                            <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-700/50">
                                <h4 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                                    <i class="fas fa-trophy mr-3"></i>
                                    Competencias
                                </h4>
                                <div id="modalUserCompetencias" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>
                `;

                // Llenar los datos del modal
                fillModalData(data);
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                showErrorState({
                    error: 'Error de conexión',
                    easter_egg: {
                        message: 'Parece que hay un fallo en la Matrix...',
                        code: 500
                    }
                });
            });
    }

    function showErrorState(data) {
        const modal = document.getElementById('userModal');
        const modalBody = modal.querySelector('.p-8');

        // HTML para el estado de error con un easter egg
        modalBody.innerHTML = `
            <div class="flex flex-col items-center justify-center p-12 text-center">
                <div class="w-32 h-32 mb-8 flex justify-center items-center">
                    <div class="relative">
                        <i class="fas fa-exclamation-triangle text-6xl text-red-400 animate-pulse"></i>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">${data.easter_egg?.code || 404}</span>
                        </div>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-red-400 mb-4">¡Usuario no encontrado!</h3>
                <p class="text-lg text-gray-300 mb-6">${data.easter_egg?.message || 'Este usuario no existe o se ha escondido muy bien'}</p>
                
                <!-- ASCII Art del error -->
                <div class="font-mono text-xs text-gray-500 mb-6 whitespace-pre-line">
    ╔══════════════════════════════════════╗
    ║         ERROR ${data.easter_egg?.code || 404}                    ║
    ║    Usuario.exe no encontrado         ║
    ║                                      ║
    ║    ¯\\_(ツ)_/¯                        ║
    ╚══════════════════════════════════════╝
                </div>
                
                <div class="flex space-x-4">
                    <button onclick="closeModal()" class="px-6 py-3 bg-gradient-to-r from-red-600/30 to-orange-600/30 text-orange-400 rounded-xl hover:from-red-600/50 hover:to-orange-600/50 transition-all">
                        <i class="fas fa-arrow-left mr-2"></i> Volver
                    </button>
                    <button onclick="location.reload()" class="px-6 py-3 bg-gradient-to-r from-blue-600/30 to-cyan-600/30 text-cyan-400 rounded-xl hover:from-blue-600/50 hover:to-cyan-600/50 transition-all">
                        <i class="fas fa-sync mr-2"></i> Recargar
                    </button>
                </div>
            </div>
        `;
    }

    function fillModalData(data) {
        const user = data.usuario;

        // Llenar datos básicos en el header (estos elementos ya existen en el DOM)
        const modalUserImage = document.getElementById('modalUserImage');
        const modalUserName = document.getElementById('modalUserName');
        const modalUserNickname = document.getElementById('modalUserNickname');

        if (modalUserImage) {
            modalUserImage.src = 'storage/' + (user.profile_photo_path || '/images/default-avatar.png');
            modalUserImage.alt = user.nombres + ' ' + user.ape_paterno;
        }

        if (modalUserName) {
            modalUserName.textContent = `${user.nombres || ''} ${user.ape_paterno || ''} ${user.ape_materno || ''}`
                .trim();
        }

        if (modalUserNickname) {
            modalUserNickname.textContent = '@' + (user.usuario || 'unknown');
        }

        // Llenar datos en el cuerpo del modal (estos se recrean dinámicamente)
        const emailElement = document.getElementById('modalUserEmail');
        const universityElement = document.getElementById('modalUserUniversity');
        const githubElement = document.getElementById('modalUserGithub');
        const registrationElement = document.getElementById('modalUserRegistration');
        const descriptionElement = document.getElementById('modalUserDescription');
        const experienceElement = document.getElementById('modalUserExperience');

        if (emailElement) emailElement.textContent = user.email || 'No disponible';
        if (universityElement) universityElement.textContent = user.nomuniversidad || 'No registrada';

        // GitHub link
        if (githubElement) {
            if (user.link) {
                githubElement.href = user.link;
                githubElement.textContent = user.link;
            } else {
                githubElement.href = '#';
                githubElement.textContent = 'No disponible';
            }
        }

        // Status indicator
        const statusIndicator = document.getElementById('modalUserStatus');
        if (statusIndicator) {
            if (user.fk_idestados == 1) {
                statusIndicator.className =
                    'absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-slate-800 animate-pulse';
            } else {
                statusIndicator.className =
                    'absolute -bottom-1 -right-1 w-5 h-5 bg-red-400 rounded-full border-2 border-slate-800';
            }
        }

        // Fecha de registro
        if (registrationElement) {
            const registrationDate = user.fec_registro ?
                new Date(user.fec_registro).toLocaleDateString('es-ES') :
                'No disponible';
            registrationElement.textContent = registrationDate;
        }

        // Descripción del perfil
        if (descriptionElement) {
            descriptionElement.textContent = user.perfil_descripcion ||
                'Este usuario prefiere mantener un aire de misterio...';
        }

        // Experiencia
        if (experienceElement) {
            experienceElement.textContent = user.experiencia ||
                'Este usuario está comenzando su camino en ciberseguridad';
        }

        // Habilidades
        const skillsContainer = document.getElementById('modalUserSkills');
        if (skillsContainer) {
            skillsContainer.innerHTML = '';
            if (user.habilidades) {
                const skills = user.habilidades.split(',');
                skills.forEach(skill => {
                    const skillElement = document.createElement('span');
                    skillElement.className =
                        'px-3 py-1 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 text-cyan-400 text-xs font-medium rounded-full border border-cyan-500/30';
                    skillElement.textContent = skill.trim();
                    skillsContainer.appendChild(skillElement);
                });
            } else {
                skillsContainer.innerHTML = `
                    <div class="w-full text-center py-3">
                        <i class="fas fa-user-secret text-2xl text-gray-500 mb-2"></i>
                        <p class="text-gray-400">Este hacker mantiene sus habilidades en secreto</p>
                    </div>
                `;
            }
        }

        // Competencias
        const competenciasContainer = document.getElementById('modalUserCompetencias');
        if (competenciasContainer) {
            competenciasContainer.innerHTML = '';
            if (data.competencias && data.competencias.length > 0) {
                data.competencias.forEach(competencia => {
                    const compElement = document.createElement('div');
                    compElement.className =
                        'flex items-center p-3 bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-xl border border-purple-500/30 hover:from-purple-600/30 hover:to-pink-600/30 transition-all duration-300';
                    compElement.innerHTML = `
                        <i class="fas fa-medal text-purple-400 mr-3"></i>
                        <div class="flex-1">
                            <div class="font-medium text-purple-400">${competencia.nomcompetencia}</div>
                            <div class="text-xs text-gray-400">${competencia.descripcion || 'Sin descripción'}</div>
                            <div class="text-xs text-green-400 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Registrado: ${new Date(competencia.fecha_registro).toLocaleDateString('es-ES')}
                            </div>
                        </div>
                    `;
                    competenciasContainer.appendChild(compElement);
                });
            } else {
                // Easter egg para usuarios sin competencias
                competenciasContainer.innerHTML = `
                    <div class="text-center py-6">
                        <div class="flex justify-center mb-3">
                            <div class="relative">
                                <i class="fas fa-trophy text-4xl text-gray-500 opacity-50"></i>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-500 rounded-full animate-ping"></div>
                            </div>
                        </div>
                        <p class="text-gray-400 font-medium">Este usuario aún no ha participado en competencias</p>
                        <p class="text-xs text-gray-500 mt-2">¡Grandes hackers comienzan con pequeños pasos!</p>
                        <div class="mt-4 text-xs text-gray-600 font-mono">
                            while(motivacion > 0) { aprende(); compite(); mejora(); }
                        </div>
                    </div>
                `;
            }
        }
    }

    function closeModal() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Cerrar modal al hacer clic fuera
    document.getElementById('userModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Cerrar modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>

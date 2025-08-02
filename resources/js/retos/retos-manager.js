class RetosManager {
    constructor() {
        this.retoResuelto = false;
        this.activeFilters = {
            category: 'all',
            difficulty: 'all',
            status: 'all',
            search: ''
        };
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupSearchFunctionality();
        this.initializeCounters();
        this.setupKeyboardNavigation();
        this.exposeGlobalFunctions();

        // Debug: verificar variables globales
        console.log('RetosManager initialized with:', {
            isLoggedIn: window.isLoggedIn,
            userRegisteredInCompetition: window.userRegisteredInCompetition,
            competitionId: window.competitionId
        });
    }

    // Exponer funciones globalmente
    exposeGlobalFunctions() {
        // Funciones de filtros y navegación existentes
        window.toggleCategoryMenu = () => this.toggleCategoryMenu();
        window.toggleDifficultyMenu = () => this.toggleDifficultyMenu();
        window.toggleStatusMenu = () => this.toggleStatusMenu();
        window.filterByCategory = (category) => this.filterByCategory(category);
        window.filterByDifficulty = (difficulty) => this.filterByDifficulty(difficulty);
        window.filterByStatus = (status) => this.filterByStatus(status);
        window.clearAllFilters = () => this.clearAllFilters();
        window.openModal = (element) => this.openModal(element);
        window.closeModal = () => this.closeModal();
        window.showResueltos = () => this.showResueltos();
        window.volverAVistaReto = () => this.volverAVistaReto();
        window.enviarFlag = () => this.enviarFlag();

        // Funciones de competencia
        window.registrarseEnCompetencia = () => this.registrarseEnCompetencia();
        window.mostrarModalCompetencia = () => this.mostrarModalCompetencia();
        window.cerrarModalCompetencia = () => this.cerrarModalCompetencia();
        window.confirmarRegistro = () => this.confirmarRegistro();
        window.mostrarModalExito = () => this.mostrarModalExito();
        window.cerrarModalExito = () => this.cerrarModalExito();
    }

    // Setup event listeners
    setupEventListeners() {
        // Close menus when clicking outside
        document.addEventListener('click', (event) => {
            this.handleClickOutside(event);
        });

        // Search input
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.activeFilters.search = e.target.value;
                this.applyFilters();
                this.updateActiveFiltersDisplay();
            });
        }

        // Escape key to close modals and menus
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                this.closeAllMenus();
                this.closeModal();
            }
        });
    }

    // Setup search functionality
    setupSearchFunctionality() {
        const searchForm = document.querySelector('form[action="#"]');
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.applyFilters();
            });
        }
    }

    // Initialize counters
    initializeCounters() {
        const totalChallenges = document.querySelectorAll('.challenge-card').length;
        const visibleCountElement = document.getElementById('visibleCount');
        const totalCountElement = document.getElementById('totalCount');

        if (visibleCountElement) visibleCountElement.textContent = totalChallenges;
        if (totalCountElement) totalCountElement.textContent = totalChallenges;
    }

    // Setup keyboard navigation
    setupKeyboardNavigation() {
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                this.closeAllMenus();
            }
        });
    }

    // Handle clicks outside menus
    handleClickOutside(event) {
        const categoryMenu = document.getElementById('categoryMenu');
        const difficultyMenu = document.getElementById('difficultyMenu');
        const statusMenu = document.getElementById('statusMenu');
        const categoryButton = document.getElementById('categoryButton');
        const difficultyButton = document.getElementById('difficultyButton');
        const statusButton = document.getElementById('statusButton');

        if (!categoryButton?.contains(event.target) && !categoryMenu?.contains(event.target)) {
            this.closeCategoryMenu();
        }

        if (!difficultyButton?.contains(event.target) && !difficultyMenu?.contains(event.target)) {
            this.closeDifficultyMenu();
        }

        if (!statusButton?.contains(event.target) && !statusMenu?.contains(event.target)) {
            this.closeStatusMenu();
        }
    }

    // Menu toggle functions
    toggleCategoryMenu() {
        const menu = document.getElementById('categoryMenu');
        if (!menu) return;

        const isHidden = menu.classList.contains('hidden');

        this.closeDifficultyMenu();
        this.closeStatusMenu();

        if (isHidden) {
            this.showMenu(menu);
        } else {
            this.hideMenu(menu);
        }
    }

    toggleDifficultyMenu() {
        const menu = document.getElementById('difficultyMenu');
        if (!menu) return;

        const isHidden = menu.classList.contains('hidden');

        this.closeCategoryMenu();
        this.closeStatusMenu();

        if (isHidden) {
            this.showMenu(menu);
        } else {
            this.hideMenu(menu);
        }
    }

    toggleStatusMenu() {
        const menu = document.getElementById('statusMenu');
        if (!menu) return;

        const isHidden = menu.classList.contains('hidden');

        this.closeCategoryMenu();
        this.closeDifficultyMenu();

        if (isHidden) {
            this.showMenu(menu);
        } else {
            this.hideMenu(menu);
        }
    }

    // Menu visibility functions
    showMenu(menu) {
        if (!menu) return;

        menu.classList.remove('hidden');
        setTimeout(() => {
            menu.classList.remove('scale-95', 'opacity-0');
            menu.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    hideMenu(menu) {
        if (!menu) return;

        menu.classList.remove('scale-100', 'opacity-100');
        menu.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            menu.classList.add('hidden');
        }, 300);
    }

    closeCategoryMenu() {
        const menu = document.getElementById('categoryMenu');
        if (menu && !menu.classList.contains('hidden')) {
            this.hideMenu(menu);
        }
    }

    closeDifficultyMenu() {
        const menu = document.getElementById('difficultyMenu');
        if (menu && !menu.classList.contains('hidden')) {
            this.hideMenu(menu);
        }
    }

    closeStatusMenu() {
        const menu = document.getElementById('statusMenu');
        if (menu && !menu.classList.contains('hidden')) {
            this.hideMenu(menu);
        }
    }

    closeAllMenus() {
        this.closeCategoryMenu();
        this.closeDifficultyMenu();
        this.closeStatusMenu();
    }

    // Filter functions
    filterByCategory(category) {
        this.activeFilters.category = category;
        this.closeCategoryMenu();
        this.applyFilters();
        this.updateActiveFiltersDisplay();
    }

    filterByDifficulty(difficulty) {
        this.activeFilters.difficulty = difficulty;
        this.closeDifficultyMenu();
        this.applyFilters();
        this.updateActiveFiltersDisplay();
    }

    filterByStatus(status) {
        this.activeFilters.status = status;
        this.closeStatusMenu();
        this.applyFilters();
        this.updateActiveFiltersDisplay();
    }

    applyFilters() {
        const containers = document.querySelectorAll('.category-container');
        const challenges = document.querySelectorAll('.challenge-card');
        let visibleCount = 0;
        let totalCount = challenges.length;

        containers.forEach(container => {
            const category = container.dataset.category;
            let hasVisibleChallenges = false;

            // Filter by category
            if (this.activeFilters.category !== 'all' && category !== this.activeFilters.category) {
                container.style.display = 'none';
                return;
            }

            const categoryCards = container.querySelectorAll('.challenge-card');
            categoryCards.forEach(card => {
                let isVisible = true;

                // Filter by search
                if (this.activeFilters.search) {
                    const challengeName = card.dataset.challengeName?.toLowerCase() || '';
                    if (!challengeName.includes(this.activeFilters.search.toLowerCase())) {
                        isVisible = false;
                    }
                }

                // Filter by difficulty
                if (this.activeFilters.difficulty !== 'all') {
                    const points = parseInt(card.dataset.points);
                    if (this.activeFilters.difficulty === 'easy' && points > 50) isVisible = false;
                    if (this.activeFilters.difficulty === 'medium' && (points <= 50 || points > 100)) isVisible = false;
                    if (this.activeFilters.difficulty === 'hard' && points <= 100) isVisible = false;
                }

                // Filter by status
                if (this.activeFilters.status !== 'all') {
                    const isSolved = card.dataset.solved === 'true';
                    if (this.activeFilters.status === 'solved' && !isSolved) isVisible = false;
                    if (this.activeFilters.status === 'unsolved' && isSolved) isVisible = false;
                }

                if (isVisible) {
                    card.style.display = 'block';
                    hasVisibleChallenges = true;
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            container.style.display = hasVisibleChallenges ? 'block' : 'none';
        });

        // Update counters
        const visibleCountElement = document.getElementById('visibleCount');
        const totalCountElement = document.getElementById('totalCount');

        if (visibleCountElement) visibleCountElement.textContent = visibleCount;
        if (totalCountElement) totalCountElement.textContent = totalCount;
    }

    updateActiveFiltersDisplay() {
        const activeFiltersDiv = document.getElementById('activeFilters');
        const filterTags = document.getElementById('filterTags');
        const clearBtn = document.getElementById('clearFiltersBtn');

        if (!activeFiltersDiv || !filterTags || !clearBtn) return;

        let hasActiveFilters = false;
        filterTags.innerHTML = '';

        // Check if any filters are active
        Object.keys(this.activeFilters).forEach(key => {
            if (this.activeFilters[key] !== 'all' && this.activeFilters[key] !== '') {
                hasActiveFilters = true;

                const tag = document.createElement('span');
                tag.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-600/20 text-purple-400 border border-purple-500/30';

                let displayText = '';
                switch (key) {
                    case 'category':
                        displayText = `Categoría: ${this.activeFilters[key]}`;
                        break;
                    case 'difficulty':
                        displayText = `Dificultad: ${this.activeFilters[key]}`;
                        break;
                    case 'status':
                        displayText = `Estado: ${this.activeFilters[key]}`;
                        break;
                    case 'search':
                        displayText = `Búsqueda: "${this.activeFilters[key]}"`;
                        break;
                }

                tag.innerHTML = `
                    ${displayText}
                    <button onclick="window.retosManager.removeFilter('${key}')" class="ml-2 text-purple-300 hover:text-purple-200">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;
                filterTags.appendChild(tag);
            }
        });

        if (hasActiveFilters) {
            activeFiltersDiv.classList.remove('hidden');
            clearBtn.classList.remove('hidden');
        } else {
            activeFiltersDiv.classList.add('hidden');
            clearBtn.classList.add('hidden');
        }
    }

    removeFilter(filterType) {
        if (filterType === 'search') {
            this.activeFilters[filterType] = '';
            const searchInput = document.getElementById('searchInput');
            if (searchInput) searchInput.value = '';
        } else {
            this.activeFilters[filterType] = 'all';
        }
        this.applyFilters();
        this.updateActiveFiltersDisplay();
    }

    clearAllFilters() {
        this.activeFilters = {
            category: 'all',
            difficulty: 'all',
            status: 'all',
            search: ''
        };
        const searchInput = document.getElementById('searchInput');
        if (searchInput) searchInput.value = '';
        this.applyFilters();
        this.updateActiveFiltersDisplay();
    }

    // Modal functions
    openModal(element) {
        console.log('openModal called with:', {
            isLoggedIn: window.isLoggedIn,
            userRegisteredInCompetition: window.userRegisteredInCompetition
        });

        // Verificar si está logueado
        if (!window.isLoggedIn) {
            console.log('User not logged in, showing overlay panel');
            this.showOverlayPanel();
            return;
        }

        // Verificar si está registrado en la competencia
        if (!window.userRegisteredInCompetition) {
            console.log('User not registered in competition, showing modal');
            this.mostrarModalCompetencia();
            return;
        }

        console.log('User is logged in and registered, showing reto');
        this.showReto(element);
        this.cargarPistas();
        const modal = document.getElementById('modal');
        if (modal) modal.style.display = 'flex';
    }

    // FUNCIONES DE COMPETENCIA - TODAS EN JS
    mostrarModalCompetencia() {
        const modal = document.getElementById('competitionModal');
        const content = document.getElementById('competitionModalContent');

        if (!modal || !content) return;

        modal.classList.remove('hidden');

        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    cerrarModalCompetencia() {
        const modal = document.getElementById('competitionModal');
        const content = document.getElementById('competitionModalContent');

        if (!modal || !content) return;

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    registrarseEnCompetencia() {
        if (!window.isLoggedIn) {
            this.mostrarModalLogin();
            return;
        }

        if (!window.competitionId) {
            this.mostrarAlerta('No hay competencia activa disponible', 'error');
            return;
        }

        // Encontrar el botón que disparó el evento
        const boton = event.target;
        const textoOriginal = boton.innerHTML;
        boton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Registrando...';
        boton.disabled = true;

        fetch(`/competencia/${window.competitionId}/registrar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                boton.innerHTML = textoOriginal;
                boton.disabled = false;

                if (data.success) {
                    this.mostrarModalExito();
                } else {
                    this.mostrarAlerta(data.message || 'Error al registrarse en la competencia', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                boton.innerHTML = textoOriginal;
                boton.disabled = false;
                this.mostrarAlerta('Error al procesar la solicitud', 'error');
            });
    }

    confirmarRegistro() {
        this.registrarseEnCompetencia();
    }

    mostrarModalExito() {
        this.cerrarModalCompetencia();
        const modal = document.getElementById('registrationSuccessModal');
        if (modal) modal.classList.remove('hidden');
    }

    cerrarModalExito() {
        const modal = document.getElementById('registrationSuccessModal');
        if (modal) modal.classList.add('hidden');
        location.reload();
    }

    mostrarAlerta(mensaje, tipo = 'info') {
        const alerta = document.createElement('div');
        const colores = {
            'success': 'from-green-600 to-emerald-600 border-green-500',
            'error': 'from-red-600 to-rose-600 border-red-500',
            'info': 'from-blue-600 to-indigo-600 border-blue-500'
        };

        alerta.className = `fixed top-4 right-4 z-[10003] bg-gradient-to-r ${colores[tipo]} text-white p-4 rounded-xl shadow-lg border transform transition-all duration-300 translate-x-full opacity-0`;
        alerta.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${tipo === 'success' ? 'check' : tipo === 'error' ? 'exclamation-triangle' : 'info-circle'} mr-2"></i>
                <span>${mensaje}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(alerta);

        setTimeout(() => {
            alerta.classList.remove('translate-x-full', 'opacity-0');
        }, 100);

        setTimeout(() => {
            if (alerta.parentElement) {
                alerta.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => alerta.remove(), 300);
            }
        }, 5000);
    }

    mostrarModalLogin() {
        const modal = document.createElement('div');
        modal.className = 'fixed top-0 left-0 w-full h-full flex items-center justify-center z-[10003] bg-black/80 backdrop-blur-sm';
        modal.innerHTML = `
            <div class="bg-gradient-to-br from-slate-900/95 to-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-700/50 p-8 max-w-md w-full mx-4">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-sign-in-alt text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Iniciar Sesión Requerido</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Para participar en la competencia necesitas iniciar sesión primero.
                    </p>
                    <div class="flex space-x-4">
                        <a href="/login" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Iniciar Sesión
                        </a>
                        <button onclick="this.closest('.fixed').remove()" class="flex-1 bg-gradient-to-r from-gray-600 to-slate-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-gray-700 hover:to-slate-700 transition-all duration-300">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    // Modal functions
    closeModal() {
        const modal = document.getElementById('modal');
        if (modal) modal.style.display = 'none';

        // Clear modal fields
        const elements = {
            'message': '',
            'modal-title': '',
            'modal-description': '',
            'pistas-container': '',
            'resuelto-count': '',
            'modal-points': ''
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                if (id === 'pistas-container') {
                    element.innerHTML = '';
                } else {
                    element.innerText = elements[id];
                }
            }
        });
    }

    showReto(element) {
        const idreto = element.dataset.id;
        const title = element.dataset.challengeName;
        const points = element.dataset.points;
        const description = element.dataset.description;
        const url = element.dataset.url;
        const nombreArchivo = element.dataset.nombreArchivo;
        const solved = element.dataset.solved === 'true';
        const inputFlag = document.getElementById('flag-input');
        const botonEnviar = document.querySelector('button[onclick="enviarFlag()"]');
        this.retoResuelto = solved;

        // Insert data into modal
        const elements = {
            'idreto': idreto,
            'modal-title': title,
            'modal-points': `Puntos: ${points}`,
            'modal-description': description
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) element.innerText = elements[id];
        });

        // Show download link if exists
        const enlaceContainer = document.getElementById('enlace-container');
        if (enlaceContainer) {
            if (url && nombreArchivo) {
                enlaceContainer.classList.remove('hidden');
                enlaceContainer.innerHTML = `
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Enlace de descarga</h3>
                    <a href="${url}" download="${nombreArchivo}" class="text-blue-400 underline hover:text-blue-300 transition-all">
                        Descargar ${nombreArchivo}
                    </a>
                `;
            } else {
                enlaceContainer.classList.add('hidden');
                enlaceContainer.innerHTML = '';
            }
        }

        if (inputFlag && botonEnviar) {
            if (solved) {
                inputFlag.disabled = true;
                inputFlag.placeholder = "Ya resolviste este reto...";
                botonEnviar.disabled = true;
                botonEnviar.textContent = "Resuelto";
                botonEnviar.classList.remove('bg-green-600', 'hover:bg-green-700');
                botonEnviar.classList.add('bg-gray-600', 'cursor-not-allowed');
            } else {
                inputFlag.disabled = false;
                inputFlag.placeholder = "CSU{flag}";
                botonEnviar.disabled = false;
                botonEnviar.textContent = "Enviar";
                botonEnviar.classList.remove('bg-gray-600', 'cursor-not-allowed');
                botonEnviar.classList.add('bg-green-600', 'hover:bg-green-700');
            }
        }

        this.fetchResueltosCount(idreto);
        this.clearModalFields();
    }

    fetchResueltosCount(idreto) {
        fetch(`/resueltos/${idreto}`)
            .then(response => {
                if (!response.ok) throw new Error("Error al obtener cantidad de resueltos");
                return response.json();
            })
            .then(data => {
                const resueltosElement = document.getElementById('resuelto-count');
                if (resueltosElement) resueltosElement.innerText = data.count ?? 0;
            })
            .catch(error => {
                console.error(error);
                const resueltosElement = document.getElementById('resuelto-count');
                if (resueltosElement) resueltosElement.innerText = '0';
            });
    }

    clearModalFields() {
        const flagInput = document.getElementById('flag-input');
        const messageElement = document.getElementById('message');
        const resultElement = document.getElementById('result');

        if (flagInput) flagInput.value = '';
        if (messageElement) messageElement.innerText = '';
        if (resultElement) resultElement.innerText = '';
    }

    showResueltos() {
        const idreto = document.getElementById('idreto')?.innerText;
        if (!idreto) return;

        const containerElement = document.querySelector('.container');
        const resueltosView = document.getElementById('resueltos-view');

        if (containerElement) containerElement.classList.add('hidden');
        if (resueltosView) resueltosView.classList.remove('hidden');

        const container = document.getElementById('resueltos-tabla-container');
        if (container) container.innerHTML = `<p class="text-gray-400 italic">Cargando...</p>`;

        fetch(`/resueltos/${idreto}`)
            .then(res => {
                if (!res.ok) throw new Error("Error al obtener usuarios.");
                return res.json();
            })
            .then(data => {
                if (!container) return;

                if (!data.data || data.data.length === 0) {
                    container.innerHTML = `<p class="text-gray-300">Ningún usuario ha resuelto este reto aún.</p>`;
                    return;
                }

                let tabla = `
                    <table class="w-full text-left border border-slate-600">
                        <thead>
                            <tr class="bg-slate-700 text-gray-100">
                                <th class="p-2 border-b border-slate-600">Usuario</th>
                                <th class="p-2 border-b border-slate-600">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                data.data.forEach(item => {
                    tabla += `
                        <tr class="hover:bg-slate-700 transition">
                            <td class="p-2 border-b border-slate-600">${item.usuario}</td>
                            <td class="p-2 border-b border-slate-600">${new Date(item.time).toLocaleString()}</td>
                        </tr>
                    `;
                });

                tabla += `</tbody></table>`;
                container.innerHTML = tabla;
            })
            .catch(err => {
                console.error("Error al obtener datos:", err);
                if (container) container.innerHTML = `<p class="text-red-400">Hubo un error al cargar la información.</p>`;
            });
    }

    volverAVistaReto() {
        const resueltosView = document.getElementById('resueltos-view');
        const containerElement = document.querySelector('.container');

        if (resueltosView) resueltosView.classList.add('hidden');
        if (containerElement) containerElement.classList.remove('hidden');
    }

    showOverlayPanel() {
        const overlay = document.createElement('div');
        overlay.id = 'overlay';
        overlay.className = 'fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50';

        const messageBox = document.createElement('div');
        messageBox.className = 'w-full max-w-md bg-white p-6 rounded-lg shadow-lg relative';

        const title = document.createElement('h2');
        title.innerText = 'Iniciar Sesión Requerido';
        title.className = 'text-lg font-bold mb-4 text-gray-800 text-center';

        const message = document.createElement('p');
        message.innerText = 'Para acceder a los retos necesita iniciar sesión.';
        message.className = 'mb-4 text-gray-700 text-center';

        const closeButton = document.createElement('button');
        closeButton.innerText = '✖';
        closeButton.className = 'absolute top-2 right-2 text-gray-600 hover:text-gray-800';
        closeButton.onclick = () => {
            document.body.removeChild(overlay);
        };

        const buttonContainer = document.createElement('div');
        buttonContainer.className = 'flex justify-center space-x-2 mt-4';

        const loginButton = document.createElement('button');
        loginButton.innerText = 'Iniciar sesión';
        loginButton.className = 'bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600';
        loginButton.onclick = () => {
            window.location.href = '/login';
        };

        const registerButton = document.createElement('button');
        registerButton.innerText = 'Registrarse';
        registerButton.className = 'bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600';
        registerButton.onclick = () => {
            window.location.href = '/register';
        };

        buttonContainer.appendChild(loginButton);
        buttonContainer.appendChild(registerButton);

        messageBox.appendChild(closeButton);
        messageBox.appendChild(title);
        messageBox.appendChild(message);
        messageBox.appendChild(buttonContainer);
        overlay.appendChild(messageBox);
        document.body.appendChild(overlay);
    }

    cargarPistas() {
        const idretoElement = document.getElementById('idreto');
        if (!idretoElement) return;

        const idreto = idretoElement.innerText;
        const pistasContainer = document.getElementById('pistas-container');

        if (!pistasContainer) return;

        pistasContainer.classList.remove('hidden');
        pistasContainer.innerHTML = `<p class="text-gray-400 italic">Cargando pistas...</p>`;

        fetch(`/pistas/${idreto}`)
            .then(res => {
                if (!res.ok) throw new Error("Error al obtener pistas.");
                return res.json();
            })
            .then(data => {
                if (!data || data.length === 0) {
                    pistasContainer.classList.add('hidden');
                    pistasContainer.innerHTML = '';
                    return;
                }

                pistasContainer.innerHTML = `<h3 class="text-xl font-semibold text-yellow-400 mb-2">Pistas</h3>`;

                let totalDescontado = 0;

                data.forEach(pista => {
                    if (pista.usada) {
                        totalDescontado += pista.valor;
                        pistasContainer.innerHTML += `
                            <div class="bg-slate-700/60 p-3 rounded text-gray-100 mb-2">
                                <p>${pista.contenido}</p>
                                <p class="text-sm text-red-300 italic mt-1">-${pista.valor} puntos</p>
                            </div>
                        `;
                    } else {
                        const botonHTML = this.retoResuelto ?
                            `<button disabled class="bg-gray-500 text-white font-semibold px-4 py-2 rounded cursor-not-allowed">Reto Resuelto</button>` :
                            `<button onclick="window.retosManager.desbloquearPista(${pista.id}, this)" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                                Desbloquear
                            </button>`;

                        pistasContainer.innerHTML += `
                            <div class="bg-slate-700/60 p-3 rounded text-gray-100 flex justify-between items-center mb-2">
                                <span>Pista oculta (Valor: ${pista.valor} pts)</span>
                                ${botonHTML}
                            </div>
                        `;
                    }
                });

                // Update points in modal
                const puntosElement = document.getElementById('modal-points');
                if (puntosElement) {
                    const puntosText = puntosElement.innerText;
                    const match = puntosText.match(/\d+/);
                    if (match) {
                        const puntosOriginales = parseInt(match[0]);
                        const puntosActualizados = Math.max(0, puntosOriginales - totalDescontado);
                        puntosElement.innerText = `Puntos: ${puntosActualizados}`;
                    }
                }
            })
            .catch(err => {
                console.error("Error al obtener pistas:", err);
                pistasContainer.classList.add('hidden');
                pistasContainer.innerHTML = '';
            });
    }

    desbloquearPista(idPista, boton) {
        if (!boton) {
            console.error("El botón no fue pasado correctamente.");
            return;
        }

        const contenedor = boton.closest('div');
        if (!contenedor) {
            console.error("No se encontró el contenedor del botón.");
            return;
        }

        boton.disabled = true;
        boton.textContent = "Desbloqueando...";

        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error("CSRF token no encontrado");
            return;
        }

        fetch('/pistas/desbloquear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content')
            },
            body: JSON.stringify({
                idpista: idPista
            })
        })
            .then(async res => {
                const contentType = res.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    const html = await res.text();
                    console.error("Respuesta inesperada:", html);
                    throw new Error("Respuesta no válida");
                }
                return res.json();
            })
            .then(data => {
                if (data.success && data.contenido) {
                    contenedor.innerHTML = '';

                    const pistaElemento = document.createElement('div');
                    pistaElemento.className = "bg-slate-700/60 p-3 rounded text-gray-100";
                    pistaElemento.innerHTML = `
                        <p>${data.contenido}</p>
                        <p class="text-sm text-red-300 italic mt-1">-${data.valor} puntos</p>
                    `;
                    contenedor.appendChild(pistaElemento);

                    // Update points in modal
                    const puntosElement = document.getElementById('modal-points');
                    if (puntosElement) {
                        const puntosText = puntosElement.innerText;
                        const match = puntosText.match(/\d+/);
                        if (match) {
                            const puntosActuales = parseInt(match[0]);
                            const nuevosPuntos = Math.max(0, puntosActuales - data.valor);
                            puntosElement.innerText = `Puntos: ${nuevosPuntos}`;
                        }
                    }
                } else {
                    alert("No se pudo desbloquear la pista.");
                    boton.disabled = false;
                    boton.textContent = "Desbloquear";
                }
            })
            .catch(err => {
                console.error("Error al desbloquear pista:", err);
                alert("Hubo un problema al desbloquear la pista.");
                boton.disabled = false;
                boton.textContent = "Desbloquear";
            });
    }

    enviarFlag() {
        const flagInput = document.getElementById('flag-input');
        const idretoElement = document.getElementById('idreto');

        if (!flagInput || !idretoElement) {
            console.error("Elementos del modal no encontrados");
            return;
        }

        const flag = flagInput.value.trim();
        const idreto = idretoElement.innerText;

        const messageElement = document.getElementById('message');
        const resultElement = document.getElementById('result');

        if (messageElement) messageElement.innerText = '';
        if (resultElement) resultElement.innerText = '';

        if (!flag) {
            if (messageElement) messageElement.innerText = "Por favor, ingresa una flag.";
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error("CSRF token no encontrado");
            return;
        }

        fetch('/retos/validar-flag', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            },
            body: JSON.stringify({
                idreto: idreto,
                flag: flag
            })
        })
            .then(async res => {
                if (!res.ok) {
                    const errText = await res.text();
                    throw new Error(errText);
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    if (resultElement) resultElement.innerText = data.mensaje || "¡Flag correcta!";
                    this.actualizarEstado(idreto);
                } else {
                    if (messageElement) messageElement.innerText = data.mensaje || "Flag incorrecta.";
                }
            })
            .catch(err => {
                console.error("Error al enviar flag:", err);
                if (messageElement) messageElement.innerText = "Hubo un error al enviar la flag.";
            });
        this.actualizarIntentos(idreto);
    }

    actualizarIntentos(idreto) {
        fetch(`/intentos/${idreto}`)
            .then(res => res.json())
            .then(json => {
                const c = json.count;
                const resueltosElement = document.getElementById('resuelto-count');
                if (resueltosElement) resueltosElement.innerText = c;

                const card = document.querySelector(`.challenge-card[data-id="${idreto}"]`);
                if (card) {
                    const span = card.querySelector('.intentos-count');
                    if (span) span.innerText = c;
                }
            })
            .catch(console.error);
    }

    actualizarEstado(idreto) {
        const card = document.querySelector(`.challenge-card[data-id="${idreto}"]`);
        if (!card) return;

        card.dataset.solved = 'true';

        const badgeWrapper = card.querySelector('.absolute.top-4.right-4');
        if (badgeWrapper) {
            badgeWrapper.innerHTML = `
                <div class="flex items-center space-x-1 bg-green-600/90 border border-green-500/50 rounded-full px-3 py-1 backdrop-blur-sm">
                    <div class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></div>
                    <span class="text-green-200 text-xs font-bold">RESUELTO</span>
                </div>
            `;
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    window.retosManager = new RetosManager();
});

// Verificar que las funciones están disponibles
window.addEventListener('load', function () {
    console.log('Retos Manager loaded');
    console.log('Variables available:', {
        isLoggedIn: window.isLoggedIn,
        userRegisteredInCompetition: window.userRegisteredInCompetition,
        competitionId: window.competitionId
    });
});
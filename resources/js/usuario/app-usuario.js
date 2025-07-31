class UsuariosManager {
    constructor() {
        this.searchTimeout = null;
        this.currentFilters = {
            estado: '',
            universidad: '',
            orden: ''
        };
        this.init();
    }

    init() {
        this.setupSearchInput();
        this.setupEventListeners();
        this.setupFilterFunctionality();
    }

    // Configurar búsqueda en tiempo real
    setupSearchInput() {
        const searchInput = document.querySelector('input[name="buscar"]');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.performSearch(e.target.value);
                }, 500);
            });
        }
    }

    // Realizar búsqueda AJAX
    async performSearch(query) {
        try {
            this.showLoadingState();

            const url = new URL(window.location.origin + '/usuarios/buscar');
            const params = new URLSearchParams({
                buscar: query,
                estado: this.currentFilters.estado,
                universidad: this.currentFilters.universidad,
                orden: this.currentFilters.orden,
                ajax: '1'
            });

            url.search = params.toString();

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                this.updateTable(data.html);
                this.updatePagination(data.pagination);
                this.updateStats(data.stats);
            }
        } catch (error) {
            console.error('Error en la búsqueda:', error);
            this.showErrorState();
        } finally {
            this.hideLoadingState();
        }
    }

    // Mostrar estado de carga
    showLoadingState() {
        const tableBody = document.querySelector('tbody');
        if (tableBody) {
            tableBody.classList.add('opacity-50');
        }

        const searchIcon = document.querySelector('.fas.fa-search');
        if (searchIcon) {
            searchIcon.className = 'fas fa-spinner fa-spin';
        }
    }

    // Ocultar estado de carga
    hideLoadingState() {
        const tableBody = document.querySelector('tbody');
        if (tableBody) {
            tableBody.classList.remove('opacity-50');
        }

        const searchIcon = document.querySelector('.fas.fa-spinner');
        if (searchIcon) {
            searchIcon.className = 'fas fa-search';
        }
    }

    // Mostrar estado de error
    showErrorState() {
        // Implementar notificación de error
        console.log('Error en la búsqueda');
    }

    // Actualizar tabla con nuevos resultados
    updateTable(html) {
        const tableContainer = document.querySelector('.overflow-x-auto');
        if (tableContainer && html) {
            tableContainer.innerHTML = html;
        }
    }

    // Actualizar paginación
    updatePagination(paginationHtml) {
        const paginationContainer = document.querySelector('nav.flex.items-center.space-x-2');
        if (paginationContainer && paginationHtml) {
            paginationContainer.innerHTML = paginationHtml;
        }
    }

    // Actualizar estadísticas
    updateStats(stats) {
        if (stats) {
            // Actualizar contadores en el hero section
            const totalElement = document.querySelector('.text-3xl.font-black.text-cyan-400');
            if (totalElement) {
                totalElement.textContent = stats.total;
            }
        }
    }

    // Configurar event listeners
    setupEventListeners() {
        // Delegar eventos de clic para botones de filtro y ordenamiento
        document.addEventListener('click', (event) => {
            // Delegación para botones con data-action
            if (event.target.closest('[data-action]')) {
                const button = event.target.closest('[data-action]');
                const action = button.dataset.action;

                if (typeof this[action] === 'function') {
                    this[action]();
                }
            }

            this.handleClickOutside(event);
        });

        // Navegación por teclado
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                this.closeAllMenus();
            }
        });

        // Reposicionar menús en resize y scroll
        window.addEventListener('resize', () => this.closeAllMenus());
        window.addEventListener('scroll', () => this.repositionMenus());
    }

    // Configurar funcionalidad de filtros
    setupFilterFunctionality() {
        // Configurar filtros de estado
        const estadoSelect = document.querySelector('#filterMenu select[data-filter="estado"]');
        if (estadoSelect) {
            estadoSelect.addEventListener('change', (e) => {
                this.currentFilters.estado = e.target.value;
                this.applyFilters();
            });
        }

        // Configurar filtros de universidad
        const universidadSelect = document.querySelector('#filterMenu select[data-filter="universidad"]');
        if (universidadSelect) {
            universidadSelect.addEventListener('change', (e) => {
                this.currentFilters.universidad = e.target.value;
                this.applyFilters();
            });
        }

        // Configurar opciones de ordenamiento
        const sortButtons = document.querySelectorAll('#sortMenu button[data-sort]');
        sortButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                this.currentFilters.orden = e.target.dataset.sort;
                this.applyFilters();
                this.closeSortMenu();
            });
        });
    }

    // Aplicar filtros
    async applyFilters() {
        const searchInput = document.querySelector('input[name="buscar"]');
        const searchQuery = searchInput ? searchInput.value : '';
        await this.performSearch(searchQuery);
    }

    // Manejar click fuera de los menús
    handleClickOutside(event) {
        const filterMenu = document.getElementById('filterMenu');
        const sortMenu = document.getElementById('sortMenu');
        const filterButton = document.getElementById('filterButton');
        const sortButton = document.getElementById('sortButton');

        if (!filterButton?.contains(event.target) && !filterMenu?.contains(event.target)) {
            this.closeFilterMenu();
        }

        if (!sortButton?.contains(event.target) && !sortMenu?.contains(event.target)) {
            this.closeSortMenu();
        }
    }

    // Toggle menú de filtros
    toggleFilterMenu() {
        const menu = document.getElementById('filterMenu');
        const button = document.getElementById('filterButton');
        const isHidden = menu.classList.contains('hidden');

        this.closeSortMenu();

        if (isHidden) {
            this.showMenu(menu, button);
        } else {
            this.closeFilterMenu();
        }
    }

    // Toggle menú de ordenamiento
    toggleSortMenu() {
        const menu = document.getElementById('sortMenu');
        const button = document.getElementById('sortButton');
        const isHidden = menu.classList.contains('hidden');

        this.closeFilterMenu();

        if (isHidden) {
            this.showMenu(menu, button);
        } else {
            this.closeSortMenu();
        }
    }

    // Mostrar menú
    showMenu(menu, button) {
        const buttonRect = button.getBoundingClientRect();

        menu.style.position = 'fixed';
        menu.style.top = (buttonRect.bottom + 8) + 'px';
        menu.style.left = buttonRect.left + 'px';
        menu.style.right = 'auto';
        menu.style.zIndex = '99999';

        document.body.appendChild(menu);
        menu.classList.remove('hidden');

        setTimeout(() => {
            menu.classList.remove('scale-95', 'opacity-0');
            menu.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Cerrar menú de filtros
    closeFilterMenu() {
        const menu = document.getElementById('filterMenu');
        this.hideMenu(menu, '#filterButton');
    }

    // Cerrar menú de ordenamiento
    closeSortMenu() {
        const menu = document.getElementById('sortMenu');
        this.hideMenu(menu, '#sortButton');
    }

    // Ocultar menú
    hideMenu(menu, buttonSelector) {
        if (!menu || menu.classList.contains('hidden')) return;

        menu.classList.remove('scale-100', 'opacity-100');
        menu.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            menu.classList.add('hidden');
            const originalContainer = document.querySelector(buttonSelector)?.parentNode;
            if (originalContainer && !originalContainer.contains(menu)) {
                originalContainer.appendChild(menu);
            }
        }, 300);
    }

    // Cerrar todos los menús
    closeAllMenus() {
        this.closeFilterMenu();
        this.closeSortMenu();
    }

    // Reposicionar menús al hacer scroll
    repositionMenus() {
        const filterMenu = document.getElementById('filterMenu');
        const sortMenu = document.getElementById('sortMenu');

        if (!filterMenu.classList.contains('hidden')) {
            const button = document.getElementById('filterButton');
            const buttonRect = button.getBoundingClientRect();
            filterMenu.style.top = (buttonRect.bottom + 8) + 'px';
            filterMenu.style.left = buttonRect.left + 'px';
        }

        if (!sortMenu.classList.contains('hidden')) {
            const button = document.getElementById('sortButton');
            const buttonRect = button.getBoundingClientRect();
            sortMenu.style.top = (buttonRect.bottom + 8) + 'px';
            sortMenu.style.left = buttonRect.left + 'px';
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
    window.usuariosManager = new UsuariosManager();
});

// Funciones globales para compatibilidad
function toggleFilterMenu() {
    window.usuariosManager?.toggleFilterMenu();
}

function toggleSortMenu() {
    window.usuariosManager?.toggleSortMenu();
}

function closeFilterMenu() {
    window.usuariosManager?.closeFilterMenu();
}

function closeSortMenu() {
    window.usuariosManager?.closeSortMenu();
}
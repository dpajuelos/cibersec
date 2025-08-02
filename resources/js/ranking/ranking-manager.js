class RankingManager {
    constructor() {
        this.updateInterval = 30000; // 30 segundos
        this.intervalId = null;
        this.isUpdating = false;

        this.init();
    }

    init() {
        // Iniciar actualizaciones automáticas
        this.startAutoUpdate();

        // Actualizar cuando la página gana el foco
        this.setupVisibilityListener();

        console.log('🏆 Ranking Manager inicializado - Actualizaciones cada 30 segundos');
    }

    async updateTable() {
        const tbody = document.getElementById('rankingTableBody');
        if (!tbody) return;

        try {
            const response = await fetch(window.routes.json);
            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();

            // Limpiar tabla
            tbody.innerHTML = '';

            data.forEach((ranking, index) => {
                const row = this.createTableRow(ranking, index);
                tbody.appendChild(row);
            });

            console.log('📋 Tabla actualizada');
        } catch (error) {
            console.error('❌ Error al actualizar la tabla:', error);
        }
    }

    async updateStats() {
        const statsContainer = document.getElementById('rankingStats');
        if (!statsContainer) return;

        try {
            const response = await fetch(window.routes.json);
            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();

            // Actualizar estadísticas del top 3
            const top3Container = statsContainer.querySelector('.space-y-4');
            if (top3Container) {
                // Limpiar contenido existente del top 3
                const top3Items = top3Container.querySelectorAll('.flex.items-center.space-x-3');
                top3Items.forEach(item => item.remove());

                // Crear nuevos elementos del top 3
                data.slice(0, 3).forEach((ranking, index) => {
                    const quickViewItem = this.createQuickViewItem(ranking, index);
                    top3Container.insertBefore(quickViewItem, top3Container.querySelector('.border-t'));
                });
            }

            // Actualizar estadísticas adicionales
            const totalParticipants = top3Container.querySelector('.space-y-3 .flex:nth-child(1) span:last-child');
            const avgPoints = top3Container.querySelector('.space-y-3 .flex:nth-child(2) span:last-child');

            if (totalParticipants) totalParticipants.textContent = data.length;
            if (avgPoints) {
                const avg = data.reduce((sum, ranking) => sum + ranking.total_puntos, 0) / data.length;
                avgPoints.textContent = Math.round(avg);
            }

            console.log('📊 Estadísticas actualizadas');
        } catch (error) {
            console.error('❌ Error al actualizar las estadísticas:', error);
        }
    }

    createTableRow(ranking, index) {
        const tr = document.createElement('tr');
        tr.className = 'group hover:bg-gradient-to-r hover:from-slate-700/30 hover:to-slate-600/20 transition-all duration-500 cursor-pointer relative overflow-hidden animate-fade-in';
        tr.style.animationDelay = `${index * 100}ms`;
        tr.onclick = () => openModal(ranking.usuario, ranking.nickname);

        // Generar iconos de posición
        let positionIcon = this.getPositionIcon(ranking.puesto);
        let pointsStyle = this.getPointsStyle(ranking.puesto);

        tr.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap text-center relative">
                <div class="flex items-center justify-center">${positionIcon}</div>
            </td>
            
            <td class="px-4 py-4 text-left relative">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <img src="${ranking.profile_photo_url}" 
                             alt="${ranking.usuario}"
                             class="w-12 h-12 rounded-full border-2 border-slate-600/50 group-hover:border-purple-500/50 transition-colors object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-base font-semibold text-gray-200 group-hover:text-purple-400 transition-colors">
                            ${ranking.usuario}
                        </div>
                        <div class="text-sm text-gray-500">
                            ${ranking.nickname || 'Sin nickname'}
                        </div>
                    </div>
                </div>
            </td>
            
            <td class="px-4 py-4 text-left relative">
                <div class="max-w-xs">
                    <div class="text-sm text-gray-300 font-medium truncate" title="${ranking.universidad}">
                        ${ranking.universidad}
                    </div>
                    <div class="text-xs text-gray-500">
                        Institución educativa
                    </div>
                </div>
            </td>
            
            <td class="px-4 py-4 whitespace-nowrap text-center relative">
                <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-black shadow-lg border-2 transform group-hover:scale-105 transition-transform ${pointsStyle}">
                    ${ranking.puesto <= 3 ? '<i class="fas fa-star mr-2 text-sm"></i>' : ''}
                    ${ranking.total_puntos}
                </span>
            </td>
        `;

        return tr;
    }

    createQuickViewItem(ranking, index) {
        const div = document.createElement('div');
        const colors = ['yellow', 'gray', 'orange'];
        const color = colors[index];

        div.className = `flex items-center space-x-3 p-4 rounded-xl bg-gradient-to-r from-${color}-900/20 to-${color}-800/20 border border-${color}-500/30`;

        div.innerHTML = `
            <div class="relative">
                <img src="${ranking.profile_photo_url}"
                    alt="${ranking.usuario}"
                    class="w-10 h-10 rounded-full border-2 border-${color}-400/50 object-cover">
                <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full flex items-center justify-center bg-${color}-400">
                    <i class="fas ${index === 0 ? 'fa-crown' : 'fa-medal'} text-white text-xs"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-bold text-${color}-300 truncate">
                    ${ranking.usuario}
                </div>
                <div class="text-xs text-gray-400">
                    ${ranking.puesto}° lugar • ${ranking.total_puntos} pts
                </div>
            </div>
        `;

        return div;
    }

    getPositionIcon(puesto) {
        if (puesto == 1) {
            return '<div class="relative"><i class="fas fa-crown text-yellow-400 text-lg animate-pulse"></i><div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-300 rounded-full animate-ping"></div></div>';
        } else if (puesto == 2) {
            return '<i class="fas fa-medal text-gray-400 text-base"></i>';
        } else if (puesto == 3) {
            return '<i class="fas fa-medal text-orange-400 text-base"></i>';
        } else {
            return `<div class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center border border-slate-600 group-hover:border-purple-500/50 transition-colors"><span class="text-sm font-bold text-gray-400 group-hover:text-purple-400">${puesto}</span></div>`;
        }
    }

    getPointsStyle(puesto) {
        if (puesto == 1) {
            return 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-yellow-900 border-yellow-500 shadow-yellow-500/25';
        } else if (puesto == 2) {
            return 'bg-gradient-to-r from-gray-400 to-gray-600 text-gray-900 border-gray-500 shadow-gray-500/25';
        } else if (puesto == 3) {
            return 'bg-gradient-to-r from-orange-400 to-orange-600 text-orange-900 border-orange-500 shadow-orange-500/25';
        } else {
            return 'bg-gradient-to-r from-slate-600 to-slate-700 text-gray-200 border border-slate-500/50 shadow-lg group-hover:from-purple-600/20 group-hover:to-purple-700/20 group-hover:border-purple-500/50 transition-all';
        }
    }

    async updateRanking() {
        if (this.isUpdating) return;

        this.isUpdating = true;
        this.showUpdateIndicator();

        try {
            await Promise.all([
                this.updateTable(),
                this.updateStats()
            ]);

            console.log('✅ Ranking actualizado correctamente');
        } catch (error) {
            console.error('❌ Error general al actualizar ranking:', error);
        } finally {
            this.isUpdating = false;
            this.hideUpdateIndicator();
        }
    }

    showUpdateIndicator() {
        const indicators = document.querySelectorAll('.w-3.h-3.bg-green-400');
        indicators.forEach(indicator => {
            indicator.classList.remove('bg-green-400');
            indicator.classList.add('bg-orange-400');
        });
    }

    hideUpdateIndicator() {
        const indicators = document.querySelectorAll('.w-3.h-3.bg-orange-400');
        indicators.forEach(indicator => {
            indicator.classList.remove('bg-orange-400');
            indicator.classList.add('bg-green-400');
        });
    }

    startAutoUpdate() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }

        setTimeout(() => this.updateRanking(), 2000);

        this.intervalId = setInterval(() => {
            this.updateRanking();
        }, this.updateInterval);
    }

    setupVisibilityListener() {
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                console.log('🔄 Página visible - Actualizando ranking...');
                setTimeout(() => this.updateRanking(), 500);
            }
        });
    }

    destroy() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }

        console.log('🏆 Ranking Manager destruido');
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
    if (window.hasRankings) {
        window.rankingManager = new RankingManager();
    }
});

// Limpiar al salir de la página
window.addEventListener('beforeunload', function () {
    if (window.rankingManager) {
        window.rankingManager.destroy();
    }
});
<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 -mx-6 -my-4 px-6 py-8">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <i class="fas fa-user-circle text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-white leading-tight">
                        Perfil del Hacker
                    </h2>
                    <p class="text-emerald-100 font-medium">Dashboard personal de rendimiento</p>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Main Profile Container -->
    <div class="min-h-screen bg-gradient-to-br from-blue-300 via-emerald-200 to-blue-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Profile Card -->
            <div class="relative mb-12">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl opacity-90">
                </div>


                <!-- Content -->
                <div class="relative p-8 lg:p-12 text-white">
                    <div
                        class="flex flex-col lg:flex-row items-start lg:items-center justify-between space-y-6 lg:space-y-0">

                        <!-- User Info -->
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                <div
                                    class="w-20 h-20 lg:w-24 lg:h-24 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border-4 border-white/30">
                                    <i class="fas fa-user-ninja text-4xl lg:text-5xl text-white"></i>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-400 rounded-full flex items-center justify-center border-4 border-white">
                                    <i class="fas fa-shield-alt text-xs text-white"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-3xl lg:text-4xl font-black mb-2">{{ $usuario->usuario }}</h3>
                                <p class="text-emerald-100 text-lg font-medium flex items-center">
                                    <i class="fas fa-at mr-2"></i>
                                    {{ $usuario->perfil?->persona?->nombres }} {{ $usuario->perfil?->persona?->ape_paterno }} {{ $usuario->perfil?->persona?->ape_materno }}
                                </p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span
                                        class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $estado?->name_state ?? 'Desconocido' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-6 lg:gap-8">
                            <div class="text-center">
                                <div id="puntos" class="text-3xl lg:text-4xl font-black mb-1 text-white">
                                    <i class="fas fa-star">{{ $miPuntaje }}</i>
                                </div>
                                <p class="text-emerald-100 text-sm font-medium">Puntos Totales</p>
                            </div>
                            <div class="text-center">
                                <div id="puesto" class="text-3xl lg:text-4xl font-black mb-1 text-white">
                                    <i class="fas fa-medal ">{{ $miPuesto }}</i>
                                </div>
                                <p class="text-emerald-100 text-sm font-medium">Ranking Global</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <!-- Main Content Area -->
                <div class="xl:col-span-2 space-y-8">

                    <!-- Challenges Solved Table -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-5 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-emerald-100 rounded-lg">
                                        <i class="fas fa-trophy text-emerald-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Retos Completados</h3>
                                        <p class="text-gray-600 text-sm">Historial de desafíos resueltos</p>
                                    </div>
                                </div>
                                <div
                                    class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-fire mr-1"></i>
                                    En progreso
                                </div>
                            </div>
                        </div>

                        <div class="w-full border border-gray-200 rounded-md overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-puzzle-piece mr-2 text-emerald-600"></i>Reto
                                        </th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-tags mr-2 text-blue-600"></i>Categoría
                                        </th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-star mr-2 text-yellow-600"></i>Puntos
                                        </th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-clock mr-2 text-purple-600"></i>Tiempo
                                        </th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            <i class="fas fa-check-circle mr-2 text-green-600"></i>Estado
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="max-h-40 overflow-y-auto">
                                <table class="w-full">
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @forelse($registrosResueltos as $registro)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $registro->nombre_reto }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                                {{ $registro->nomcategoria }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                                {{ $registro->puntos }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                                {{ $registro->time }} s
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                                {{ $registro->estado_reto }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                No has resuelto ningún reto aún.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- Performance Chart -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-5 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <i class="fas fa-chart-line text-blue-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Evolución de Puntuación</h3>
                                    <p class="text-gray-600 text-sm">Progreso temporal de tu rendimiento</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="relative h-80">
                                <canvas id="scoreChart"></canvas>
                            </div>
                            <div class="mt-4 flex items-center justify-center space-x-6 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-emerald-400 rounded-full mr-2"></div>
                                    <span>Área de puntuación</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-0.5 bg-emerald-600 mr-2"></div>
                                    <span>Tendencia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">

                    <!-- Category Performance -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-5 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <i class="fas fa-chart-pie text-purple-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Rendimiento por Categoría</h3>
                                    <p class="text-gray-600 text-sm">Análisis de aciertos</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Category Selector -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-filter mr-2 text-gray-600"></i>
                                    Seleccionar Categoría
                                </label>
                                <select id="categoriaselect"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                    onchange="actualizarProgreso()">
                                    <option value="" disabled selected>Elige una categoría...</option>
                                </select>
                            </div>

                            <!-- Progress Bar -->
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm font-semibold text-gray-700">Porcentaje de Éxito</span>
                                    <span id="barrita-text" class="text-sm font-bold text-emerald-600">0%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                    <div id="barrita"
                                        class="bg-gradient-to-r from-emerald-500 to-teal-500 h-3 rounded-full transition-all duration-700 ease-out flex items-center justify-center"
                                        style="width: 0%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-5 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-amber-100 rounded-lg">
                                    <i class="fas fa-bolt text-amber-600 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Estadísticas Rápidas</h3>
                                    <p class="text-gray-600 text-sm">Resumen de actividad</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 space-y-4">
                            <div
                                class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Retos Resueltos</span>
                                </div>
                                <span id="retos-resueltos" class="text-2xl font-black text-green-600">{{ $cantidadRetos }}</span>
                            </div>

                            <div
                                class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-layer-group text-blue-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Categorías Jugadas</span>
                                </div>
                                <span id="categorias-activas" class="text-2xl font-black text-blue-600">{{ $categoriasJugadas }}</span>
                            </div>

                            <div class="flex items-center justify-between py-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-medal text-purple-600"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">Mejor Puntuación</span>
                                </div>
                                <span id="mejor-puntuacion" class="text-2xl font-black text-purple-600">{{ $mejorPuntaje }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    

    
    function getStatusConfig(resultado) {
        const configs = {
            'Flag Encontrada': {
                bg: 'bg-green-100',
                color: 'text-green-800',
                icon: 'fas fa-check-circle',
                text: 'Completado'
            },
            'Tiempo agotado': {
                bg: 'bg-yellow-100',
                color: 'text-yellow-800',
                icon: 'fas fa-clock',
                text: 'Tiempo agotado'
            }
        };
        return configs[resultado] || {
            bg: 'bg-red-100',
            color: 'text-red-800',
            icon: 'fas fa-times-circle',
            text: 'Fallido'
        };
    }

    function getCategoryConfig(categoria) {
        const configs = {
            'Criptografía': {
                bg: 'bg-blue-100',
                color: 'text-blue-600',
                icon: 'fas fa-lock'
            },
            'Esteganografía': {
                bg: 'bg-purple-100',
                color: 'text-purple-600',
                icon: 'fas fa-eye-slash'
            },
            'Web Exploitation': {
                bg: 'bg-red-100',
                color: 'text-red-600',
                icon: 'fas fa-globe'
            },
            'OSINT': {
                bg: 'bg-green-100',
                color: 'text-green-600',
                icon: 'fas fa-satellite-dish'
            },
            'Forense Digital': {
                bg: 'bg-indigo-100',
                color: 'text-indigo-600',
                icon: 'fas fa-search-plus'
            },
            'Knowledge Check': {
                bg: 'bg-yellow-100',
                color: 'text-yellow-600',
                icon: 'fas fa-brain'
            }
        };
        return configs[categoria] || {
            bg: 'bg-gray-100',
            color: 'text-gray-600',
            icon: 'fas fa-question'
        };
    }

    function updateQuickStats(results) {
        // Retos resueltos
        const retosResueltos = results.filter(r => r.resultado === 'Flag Encontrada').length;
        document.getElementById('retos-resueltos').textContent = retosResueltos;

        // Categorías activas
        const categoriasUnicas = [...new Set(results.map(r => r.nomcategoria))].length;
        document.getElementById('categorias-activas').textContent = categoriasUnicas;

        // Mejor puntuación
        const mejorPuntuacion = Math.max(...results.map(r => parseInt(r.puntos) || 0));
        document.getElementById('mejor-puntuacion').textContent = mejorPuntuacion > 0 ? mejorPuntuacion : 0;
    }

    
    
    // Chart.js configuration
    const chartLabels = @json($chartData->pluck('nombre'));
    const chartPuntos = @json($chartData->pluck('puntos'));
    const chartTiempo = @json($chartData->pluck('tiempo'));
    const ctx = document.getElementById('scoreChart').getContext('2d');
    const scoreChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartTiempo,
            datasets: [{
                label: 'Puntuación',
                data: chartPuntos,
                fill: true,
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: 'rgb(16, 185, 129)',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            family: 'Inter, sans-serif',
                            size: 12
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            family: 'Inter, sans-serif',
                            size: 12
                        },
                        padding: 10
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 8,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        title: function(context) {
                            return `Fecha: ${context[0].label}`;
                        },
                        label: function(context) {
                            return `Puntos: ${context.parsed.y}`;
                        }
                    }
                }
            }
        }
    });

    const categorias = @json($categoriasData);
    const porcentajes = @json($porcentajes);
    document.addEventListener("DOMContentLoaded", function () {
        const categoriaSelect = document.getElementById("categoriaselect");

        categorias.forEach(categoria => {
            const option = document.createElement("option");
            option.value = categoria.idcategoria;
            option.textContent = categoria.nomcategoria;
            categoriaSelect.appendChild(option);
        });
    });

    function actualizarProgreso() {
        const select = document.getElementById("categoriaselect");
        const bar = document.getElementById("barrita");
        const barText = document.getElementById("barrita-text");

        const selected = select.value;
        const porcentaje = porcentajes[selected] ?? 0;

        bar.style.width = porcentaje + "%";
        barText.textContent = porcentaje + "%";
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        //cargarCategorias();
        
    });
</script>

<style>
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Loading animation */
    @keyframes pulse-gentle {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .fa-spinner {
        animation: pulse-gentle 1.5s ease-in-out infinite;
    }
</style>

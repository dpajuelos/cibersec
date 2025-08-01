<x-app-layout>
    @section('title', 'Ranking-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ranking') }}
        </h2>
    </x-slot>

    <!-- Hero Section for Ranking -->
    <div class="relative bg-gradient-to-br from-yellow-900 via-orange-9 00 to-red-900 py-16 overflow-hidden">
        <!-- Advanced Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_2px_2px,rgba(255,215,0,0.4)_2px,transparent_0)] bg-[length:30px_30px]">
            </div>
        </div>

        <!-- Trophy particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-16 left-16 w-6 h-6 bg-yellow-400/30 rounded-full animate-bounce animation-delay-200">
            </div>
            <div
                class="absolute top-32 right-20 w-4 h-4 bg-orange-400/40 rounded-full animate-pulse animation-delay-500">
            </div>
            <div class="absolute bottom-20 left-1/4 w-5 h-5 bg-red-400/30 rounded-full animate-ping animation-delay-800">
            </div>
            <div
                class="absolute top-24 right-1/3 w-3 h-3 bg-yellow-300/50 rounded-full animate-bounce animation-delay-1200">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Champion Badge -->
                <div
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-600/30 to-orange-600/30 border border-yellow-400/40 rounded-full text-yellow-400 text-sm font-bold mb-8 backdrop-blur-sm hover:from-yellow-600/40 hover:to-orange-600/40 hover:border-yellow-300/60 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-yellow-500/20">
                    <i class="fas fa-trophy mr-3 text-yellow-400 animate-pulse text-lg"></i>
                    <span>Hall of Fame CiberSecUnasam</span>
                    <i class="fas fa-crown  ml-3 text-yellow-400 animate-bounce"></i>
                </div>

                <!-- Title with special effects -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-8 leading-tight relative">
                    <span
                        class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 text-transparent bg-clip-text drop-shadow-2xl animate-gradient-x relative">
                        RANKING
                        <!-- Glow effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 opacity-20 blur-xl animate-pulse">
                        </div>
                    </span>
                    <br>
                    <span class="text-white drop-shadow-lg text-3xl md:text-4xl lg:text-5xl">Elite Hackers</span>
                </h1>

                <!-- Subtitle with medal icons -->
                <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12">
                    Los mejores hackers éticos de nuestra comunidad.
                    <span class="text-yellow-400 font-bold relative inline-flex items-center">
                        <i class="fas fa-medal mr-2 animate-spin-slow"></i>
                        Solo los más dedicados
                        <i class="fas fa-star ml-2 animate-pulse"></i>
                    </span>
                    llegan al top del ranking.
                </p>

                <!-- Podium Preview -->
                <div class="flex justify-center items-end space-x-4 mb-8">
                    <!-- 2nd Place -->
                    <div
                        class="group bg-gradient-to-t from-gray-600/30 to-gray-400/30 backdrop-blur-md rounded-t-2xl p-4 border border-gray-400/40 hover:border-gray-300/60 transition-all duration-500 hover:scale-105 relative">
                        <div class="text-center">
                            <i
                                class="fas fa-medal text-gray-400 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                            <div class="text-lg font-bold text-gray-300">2°</div>
                            <div class="text-xs text-gray-400">Plata</div>
                        </div>
                        <div class="absolute -top-2 -right-2 w-4 h-4 bg-gray-400/20 rounded-full animate-pulse"></div>
                    </div>

                    <!-- 1st Place -->
                    <div
                        class="group bg-gradient-to-t from-yellow-600/40 to-yellow-400/40 backdrop-blur-md rounded-t-2xl p-6 border border-yellow-400/50 hover:border-yellow-300/70 transition-all duration-500 hover:scale-110 relative transform translate-y-2">
                        <div class="text-center">
                            <i
                                class="fas fa-crown text-yellow-400 text-3xl mb-3 group-hover:scale-110 transition-transform animate-pulse"></i>
                            <div class="text-2xl font-black text-yellow-300">1°</div>
                            <div class="text-sm text-yellow-400 font-bold">Oro</div>
                        </div>
                        <div class="absolute -top-3 -right-3 w-6 h-6 bg-yellow-400/30 rounded-full animate-ping"></div>
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-yellow-300 rounded-full animate-bounce">
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div
                        class="group bg-gradient-to-t from-orange-600/30 to-orange-400/30 backdrop-blur-md rounded-t-2xl p-4 border border-orange-400/40 hover:border-orange-300/60 transition-all duration-500 hover:scale-105 relative">
                        <div class="text-center">
                            <i
                                class="fas fa-medal text-orange-400 text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                            <div class="text-lg font-bold text-orange-300">3°</div>
                            <div class="text-xs text-orange-400">Bronce</div>
                        </div>
                        <div class="absolute -top-2 -left-2 w-4 h-4 bg-orange-400/20 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gradient-to-b from-slate-800 to-slate-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-gradient-to-br from-yellow-900/40 to-orange-900/30 backdrop-blur-md rounded-2xl p-6 border border-yellow-500/30 hover:border-yellow-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20 relative overflow-hidden group">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-orange-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <i
                                class="fas fa-trophy text-yellow-400 text-3xl group-hover:scale-110 transition-transform"></i>
                            <div class="text-2xl font-black text-yellow-400">TOP 5</div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Mejores Participantes</div>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-purple-900/40 to-blue-900/30 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30 hover:border-purple-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 relative overflow-hidden group">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-400/5 to-blue-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <i
                                class="fas fa-chart-line text-purple-400 text-3xl group-hover:scale-110 transition-transform"></i>
                            <div class="text-2xl font-black text-purple-400">LIVE</div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Actualización en Tiempo Real</div>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-green-900/40 to-cyan-900/30 backdrop-blur-md rounded-2xl p-6 border border-green-500/30 hover:border-green-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20 relative overflow-hidden group">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-400/5 to-cyan-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <i
                                class="fas fa-users text-green-400 text-3xl group-hover:scale-110 transition-transform"></i>
                            <div class="text-2xl font-black text-green-400">{{ count($rankings) }}</div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Participantes Activos</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Enhanced Chart Section -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden relative">
                        <!-- Chart header -->
                        <div
                            class="bg-gradient-to-r from-yellow-900/30 via-orange-900/20 to-red-900/30 p-6 border-b border-slate-700/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-yellow-400 flex items-center">
                                        <i class="fas fa-chart-bar mr-3 text-yellow-400"></i>
                                        Visualización del Ranking
                                    </h3>
                                    <p class="text-gray-400 text-sm mt-1">Gráfico en tiempo real de los mejores hackers
                                    </p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-xs text-gray-400">En vivo</span>
                                </div>
                            </div>
                        </div>

                        <!-- Chart container -->
                        <div class="p-8">
                            <div class="bg-slate-900/50 rounded-2xl p-6 border border-slate-600/30">
                                <canvas id="rankingChart" class="w-full h-96"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Table Section -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden relative">
                        <!-- Table header -->
                        <div
                            class="bg-gradient-to-r from-purple-900/30 via-blue-900/20 to-cyan-900/30 p-6 border-b border-slate-700/50">
                            <h3 class="text-xl font-bold text-purple-400 flex items-center">
                                <i class="fas fa-list-ol mr-3 text-purple-400"></i>
                                Tabla de Posiciones
                            </h3>
                            <p class="text-gray-400 text-sm mt-1">Top performers de la comunidad</p>
                        </div>

                        <!-- Enhanced Table -->
                        <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                            <table class="min-w-full">
                                <thead
                                    class="bg-slate-900/60 border-b border-slate-700/50 sticky top-0 backdrop-blur-sm">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-hashtag text-yellow-400"></i>
                                                <span>Pos</span>
                                            </div>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-user-ninja text-purple-400"></i>
                                                <span>Usuario</span>
                                            </div>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-user-ninja text-purple-400"></i>
                                                <span>Universidad</span>
                                            </div>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <span>Puntos</span>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/50" id="rankingTableBody">
                                    @foreach ($rankings as $index => $ranking)
                                        <tr class="group hover:bg-gradient-to-r hover:from-slate-700/30 hover:to-slate-600/20 transition-all duration-500 cursor-pointer relative overflow-hidden"
                                            onclick="openModal('{{ $ranking->usuario }}'">

                                            <!-- Position -->
                                            <td class="px-6 py-4 whitespace-nowrap text-center relative">
                                                <div class="flex items-center justify-center">
                                                    @if ($ranking->puesto == 1)
                                                        <div class="relative">
                                                            <i
                                                                class="fas fa-crown text-yellow-400 text-xl animate-pulse"></i>
                                                            <div
                                                                class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-300 rounded-full animate-ping">
                                                            </div>
                                                        </div>
                                                    @elseif($ranking->puesto == 2)
                                                        <i class="fas fa-medal text-gray-400 text-lg"></i>
                                                    @elseif($ranking->puesto == 3)
                                                        <i class="fas fa-medal text-orange-400 text-lg"></i>
                                                    @else
                                                        <div
                                                            class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center border border-slate-600 group-hover:border-purple-500/50 transition-colors">
                                                            <span
                                                                class="text-sm font-bold text-gray-400 group-hover:text-purple-400">{{ $ranking->puesto }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>

                                            <!-- Nickname -->
                                            <td class="px-6 py-4 text-center relative">
                                                <div
                                                    class="font-mono text-sm font-bold text-gray-300 group-hover:text-purple-400 transition-colors duration-300 bg-slate-900/30 px-3 py-2 rounded-lg border border-slate-600/30 group-hover:border-purple-500/50 backdrop-blur-sm">
                                                    <i
                                                        class="fas fa-user-ninja mr-2 text-purple-400 group-hover:scale-110 transition-transform"></i>
                                                    {{ $ranking->nickname }}
                                                </div>
                                            </td>

                                            <!-- Points -->
                                            <td class="px-6 py-4 whitespace-nowrap text-center relative">
                                                @if ($ranking->puesto <= 3)
                                                    <span
                                                        class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-black shadow-lg border-2 transform group-hover:scale-105 transition-transform
                                                    {{ $ranking->puesto == 1
                                                        ? 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-yellow-900 border-yellow-500 shadow-yellow-500/25'
                                                        : ($ranking->puesto == 2
                                                            ? 'bg-gradient-to-r from-gray-400 to-gray-600 text-gray-900 border-gray-500 shadow-gray-500/25'
                                                            : 'bg-gradient-to-r from-orange-400 to-orange-600 text-orange-900 border-orange-500 shadow-orange-500/25') }}">
                                                        <i class="fas fa-star mr-2"></i>
                                                        {{ $ranking->total_puntos }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-gradient-to-r from-slate-600 to-slate-700 text-gray-200 border border-slate-500/50 shadow-lg group-hover:from-purple-600/20 group-hover:to-purple-700/20 group-hover:border-purple-500/50 transition-all">
                                                        {{ $ranking->total_puntos }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modal -->
    @include('layouts.userModal')

    <!-- Enhanced Scripts -->
    <script>
        const ctx1 = document.getElementById('rankingChart').getContext('2d');

        // Create gradient for chart
        const gradient = ctx1.createLinearGradient(0, 0, 400, 0);
        gradient.addColorStop(0, 'rgba(255, 215, 0, 0.8)');
        gradient.addColorStop(0.5, 'rgba(255, 165, 0, 0.8)');
        gradient.addColorStop(1, 'rgba(255, 69, 0, 0.8)');

        const rankingChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Puntos',
                    data: [],
                    backgroundColor: gradient,
                    borderColor: [
                        'rgba(255, 215, 0, 1)',
                        'rgba(192, 192, 192, 1)',
                        'rgba(205, 127, 50, 1)',
                        'rgba(138, 43, 226, 1)',
                        'rgba(30, 144, 255, 1)',
                    ],
                    borderWidth: 3,
                    borderRadius: 20,
                    borderSkipped: false,
                    barThickness: 40,
                    hoverBackgroundColor: 'rgba(255, 215, 0, 0.9)',
                    hoverBorderColor: 'rgba(255, 215, 0, 1)',
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        titleColor: '#FFD700',
                        bodyColor: '#fff',
                        borderColor: '#FFD700',
                        borderWidth: 2,
                        cornerRadius: 10,
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return `🏆 ${context[0].label}`;
                            },
                            label: function(context) {
                                return `⭐ ${context.raw} puntos`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            borderColor: 'rgba(255, 255, 255, 0.2)'
                        },
                        ticks: {
                            stepSize: 10,
                            font: {
                                size: 12,
                                weight: 'bold',
                                family: 'Inter'
                            },
                            color: '#FFD700',
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)',
                            borderColor: 'rgba(255, 255, 255, 0.2)'
                        },
                        ticks: {
                            font: {
                                size: 14,
                                weight: 'bold',
                                family: 'Inter'
                            },
                            color: '#fff',
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce',
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Enhanced update function
        function updateRanking() {
            // Add loading animation
            document.querySelectorAll('.animate-pulse').forEach(el => {
                el.classList.add('animate-spin');
            });

            fetch('/rankings/top5')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(ranking => ranking.nickname);
                    const points = data.map(ranking => ranking.total_puntos);

                    rankingChart.data.labels = labels;
                    rankingChart.data.datasets[0].data = points;
                    rankingChart.update('active');
                })
                .catch(error => {
                    console.error('Error al obtener los datos del ranking:', error);
                });

            fetch('/ranking')
                .then(response => response.json())
                .then(data => {
                    let tbody = document.getElementById('rankingTableBody');
                    tbody.innerHTML = '';

                    data.forEach((ranking, index) => {
                        let positionIcon = '';
                        let pointsStyle = '';

                        if (ranking.puesto == 1) {
                            positionIcon =
                                '<div class="relative"><i class="fas fa-crown text-yellow-400 text-xl animate-pulse"></i><div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-300 rounded-full animate-ping"></div></div>';
                            pointsStyle =
                                'bg-gradient-to-r from-yellow-400 to-yellow-600 text-yellow-900 border-yellow-500 shadow-yellow-500/25';
                        } else if (ranking.puesto == 2) {
                            positionIcon = '<i class="fas fa-medal text-gray-400 text-lg"></i>';
                            pointsStyle =
                                'bg-gradient-to-r from-gray-400 to-gray-600 text-gray-900 border-gray-500 shadow-gray-500/25';
                        } else if (ranking.puesto == 3) {
                            positionIcon = '<i class="fas fa-medal text-orange-400 text-lg"></i>';
                            pointsStyle =
                                'bg-gradient-to-r from-orange-400 to-orange-600 text-orange-900 border-orange-500 shadow-orange-500/25';
                        } else {
                            positionIcon =
                                `<div class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center border border-slate-600 group-hover:border-purple-500/50 transition-colors"><span class="text-sm font-bold text-gray-400 group-hover:text-purple-400">${ranking.puesto}</span></div>`;
                            pointsStyle =
                                'bg-gradient-to-r from-slate-600 to-slate-700 text-gray-200 border border-slate-500/50 shadow-lg group-hover:from-purple-600/20 group-hover:to-purple-700/20 group-hover:border-purple-500/50';
                        }

                        tbody.innerHTML += `
                            <tr class="group hover:bg-gradient-to-r hover:from-slate-700/30 hover:to-slate-600/20 transition-all duration-500 cursor-pointer relative overflow-hidden animate-fade-in"
                                onclick="openModal('${ranking.usuario}', '${ranking.nickname}')" style="animation-delay: ${index * 100}ms">
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center relative">
                                    <div class="flex items-center justify-center">${positionIcon}</div>
                                </td>
                                
                                <td class="px-6 py-4 text-center relative">
                                    <div class="font-mono text-sm font-bold text-gray-300 group-hover:text-purple-400 transition-colors duration-300 bg-slate-900/30 px-3 py-2 rounded-lg border border-slate-600/30 group-hover:border-purple-500/50 backdrop-blur-sm">
                                        <i class="fas fa-user-ninja mr-2 text-purple-400 group-hover:scale-110 transition-transform"></i>
                                        ${ranking.nickname}
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center relative">
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-black shadow-lg border-2 transform group-hover:scale-105 transition-transform ${pointsStyle}">
                                        ${ranking.puesto <= 3 ? '<i class="fas fa-star mr-2"></i>' : ''}
                                        ${ranking.total_puntos}
                                    </span>
                                </td>
                            </tr>
                        `;
                    });

                    // Remove loading animations
                    setTimeout(() => {
                        document.querySelectorAll('.animate-spin').forEach(el => {
                            el.classList.remove('animate-spin');
                        });
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error al obtener los datos del ranking:', error);
                });
        }

        // Update every 10 seconds
        setInterval(updateRanking, 10000);

        // Initial load
        updateRanking();
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
            opacity: 0;
        }

        .animation-delay-200 {
            animation-delay: 200ms;
        }

        .animation-delay-500 {
            animation-delay: 500ms;
        }

        .animation-delay-800 {
            animation-delay: 800ms;
        }

        .animation-delay-1200 {
            animation-delay: 1200ms;
        }

        @keyframes gradient-x {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .animate-gradient-x {
            animation: gradient-x 3s ease infinite;
            background-size: 200% 200%;
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 3s linear infinite;
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgb(51 65 85 / 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #f59e0b, #d97706);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #fbbf24, #f59e0b);
        }
    </style>
</x-app-layout>

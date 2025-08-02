<x-app-layout>
    @push('styles')
        @vite('resources/css/retos/retos-styles.css')
    @endpush

    @push('scripts')
        @vite('resources/js/retos/retos-manager.js')
        <script>
            window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
            window.userRegisteredInCompetition = {{ isset($usuarioRegistrado) && $usuarioRegistrado ? 'true' : 'false' }};
            window.competitionId = {{ $competenciaActiva ? $competenciaActiva->idcompetencia : 'null' }};
            console.log('Variables globales:', {
                isLoggedIn: window.isLoggedIn,
                userRegisteredInCompetition: window.userRegisteredInCompetition,
                competitionId: window.competitionId
            });
        </script>
    @endpush

    @php
        $coloresPorCategoria = [
            'Web' => [
                'gradient' => 'from-red-600/30 to-pink-600/20',
                'border' => 'border-red-400/50',
                'shadow' => 'shadow-red-500/20',
                'text' => 'text-red-400',
                'bg' => 'bg-red-900/20',
                'icon' => 'fas fa-globe',
                'hoverGradient' => 'from-red-600/50 to-pink-600/40',
            ],
            'Criptografía' => [
                'gradient' => 'from-blue-600/30 to-cyan-600/20',
                'border' => 'border-blue-400/50',
                'shadow' => 'shadow-blue-500/20',
                'text' => 'text-blue-400',
                'bg' => 'bg-blue-900/20',
                'icon' => 'fas fa-lock',
                'hoverGradient' => 'from-blue-600/50 to-cyan-600/40',
            ],
            'Esteganografía' => [
                'gradient' => 'from-teal-600/30 to-green-600/20',
                'border' => 'border-teal-400/50',
                'shadow' => 'shadow-teal-500/20',
                'text' => 'text-teal-400',
                'bg' => 'bg-teal-900/20',
                'icon' => 'fas fa-eye-slash',
                'hoverGradient' => 'from-teal-600/50 to-green-600/40',
            ],
            'OSINT' => [
                'gradient' => 'from-indigo-600/30 to-purple-600/20',
                'border' => 'border-indigo-400/50',
                'shadow' => 'shadow-indigo-500/20',
                'text' => 'text-indigo-400',
                'bg' => 'bg-indigo-900/20',
                'icon' => 'fas fa-search',
                'hoverGradient' => 'from-indigo-600/50 to-purple-600/40',
            ],
            'Trivias' => [
                'gradient' => 'from-yellow-600/30 to-orange-600/20',
                'border' => 'border-yellow-400/50',
                'shadow' => 'shadow-yellow-500/20',
                'text' => 'text-yellow-400',
                'bg' => 'bg-yellow-900/20',
                'icon' => 'fas fa-question-circle',
                'hoverGradient' => 'from-yellow-600/50 to-orange-600/40',
            ],
        ];
    @endphp

    @section('title', 'Retos-CiberSecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Retos') }}
        </h2>
    </x-slot>

    <!-- Hero Section for Challenges -->
    <div class="relative bg-gradient-to-br from-purple-900 via-indigo-900 to-blue-900 py-16 overflow-hidden">
        <!-- Advanced Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_2px_2px,rgba(168,85,247,0.4)_2px,transparent_0)] bg-[length:25px_25px]">
            </div>
        </div>

        <!-- Code particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-20 w-5 h-5 bg-purple-400/30 rounded-full animate-pulse animation-delay-300">
            </div>
            <div
                class="absolute top-32 right-24 w-3 h-3 bg-indigo-400/40 rounded-full animate-bounce animation-delay-600">
            </div>
            <div
                class="absolute bottom-24 left-1/4 w-4 h-4 bg-blue-400/30 rounded-full animate-ping animation-delay-900">
            </div>
            <div
                class="absolute top-28 right-1/3 w-6 h-6 bg-cyan-300/20 rounded-full animate-pulse animation-delay-1200">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Enhanced Challenge Badge with Competition Info -->
                <div
                    class="inline-flex flex-col items-center px-8 py-4 bg-gradient-to-r from-purple-600/30 to-indigo-600/30 border border-purple-400/40 rounded-2xl text-purple-400 text-sm font-bold mb-8 backdrop-blur-sm hover:from-purple-600/40 hover:to-indigo-600/40 hover:border-purple-300/60 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-500/20">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-flag mr-3 text-purple-400 animate-pulse text-lg"></i>
                        <span>CTF Challenges Hub</span>
                        <i class="fas fa-code ml-3 text-purple-400 animate-bounce"></i>
                    </div>

                    @if ($competenciaActiva)
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-cyan-400 mb-2">{{ $competenciaActiva->nomcompe }}</h3>
                            <div class="flex items-center justify-center space-x-4 text-xs">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt mr-1 text-green-400"></i>
                                    <span class="text-gray-300">Inicio:
                                        {{ \Carbon\Carbon::parse($competenciaActiva->fec_inicio)->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-times mr-1 text-red-400"></i>
                                    <span class="text-gray-300">Fin:
                                        {{ \Carbon\Carbon::parse($competenciaActiva->fec_final)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>

                            @auth
                                @if (!$usuarioRegistrado)
                                    <button onclick="registrarseEnCompetencia()"
                                        class="mt-4 inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-green-500/25">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        ¡Únete al Desafío!
                                    </button>
                                @else
                                    <div
                                        class="mt-4 inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-600/20 to-emerald-600/20 border border-green-500/30 rounded-xl backdrop-blur-sm">
                                        <i class="fas fa-check-circle mr-2 text-green-400"></i>
                                        <span class="text-green-400 font-medium">¡Ya estás participando!</span>
                                    </div>
                                @endif
                            @else
                                <div class="mt-4 text-sm text-gray-400">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Inicia sesión para participar
                                </div>
                            @endauth
                        </div>
                    @else
                        <div class="text-center">
                            <span class="text-gray-400 text-sm">No hay competencias activas</span>
                        </div>
                    @endif
                </div>

                <!-- Title with special effects -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-8 leading-tight relative">
                    <span
                        class="bg-gradient-to-r from-purple-400 via-indigo-400 to-cyan-400 text-transparent bg-clip-text drop-shadow-2xl animate-gradient-x relative">
                        RETOS
                        <!-- Glow effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-purple-400 via-indigo-400 to-cyan-400 opacity-20 blur-xl animate-pulse">
                        </div>
                    </span>
                    <br>
                    <span class="text-white drop-shadow-lg text-3xl md:text-4xl lg:text-5xl">Ciberseguridad</span>
                </h1>

                <!-- Subtitle with code icons -->
                <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12">
                    Desafía tus habilidades con nuestros retos de ciberseguridad.
                    <span class="text-purple-400 font-bold relative inline-flex items-center">
                        <i class="fas fa-terminal mr-2"></i>
                        Desde principiante hasta experto
                        <i class="fas fa-shield-alt ml-2 animate-pulse"></i>
                    </span>
                    encuentra tu nivel perfecto.
                </p>

                <!-- Enhanced Stats Overview -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto mb-8">
                    <div
                        class="bg-gradient-to-br from-purple-600/20 to-indigo-600/20 backdrop-blur-sm rounded-xl p-4 border border-purple-500/30">
                        <div class="text-2xl font-bold text-purple-400">{{ $retosPorCategoria->flatten()->count() }}
                        </div>
                        <div class="text-sm text-gray-300">Retos Totales</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-600/20 to-emerald-600/20 backdrop-blur-sm rounded-xl p-4 border border-green-500/30">
                        <div class="text-2xl font-bold text-green-400">{{ $retosPorCategoria->count() }}</div>
                        <div class="text-sm text-gray-300">Categorías</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-yellow-600/20 to-orange-600/20 backdrop-blur-sm rounded-xl p-4 border border-yellow-500/30">
                        <div class="text-2xl font-bold text-yellow-400">
                            @php
                                $retosResueltos = 0;

                                if (Auth::check() && $usuarioRegistrado) {
                                    $retosResueltos = $retosPorCategoria->flatten()->where('resuelto', 1)->count();
                                }
                            @endphp
                            {{ $retosResueltos }}
                        </div>
                        <div class="text-sm text-gray-300">Resueltos</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-red-600/20 to-pink-600/20 backdrop-blur-sm rounded-xl p-4 border border-red-500/30">
                        <div class="text-2xl font-bold text-red-400">
                            @php
                                $retosPendientes = $retosPorCategoria->flatten()->count();
                                if (Auth::check() && $usuarioRegistrado) {
                                    $retosPendientes = $retosPorCategoria->flatten()->where('resuelto', 0)->count();
                                }

                            @endphp
                            {{ $retosPendientes }}
                        </div>
                        <div class="text-sm text-gray-300">Pendientes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gradient-to-b from-slate-800 to-slate-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search and Filter Section -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 mb-8 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/5 via-transparent to-indigo-600/5"></div>

                <div class="relative p-8 overflow-visible">
                    <div class="flex flex-col lg:flex-row gap-8 items-center justify-between overflow-visible">
                        <!-- Search Bar -->
                        <div class="w-full lg:w-96">
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                    <i
                                        class="fas fa-search text-gray-400 group-focus-within:text-purple-400 transition-all duration-300 group-focus-within:scale-110"></i>
                                </div>
                                <input type="search" name="buscar" id="searchInput"
                                    class="block w-full pl-12 pr-16 py-4 border border-slate-600/50 rounded-2xl bg-slate-900/50 placeholder-gray-400 text-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500/50 transition-all duration-300 backdrop-blur-sm hover:bg-slate-900/70 focus:bg-slate-900/80 shadow-inner"
                                    placeholder="Buscar retos por nombre...">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <button type="submit"
                                        class="group/btn p-3 text-gray-400 hover:text-purple-400 transition-all duration-300 hover:bg-purple-400/10 rounded-lg">
                                        <i
                                            class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                    </button>
                                </div>
                                <!-- Search highlight effect -->
                                <div
                                    class="absolute inset-0 rounded-2xl bg-gradient-to-r from-purple-400/10 to-indigo-400/10 opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none">
                                </div>
                            </div>
                        </div>

                        <!-- Filter Controls -->
                        <div class="flex items-center space-x-4 overflow-visible">
                            <!-- Category Filter Dropdown -->
                            <div class="relative overflow-visible">
                                <button id="categoryButton" onclick="toggleCategoryMenu()"
                                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600/20 to-purple-600/20 border border-indigo-500/30 rounded-2xl font-medium text-indigo-400 hover:from-indigo-600/40 hover:to-purple-600/40 hover:border-indigo-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 shadow-lg hover:shadow-indigo-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-indigo-400/5 to-purple-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-tags mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10">Categoría</span>
                                    <i
                                        class="fas fa-chevron-down ml-3 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="categoryMenu"
                                    class="hidden absolute top-full left-0 mt-2 w-64 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 z-[99999]">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-900/50">
                                            <i class="fas fa-filter mr-2 text-indigo-400"></i>
                                            Filtrar por Categoría
                                        </div>
                                        <button onclick="filterByCategory('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todas las categorías</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        @foreach ($coloresPorCategoria as $categoria => $colores)
                                            <button onclick="filterByCategory('{{ $categoria }}')"
                                                class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:{{ $colores['text'] }} transition-all duration-300 group/item">
                                                <i
                                                    class="{{ $colores['icon'] }} mr-3 {{ $colores['text'] }} group-hover/item:scale-110 transition-transform"></i>
                                                <span class="flex-1 text-left">{{ $categoria }}</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Difficulty Filter Dropdown -->
                            <div class="relative overflow-visible">
                                <button id="difficultyButton" onclick="toggleDifficultyMenu()"
                                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-600/20 to-red-600/20 border border-orange-500/30 rounded-2xl font-medium text-orange-400 hover:from-orange-600/40 hover:to-red-600/40 hover:border-orange-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500/50 shadow-lg hover:shadow-orange-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-orange-400/5 to-red-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-chart-line mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10">Dificultad</span>
                                    <i
                                        class="fas fa-chevron-down ml-3 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="difficultyMenu"
                                    class="hidden absolute top-full left-0 mt-2 w-56 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 z-[99999]">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-900/50">
                                            <i class="fas fa-signal mr-2 text-orange-400"></i>
                                            Nivel de Dificultad
                                        </div>
                                        <button onclick="filterByDifficulty('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todas las dificultades</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('easy')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-green-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-green-400 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Fácil (1-50 pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover:item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('medium')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-yellow-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <i class="fas fa-star text-yellow-400 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Medio (51-100 pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover:item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('hard')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-red-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-red-400 text-xs"></i>
                                                <i class="fas fa-star text-red-400 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-red-400 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Difícil (100+ pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover:item:opacity-100 transition-opacity"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="relative overflow-visible">
                                <button id="statusButton" onclick="toggleStatusMenu()"
                                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600/20 to-emerald-600/20 border border-green-500/30 rounded-2xl font-medium text-green-400 hover:from-green-600/40 hover:to-emerald-600/40 hover:border-green-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 shadow-lg hover:shadow-green-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-green-400/5 to-emerald-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-check-circle mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10">Estado</span>
                                    <i
                                        class="fas fa-chevron-down ml-3 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="statusMenu"
                                    class="hidden absolute top-full left-0 mt-2 w-48 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0 z-[99999]">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-900/50">
                                            <i class="fas fa-flag mr-2 text-green-400"></i>
                                            Estado del Reto
                                        </div>
                                        <button onclick="filterByStatus('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todos los retos</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByStatus('solved')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-green-400 transition-all duration-300 group/item">
                                            <div
                                                class="w-2 h-2 bg-green-400 rounded-full mr-3 group-hover/item:scale-110 transition-transform animate-pulse">
                                            </div>
                                            <span class="flex-1 text-left">Resueltos</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByStatus('unsolved')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-slate-700/50 hover:text-orange-400 transition-all duration-300 group/item">
                                            <div
                                                class="w-2 h-2 bg-orange-400 rounded-full mr-3 group-hover/item:scale-110 transition-transform">
                                            </div>
                                            <span class="flex-1 text-left">Pendientes</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Clear Filters Button -->
                            <button onclick="clearAllFilters()" id="clearFiltersBtn"
                                class="hidden group items-center px-8 py-4 bg-gradient-to-r from-gray-600/20 to-slate-600/20 border border-gray-500/30 rounded-2xl font-medium text-gray-400 hover:from-gray-600/40 hover:to-slate-600/40 hover:border-gray-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500/50 shadow-lg hover:shadow-gray-500/25 backdrop-blur-sm relative overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-gray-400/5 to-slate-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                                </div>
                                <i
                                    class="fas fa-times mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                <span class="relative z-10">Limpiar</span>
                            </button>
                        </div>
                    </div>

                    <!-- Active Filters Display -->
                    <div id="activeFilters" class="hidden border-t border-slate-700/50 pt-4 mt-6">
                        <div class="flex items-center space-x-2 text-sm text-gray-400">
                            <span class="font-medium">Filtros activos:</span>
                            <div id="filterTags" class="flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Challenges Grid with Improved UX -->
            <div id="challengesContainer" class="space-y-8">
                @if (!$retosPorCategoria->isEmpty())
                    @foreach ($retosPorCategoria as $categoria => $retos)
                        @php
                            $colores = $coloresPorCategoria[$categoria] ?? [
                                'gradient' => 'from-gray-600/30 to-gray-600/20',
                                'border' => 'border-gray-400/50',
                                'shadow' => 'shadow-gray-500/20',
                                'text' => 'text-gray-400',
                                'bg' => 'bg-gray-900/20',
                                'icon' => 'fas fa-code',
                                'hoverGradient' => 'from-gray-600/50 to-gray-600/40',
                            ];
                        @endphp

                        <div class="category-container animate-fade-in" data-category="{{ $categoria }}">
                            <!-- Enhanced Category Header with Better Visual Hierarchy -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br {{ $colores['gradient'] }} rounded-xl flex items-center justify-center border {{ $colores['border'] }} shadow-lg">
                                            <i class="{{ $colores['icon'] }} {{ $colores['text'] }} text-xl"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-2xl font-bold {{ $colores['text'] }} mb-1">
                                                {{ $categoria }}</h2>
                                            <p class="text-gray-400 text-sm">{{ count($retos) }} retos disponibles</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 {{ $colores['bg'] }} rounded-full animate-pulse"></div>
                                        <span class="text-xs {{ $colores['text'] }} font-medium">Activo</span>
                                    </div>
                                </div>

                                <!-- Enhanced Challenges Grid with Card-based Layout -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                    @foreach ($retos as $reto)
                                        <div class="challenge-card group cursor-pointer bg-slate-900/60 backdrop-blur-sm rounded-2xl border {{ $colores['border'] }} transition-all duration-500 hover:scale-105 hover:{{ str_replace('shadow-', 'shadow-2xl ', $colores['shadow']) }} hover:border-opacity-80 relative overflow-hidden"
                                            onclick="openModal(this)" data-id="{{ $reto->idretos }}"
                                            data-challenge-name="{{ $reto->nomreto }}"
                                            data-points="{{ $reto->puntos }}"
                                            data-description="{{ $reto->descripcion }}"
                                            data-url="{{ $reto->url ?? '' }}"
                                            data-nombre-archivo="{{ $reto->nombre ?? '' }}"
                                            data-solved="{{ Auth::check() && $reto->resuelto == 1 ? 'true' : 'false' }}">

                                            <!-- Status Badge Overlay -->
                                            <div class="absolute top-4 right-4 z-20">
                                                @if (Auth::check() && $reto->resuelto == 1)
                                                    <div
                                                        class="flex items-center space-x-1 bg-green-600/90 border border-green-500/50 rounded-full px-3 py-1 backdrop-blur-sm">
                                                        <div class="w-2 h-2 bg-green-300 rounded-full animate-pulse">
                                                        </div>
                                                        <span class="text-green-200 text-xs font-bold">RESUELTO</span>
                                                    </div>
                                                @else
                                                    <div
                                                        class="flex items-center space-x-1 bg-orange-600/90 border border-orange-500/50 rounded-full px-3 py-1 backdrop-blur-sm">
                                                        <div class="w-2 h-2 bg-orange-300 rounded-full"></div>
                                                        <span
                                                            class="text-orange-200 text-xs font-bold">PENDIENTE</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Hover effect overlay -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br {{ $colores['hoverGradient'] }} opacity-0 group-hover:opacity-20 transition-opacity duration-500 rounded-2xl">
                                            </div>

                                            <div class="relative z-10 p-6">
                                                <!-- Challenge Icon -->
                                                <div class="mb-4">
                                                    <div
                                                        class="w-16 h-16 bg-gradient-to-br {{ $colores['gradient'] }} rounded-xl flex items-center justify-center border {{ $colores['border'] }} shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                        <i
                                                            class="{{ $colores['icon'] }} {{ $colores['text'] }} text-2xl"></i>
                                                    </div>
                                                </div>

                                                <!-- Challenge Header -->
                                                <div class="mb-4">
                                                    <h3
                                                        class="text-white font-bold text-lg mb-2 group-hover:{{ $colores['text'] }} transition-colors duration-300 line-clamp-2">
                                                        {{ $reto->nomreto }}
                                                    </h3>

                                                    <!-- Points with enhanced styling -->
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex items-center space-x-2">
                                                            <i class="fas fa-star {{ $colores['text'] }}"></i>
                                                            <span
                                                                class="text-gray-300 font-semibold">{{ $reto->puntos }}
                                                                pts</span>
                                                        </div>

                                                        <!-- Difficulty indicators with enhanced design -->
                                                        <div class="flex items-center space-x-1">
                                                            @for ($i = 1; $i <= 3; $i++)
                                                                @if ($reto->puntos <= 50)
                                                                    <div
                                                                        class="w-2 h-2 rounded-full {{ $i == 1 ? 'bg-green-400' : 'bg-gray-600' }} transition-all duration-300">
                                                                    </div>
                                                                @elseif($reto->puntos <= 100)
                                                                    <div
                                                                        class="w-2 h-2 rounded-full {{ $i <= 2 ? 'bg-yellow-400' : 'bg-gray-600' }} transition-all duration-300">
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="w-2 h-2 rounded-full bg-red-400 transition-all duration-300">
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Challenge Footer with Action -->
                                                <div
                                                    class="flex items-center justify-between pt-4 border-t border-slate-700/50">
                                                    <div class="flex items-center space-x-2 text-gray-400 text-sm">
                                                        <i class="fas fa-users text-xs"></i>

                                                        <span>Intentos: <span
                                                                class="intentos-count">{{ $reto->intentos }}</span>

                                                    </div>

                                                    <div
                                                        class="flex items-center {{ $colores['text'] }} group-hover:scale-110 transition-transform">
                                                        <span class="text-sm font-medium mr-2">Resolver</span>
                                                        <i class="fas fa-arrow-right text-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Enhanced Empty State -->
                    <div class="text-center py-24 px-8">
                        <div
                            class="mx-auto w-32 h-32 bg-gradient-to-br from-purple-500/20 to-indigo-500/20 rounded-full flex items-center justify-center mb-8 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-purple-400/10 to-indigo-400/10 animate-pulse">
                            </div>
                            <i class="fas fa-flag text-5xl text-purple-400 relative z-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-300 mb-4">No se encontraron retos</h3>
                        <p class="text-gray-400 max-w-md mx-auto text-lg leading-relaxed">
                            No hay retos disponibles que coincidan con tus criterios de búsqueda.
                            Intenta ajustar los filtros.
                        </p>
                        <button onclick="clearAllFilters()"
                            class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-purple-500/25">
                            <i class="fas fa-refresh mr-2"></i>
                            Limpiar filtros
                        </button>
                    </div>
                @endif
            </div>

            <!-- Enhanced Results Counter -->
            <div id="resultsCounter" class="mt-8 text-center">
                <div
                    class="inline-flex items-center px-6 py-3 bg-slate-800/60 border border-slate-700/50 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-flag mr-3 text-purple-400"></i>
                    <span class="text-gray-300">Mostrando <span id="visibleCount"
                            class="font-bold text-purple-400">0</span> de <span id="totalCount"
                            class="font-bold text-purple-400">0</span> retos</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Registro en Competencia -->
    <div id="competitionModal"
        class="fixed inset-0 w-full h-full bg-black/80 backdrop-blur-sm hidden transition-all duration-300"
        style="z-index: 10001;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-gradient-to-br from-slate-900/95 to-slate-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-700/50 p-8 max-w-lg w-full mx-4 transform transition-all duration-300 scale-95 opacity-0"
                id="competitionModalContent">

                <!-- Floating particles background -->
                <div class="absolute inset-0 overflow-hidden rounded-3xl pointer-events-none">
                    <div class="absolute top-4 left-4 w-2 h-2 bg-yellow-400/30 rounded-full animate-pulse"></div>
                    <div class="absolute top-8 right-8 w-1 h-1 bg-orange-400/40 rounded-full animate-bounce"></div>
                    <div class="absolute bottom-6 left-8 w-1.5 h-1.5 bg-yellow-300/20 rounded-full animate-ping"></div>
                    <div
                        class="absolute bottom-4 right-4 w-2 h-2 bg-orange-300/30 rounded-full animate-pulse animation-delay-500">
                    </div>
                </div>

                <div class="text-center relative z-10">
                    <!-- Enhanced trophy icon -->
                    <div class="relative w-24 h-24 mx-auto mb-6">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-yellow-500/30 to-orange-500/30 rounded-full animate-pulse">
                        </div>
                        <div
                            class="relative w-24 h-24 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 rounded-full flex items-center justify-center border border-yellow-400/30 shadow-lg shadow-yellow-500/20">
                            <i class="fas fa-trophy text-4xl text-yellow-400 animate-bounce"></i>
                        </div>
                        <!-- Glow effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-yellow-400/20 to-orange-400/20 rounded-full blur-xl opacity-70 animate-pulse">
                        </div>
                    </div>

                    <!-- Enhanced title -->
                    <h3
                        class="text-3xl font-black text-transparent bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 bg-clip-text mb-4 drop-shadow-lg">
                        ¡Únete al Desafío!
                    </h3>

                    <!-- Enhanced description -->
                    <div class="mb-8">
                        <p class="text-gray-300 mb-4 leading-relaxed text-lg">
                            Para acceder a los retos y participar en la competencia
                        </p>
                        <div
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600/20 to-blue-600/20 border border-cyan-400/30 rounded-xl backdrop-blur-sm">
                            <i class="fas fa-flag mr-2 text-cyan-400"></i>
                            <span
                                class="text-cyan-400 font-bold text-xl">{{ $competenciaActiva ? $competenciaActiva->nomcompe : '' }}</span>
                        </div>
                        <p class="text-gray-400 mt-4 text-sm">
                            necesitas registrarte primero. ¡Es gratis y solo toma un segundo!
                        </p>
                    </div>

                    <!-- Enhanced buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="confirmarRegistro()"
                            class="flex-1 group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold py-4 px-6 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-green-500/25">
                            <!-- Button glow effect -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-green-400/20 to-emerald-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                            </div>
                            <div class="relative flex items-center justify-center">
                                <i class="fas fa-user-plus mr-2 group-hover:scale-110 transition-transform"></i>
                                <span>¡Registrarme Ahora!</span>
                            </div>
                        </button>

                        <button onclick="cerrarModalCompetencia()"
                            class="flex-1 group relative overflow-hidden bg-gradient-to-r from-gray-600 to-slate-600 text-white font-semibold py-4 px-6 rounded-xl hover:from-gray-700 hover:to-slate-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-gray-500/25">
                            <!-- Button glow effect -->
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-gray-400/20 to-slate-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                            </div>
                            <div class="relative flex items-center justify-center">
                                <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                                <span>Tal vez después</span>
                            </div>
                        </button>
                    </div>

                    <!-- Additional info -->
                    <div class="mt-6 pt-6 border-t border-slate-700/50">
                        <div class="flex items-center justify-center space-x-6 text-sm text-gray-400">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-green-400"></i>
                                <span>Registro instantáneo</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2 text-blue-400"></i>
                                <span>100% Gratuito</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Registro -->
    <div id="registrationSuccessModal"
        class="fixed inset-0 w-full h-full bg-black/80 backdrop-blur-sm hidden transition-all duration-300"
        style="z-index: 10002;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="bg-gradient-to-br from-green-900/95 to-emerald-800/95 backdrop-blur-md rounded-3xl shadow-2xl border border-green-700/50 p-8 max-w-md w-full mx-4 transform transition-all duration-300">
                <div class="text-center">
                    <!-- Success icon with animation -->
                    <div class="relative w-20 h-20 mx-auto mb-6">
                        <div class="absolute inset-0 bg-green-500/30 rounded-full animate-ping"></div>
                        <div
                            class="relative w-20 h-20 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-full flex items-center justify-center border border-green-400/30 shadow-lg shadow-green-500/20">
                            <i class="fas fa-check text-3xl text-green-400 animate-bounce"></i>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-green-400 mb-4">¡Registro Exitoso!</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Te has registrado exitosamente en la competencia.
                        <span class="text-green-400 font-semibold">¡Ahora puedes acceder a todos los retos!</span>
                    </p>

                    <button onclick="cerrarModalExito()"
                        class="bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold py-3 px-8 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-green-500/25">
                        <i class="fas fa-play mr-2"></i>
                        ¡Comenzar a Resolver!
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.reto-modal')
</x-app-layout>

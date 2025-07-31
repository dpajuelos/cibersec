<x-app-layout>
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
                <!-- Challenge Badge -->
                <div
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600/30 to-indigo-600/30 border border-purple-400/40 rounded-full text-purple-400 text-sm font-bold mb-8 backdrop-blur-sm hover:from-purple-600/40 hover:to-indigo-600/40 hover:border-purple-300/60 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-500/20">
                    <i class="fas fa-flag mr-3 text-purple-400 animate-pulse text-lg"></i>
                    <span>CTF Challenges Hub</span>
                    <i class="fas fa-code ml-3 text-purple-400 animate-bounce"></i>
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
                            @auth
                                {{ $retosPorCategoria->flatten()->where('resuelto', 1)->count() }}
                            @else
                                0
                            @endauth
                        </div>
                        <div class="text-sm text-gray-300">Resueltos</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-red-600/20 to-pink-600/20 backdrop-blur-sm rounded-xl p-4 border border-red-500/30">
                        <div class="text-2xl font-bold text-red-400">
                            @auth
                                {{ $retosPorCategoria->flatten()->where('resuelto', 0)->count() }}
                            @else
                                {{ $retosPorCategoria->flatten()->count() }}
                            @endauth
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

            <!-- Enhanced Search and Filter Section with Fixed Z-Index -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 mb-8 relative">
                <!-- Gradient overlay -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-purple-600/5 via-transparent to-indigo-600/5 rounded-3xl">
                </div>

                <div class="relative p-8 z-[100]">
                    <div class="flex flex-col space-y-6">
                        <!-- Search Bar -->
                        <div class="w-full">
                            <form action="#" method="GET" class="relative group">
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
                            </form>
                        </div>

                        <!-- Enhanced Filter Controls -->
                        <div class="flex flex-wrap gap-4 justify-center">
                            <!-- Category Filter Dropdown -->
                            <div class="relative">
                                <button id="categoryButton" onclick="toggleCategoryMenu()"
                                    class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600/20 to-purple-600/20 border border-indigo-500/30 rounded-xl font-medium text-indigo-400 hover:from-indigo-600/40 hover:to-purple-600/40 hover:border-indigo-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 shadow-lg hover:shadow-indigo-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-indigo-400/5 to-purple-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-tags mr-2 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10 text-sm">Categoría</span>
                                    <i
                                        class="fas fa-chevron-down ml-2 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="categoryMenu"
                                    class="hidden absolute top-full left-0 z-[9999] mt-2 w-64 bg-slate-900/95 backdrop-blur-md rounded-xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-800/50">
                                            <i class="fas fa-filter mr-2 text-indigo-400"></i>
                                            Filtrar por Categoría
                                        </div>
                                        <button onclick="filterByCategory('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-gray-600/20 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todas las categorías</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        @foreach ($coloresPorCategoria as $categoria => $colores)
                                            <button onclick="filterByCategory('{{ $categoria }}')"
                                                class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:{{ str_replace('bg-', 'bg-', $colores['bg']) }} hover:{{ $colores['text'] }} transition-all duration-300 group/item">
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
                            <div class="relative">
                                <button id="difficultyButton" onclick="toggleDifficultyMenu()"
                                    class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600/20 to-red-600/20 border border-orange-500/30 rounded-xl font-medium text-orange-400 hover:from-orange-600/40 hover:to-red-600/40 hover:border-orange-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-500/50 shadow-lg hover:shadow-orange-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-orange-400/5 to-red-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-chart-line mr-2 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10 text-sm">Dificultad</span>
                                    <i
                                        class="fas fa-chevron-down ml-2 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="difficultyMenu"
                                    class="hidden absolute top-full left-0 z-[9999] mt-2 w-56 bg-slate-900/95 backdrop-blur-md rounded-xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-800/50">
                                            <i class="fas fa-signal mr-2 text-orange-400"></i>
                                            Nivel de Dificultad
                                        </div>
                                        <button onclick="filterByDifficulty('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-gray-600/20 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todas las dificultades</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('easy')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-green-600/20 hover:text-green-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-green-400 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Fácil (1-50 pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('medium')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-yellow-600/20 hover:text-yellow-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <i class="fas fa-star text-yellow-400 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-gray-500 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Medio (51-100 pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByDifficulty('hard')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-red-600/20 hover:text-red-400 transition-all duration-300 group/item">
                                            <div class="flex items-center mr-3">
                                                <i class="fas fa-star text-red-400 text-xs"></i>
                                                <i class="fas fa-star text-red-400 ml-1 text-xs"></i>
                                                <i class="fas fa-star text-red-400 ml-1 text-xs"></i>
                                            </div>
                                            <span class="flex-1 text-left">Difícil (100+ pts)</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="relative">
                                <button id="statusButton" onclick="toggleStatusMenu()"
                                    class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600/20 to-emerald-600/20 border border-green-500/30 rounded-xl font-medium text-green-400 hover:from-green-600/40 hover:to-emerald-600/40 hover:border-green-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 shadow-lg hover:shadow-green-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-green-400/5 to-emerald-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-check-circle mr-2 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10 text-sm">Estado</span>
                                    <i
                                        class="fas fa-chevron-down ml-2 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="statusMenu"
                                    class="hidden absolute top-full left-0 z-[9999] mt-2 w-48 bg-slate-900/95 backdrop-blur-md rounded-xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="py-2">
                                        <div
                                            class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-800/50">
                                            <i class="fas fa-flag mr-2 text-green-400"></i>
                                            Estado del Reto
                                        </div>
                                        <button onclick="filterByStatus('all')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-gray-600/20 hover:text-gray-200 transition-all duration-300 group/item">
                                            <i
                                                class="fas fa-list mr-3 text-gray-400 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="flex-1 text-left">Todos los retos</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByStatus('solved')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-green-600/20 hover:text-green-400 transition-all duration-300 group/item">
                                            <div
                                                class="w-2 h-2 bg-green-400 rounded-full mr-3 group-hover/item:scale-110 transition-transform animate-pulse">
                                            </div>
                                            <span class="flex-1 text-left">Resueltos</span>
                                            <i
                                                class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                        </button>
                                        <button onclick="filterByStatus('unsolved')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-orange-600/20 hover:text-orange-400 transition-all duration-300 group/item">
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
                                class="hidden group items-center px-6 py-3 bg-gradient-to-r from-gray-600/20 to-slate-600/20 border border-gray-500/30 rounded-xl font-medium text-gray-400 hover:from-gray-600/40 hover:to-slate-600/40 hover:border-gray-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500/50 shadow-lg hover:shadow-gray-500/25 backdrop-blur-sm relative overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-gray-400/5 to-slate-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <i
                                    class="fas fa-times mr-2 group-hover:scale-110 transition-transform relative z-10"></i>
                                <span class="relative z-10 text-sm">Limpiar</span>
                            </button>
                        </div>

                        <!-- Active Filters Display -->
                        <div id="activeFilters" class="hidden border-t border-slate-700/50 pt-4">
                            <div class="flex items-center space-x-2 text-sm text-gray-400">
                                <span class="font-medium">Filtros activos:</span>
                                <div id="filterTags" class="flex flex-wrap gap-2"></div>
                            </div>
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
                                            onclick="openModal(this)"
                                            data-id="{{ $reto->idretos }}"
                                            data-challenge-name="{{ $reto->nomreto }}"
                                            data-points="{{ $reto->puntos }}"
                                            data-description="{{ $reto->descripcion }}"
                                            data-url="{{ $reto->url ?? ''}}"
                                            data-nombre-archivo="{{ $reto->nombre ?? ''}}"
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
                                                        <span>Intentos: <span class="intentos-count">{{ $reto->intentos }}</span>
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
    {{-- Modal existente --}}
    <div id="modal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-[10000] bg-black/80 backdrop-blur-sm hidden">
        <div
            class="bg-slate-900/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-700/50 p-8 max-w-4xl w-full h-auto max-h-[90vh] overflow-auto mx-4">
            <!-- Modal content mantener el existente -->
            <div class="grid grid-cols-2 gap-6 border-b border-slate-700/50 py-6 mb-6">
                <button
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-800 hover:to-indigo-800 transition-all duration-300"
                    onclick="volverAVistaReto()">Reto</button>
                
                <button id="btn-resuelto" onclick="showResueltos()"
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl hover:from-indigo-800 hover:to-purple-800 transition-all duration-300">
                    Resuelto por: <span id="resuelto-count"></span>
                </button>
            </div>
            <!-- Contenedor de Resueltos separado -->
            <div id="resueltos-view" class="hidden">
                <h3 class="text-2xl font-bold text-green-400 text-center mb-4">Resuelto por</h3>
                
                <div id="resueltos-tabla-container" class="bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                    <!-- Aquí va la tabla dinámica -->
                </div>
            </div>

            <div class="container">
                <p class="hidden" id="idreto"></p>
                <h2 id="modal-title" class="text-3xl font-bold mb-4 text-gray-50 text-center"></h2>
                <p id="modal-points" class="mb-6 text-gray-100 text-center text-lg"></p>
                <p id="modal-description" class="mb-6 text-gray-100 leading-relaxed"></p>
            

                <div id="pistas-container" class="hidden bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Pistas</h3>
                    <!-- Las pistas se insertan aquí -->
                </div>

                <div id="enlace-container" class="hidden bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Enlace de descarga</h3>
                    <!-- Las enlaces de descarga se insertan aquí -->
                </div>
                

                <!-- Campo para ingresar la flag -->
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center mb-6">
                    <input type="text" id="flag-input" placeholder="CSU{flag}"
                        class="w-full sm:max-w-2xl px-4 py-3 rounded-lg bg-slate-800 text-white border border-slate-600 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-slate-400" />

                    <button onclick="enviarFlag()"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 shadow-md">
                        Enviar
                    </button>
                </div>
                
                <!-- Mensajes -->
                <div id="message-container" class="my-6">
                    <p id="message" class="text-red-300 text-center font-medium"></p>
                    <p id="result" class="text-green-300 text-center font-medium"></p>
                </div>
                <div class="flex justify-center mt-8">
                    <button onclick="closeModal()"
                        class="bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-gray-50 font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-emerald-500/25">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript mejorado -->
    <script>
        let retoResuelto = false;

        let activeFilters = {
            category: 'all',
            difficulty: 'all',
            status: 'all',
            search: ''
        };

        // Toggle functions mejoradas
        function toggleCategoryMenu() {
            const menu = document.getElementById('categoryMenu');
            const isHidden = menu.classList.contains('hidden');

            closeDifficultyMenu();
            closeStatusMenu();

            if (isHidden) {
                showMenu(menu);
            } else {
                hideMenu(menu);
            }
        }

        function toggleDifficultyMenu() {
            const menu = document.getElementById('difficultyMenu');
            const isHidden = menu.classList.contains('hidden');

            closeCategoryMenu();
            closeStatusMenu();

            if (isHidden) {
                showMenu(menu);
            } else {
                hideMenu(menu);
            }
        }

        function toggleStatusMenu() {
            const menu = document.getElementById('statusMenu');
            const isHidden = menu.classList.contains('hidden');

            closeCategoryMenu();
            closeDifficultyMenu();

            if (isHidden) {
                showMenu(menu);
            } else {
                hideMenu(menu);
            }
        }

        function showMenu(menu) {
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('scale-95', 'opacity-0');
                menu.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideMenu(menu) {
            menu.classList.remove('scale-100', 'opacity-100');
            menu.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 300);
        }

        function closeCategoryMenu() {
            const menu = document.getElementById('categoryMenu');
            if (!menu.classList.contains('hidden')) {
                hideMenu(menu);
            }
        }

        function closeDifficultyMenu() {
            const menu = document.getElementById('difficultyMenu');
            if (!menu.classList.contains('hidden')) {
                hideMenu(menu);
            }
        }

        function closeStatusMenu() {
            const menu = document.getElementById('statusMenu');
            if (!menu.classList.contains('hidden')) {
                hideMenu(menu);
            }
        }

        // Funciones de filtro mejoradas
        function filterByCategory(category) {
            activeFilters.category = category;
            closeCategoryMenu();
            applyFilters();
            updateActiveFiltersDisplay();
        }

        function filterByDifficulty(difficulty) {
            activeFilters.difficulty = difficulty;
            closeDifficultyMenu();
            applyFilters();
            updateActiveFiltersDisplay();
        }

        function filterByStatus(status) {
            activeFilters.status = status;
            closeStatusMenu();
            applyFilters();
            updateActiveFiltersDisplay();
        }

        function applyFilters() {
            const containers = document.querySelectorAll('.category-container');
            const challenges = document.querySelectorAll('.challenge-card');
            let visibleCount = 0;
            let totalCount = challenges.length;

            containers.forEach(container => {
                const category = container.dataset.category;
                let hasVisibleChallenges = false;

                // Filter by category
                if (activeFilters.category !== 'all' && category !== activeFilters.category) {
                    container.style.display = 'none';
                    return;
                }

                const categoryCards = container.querySelectorAll('.challenge-card');
                categoryCards.forEach(card => {
                    let isVisible = true;

                    // Filter by search
                    if (activeFilters.search) {
                        const challengeName = card.dataset.challengeName;
                        if (!challengeName.includes(activeFilters.search.toLowerCase())) {
                            isVisible = false;
                        }
                    }

                    // Filter by difficulty
                    if (activeFilters.difficulty !== 'all') {
                        const points = parseInt(card.dataset.points);
                        if (activeFilters.difficulty === 'easy' && points > 50) isVisible = false;
                        if (activeFilters.difficulty === 'medium' && (points <= 50 || points > 100))
                            isVisible = false;
                        if (activeFilters.difficulty === 'hard' && points <= 100) isVisible = false;
                    }

                    // Filter by status
                    if (activeFilters.status !== 'all') {
                        const isSolved = card.dataset.solved === 'true';
                        if (activeFilters.status === 'solved' && !isSolved) isVisible = false;
                        if (activeFilters.status === 'unsolved' && isSolved) isVisible = false;
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
            document.getElementById('visibleCount').textContent = visibleCount;
            document.getElementById('totalCount').textContent = totalCount;
        }

        function updateActiveFiltersDisplay() {
            const activeFiltersDiv = document.getElementById('activeFilters');
            const filterTags = document.getElementById('filterTags');
            const clearBtn = document.getElementById('clearFiltersBtn');

            let hasActiveFilters = false;
            filterTags.innerHTML = '';

            // Check if any filters are active
            Object.keys(activeFilters).forEach(key => {
                if (activeFilters[key] !== 'all' && activeFilters[key] !== '') {
                    hasActiveFilters = true;

                    const tag = document.createElement('span');
                    tag.className =
                        'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-600/20 text-purple-400 border border-purple-500/30';

                    let displayText = '';
                    switch (key) {
                        case 'category':
                            displayText = `Categoría: ${activeFilters[key]}`;
                            break;
                        case 'difficulty':
                            displayText = `Dificultad: ${activeFilters[key]}`;
                            break;
                        case 'status':
                            displayText = `Estado: ${activeFilters[key]}`;
                            break;
                        case 'search':
                            displayText = `Búsqueda: "${activeFilters[key]}"`;
                            break;
                    }

                    tag.innerHTML = `
                        ${displayText}
                        <button onclick="removeFilter('${key}')" class="ml-2 text-purple-300 hover:text-purple-200">
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

        function removeFilter(filterType) {
            if (filterType === 'search') {
                activeFilters[filterType] = '';
                document.getElementById('searchInput').value = '';
            } else {
                activeFilters[filterType] = 'all';
            }
            applyFilters();
            updateActiveFiltersDisplay();
        }

        function clearAllFilters() {
            activeFilters = {
                category: 'all',
                difficulty: 'all',
                status: 'all',
                search: ''
            };
            document.getElementById('searchInput').value = '';
            applyFilters();
            updateActiveFiltersDisplay();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            activeFilters.search = e.target.value;
            applyFilters();
            updateActiveFiltersDisplay();
        });

        // Click outside to close menus
        window.addEventListener('click', function(event) {
            const categoryMenu = document.getElementById('categoryMenu');
            const difficultyMenu = document.getElementById('difficultyMenu');
            const statusMenu = document.getElementById('statusMenu');
            const categoryButton = document.getElementById('categoryButton');
            const difficultyButton = document.getElementById('difficultyButton');
            const statusButton = document.getElementById('statusButton');

            if (!categoryButton.contains(event.target) && !categoryMenu.contains(event.target)) {
                closeCategoryMenu();
            }

            if (!difficultyButton.contains(event.target) && !difficultyMenu.contains(event.target)) {
                closeDifficultyMenu();
            }

            if (!statusButton.contains(event.target) && !statusMenu.contains(event.target)) {
                closeStatusMenu();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCategoryMenu();
                closeDifficultyMenu();
                closeStatusMenu();
            }
        });

        // Initialize counters
        document.addEventListener('DOMContentLoaded', function() {
            const totalChallenges = document.querySelectorAll('.challenge-card').length;
            document.getElementById('visibleCount').textContent = totalChallenges;
            document.getElementById('totalCount').textContent = totalChallenges;
        });

        // Tu código JavaScript existente para el modal...
        var isLoggedIn = @auth true
        @else
            false
        @endauth ;

        var isLoggedIn = @auth true
        @else
            false
        @endauth ;

        function showReto(element) {
            const idreto = element.dataset.id;
            const title = element.dataset.challengeName;
            const points = element.dataset.points;
            const description = element.dataset.description;
            const url = element.dataset.url;
            const nombreArchivo = element.dataset.nombreArchivo;
            const solved = element.dataset.solved === 'true';
            const inputFlag = document.getElementById('flag-input');
            const botonEnviar = document.querySelector('button[onclick="enviarFlag()"]');
            retoResuelto = solved;


            // Insertar datos en el modal
            document.getElementById('idreto').innerText = idreto;
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-points').innerText = `Puntos: ${points}`;
            document.getElementById('modal-description').innerText = description;

            // Mostrar enlace de descarga si existe
            const enlaceContainer = document.getElementById('enlace-container');
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
            if (solved) {
                inputFlag.disabled = true;
                inputFlag.placeholder = "Ya resolviste este reto papi...";

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
            
            fetch(`/resueltos/${idreto}`)
                .then(response => {
                    if (!response.ok) throw new Error("Error al obtener cantidad de resueltos");
                    return response.json();
                })
                .then(data => {
                    document.getElementById('resuelto-count').innerText = data.count ?? 0;
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById('resuelto-count').innerText = '0';
                });
            

            // Limpiar campos previos
            document.getElementById('flag-input').value = '';
            document.getElementById('message').innerText = '';
            document.getElementById('result').innerText = '';
            
            
            
        }



        function showResueltos() {
            const idreto = document.getElementById('idreto').innerText;

            // Mostrar el contenedor de resueltos y ocultar el contenido del reto
            document.querySelector('.container').classList.add('hidden');
            document.getElementById('resueltos-view').classList.remove('hidden');

            const container = document.getElementById('resueltos-tabla-container');
            container.innerHTML = `<p class="text-gray-400 italic">Cargando...</p>`;

            fetch(`/resueltos/${idreto}`)
                .then(res => {
                    if (!res.ok) throw new Error("Error al obtener usuarios.");
                    return res.json();
                })
                .then(data => {
                    if (!data.data || data.data.length === 0) {
                        container.innerHTML = `<p class="text-gray-300">Ningún usuario ha resuelto este reto aún.</p>`;
                        return;
                    }

                    // Crear tabla
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
                    container.innerHTML = `<p class="text-red-400">Hubo un error al cargar la información.</p>`;
                });
        }

        function volverAVistaReto() {
            // Oculta la vista de resueltos
            document.getElementById('resueltos-view').classList.add('hidden');

            // Muestra el contenedor principal del reto
            document.querySelector('.container').classList.remove('hidden');
        }


        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            document.getElementById('message').innerText = '';
            document.getElementById('modal-title').innerText = '';
            document.getElementById('modal-description').innerText = '';
            document.getElementById('pistas-container').innerHTML = '';
            document.getElementById('resuelto-count').innerText = '';
            document.getElementById('modal-points').innerHTML = '';
            //location.reload();
            
        }

        function openModal(element) {
             if (!isLoggedIn) {
                showOverlayPanel(); // Mostrar login requerido
                return;
            }

            // Guardamos el elemento para usarlo en showReto
            showReto(element);
            cargarPistas();
            // Lógica extra (por si necesitas hacerlo siempre)
        

            // Mostrar el modal
            document.getElementById('modal').style.display = 'flex';
        }

        
        function showOverlayPanel() {
            const overlay = document.createElement('div');
            overlay.id = 'overlay';
            overlay.className =
                'fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50';

            const messageBox = document.createElement('div');
            messageBox.className = 'w-full max-w-md bg-white p-6 rounded-lg shadow-lg relative';

            const title = document.createElement('h2');
            title.innerText = 'Mensaje';
            title.className = 'text-lg font-bold mb-4 text-gray-800 text-center';

            const message = document.createElement('p');
            message.innerText = 'Para acceder a los retos necesita iniciar sesión.';
            message.className = 'mb-4 text-gray-700 text-center';

            // Botón de cerrar
            const closeButton = document.createElement('button');
            closeButton.innerText = '✖';
            closeButton.className = 'absolute top-2 right-2 text-gray-600 hover:text-gray-800';
            closeButton.onclick = () => {
                document.body.removeChild(overlay);
            };

            const buttonContainer = document.createElement('div');
            buttonContainer.className = 'flex justify-center space-x-2 mt-4';

            // Botón de iniciar sesión
            const loginButton = document.createElement('button');
            loginButton.innerText = 'Iniciar sesión';
            loginButton.className = 'bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600';
            loginButton.onclick = () => {
                window.location.href = '/login';
            };

            // Botón de registrarse
            const registerButton = document.createElement('button');
            registerButton.innerText = 'Registrarse';
            registerButton.className = 'bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600';
            registerButton.onclick = () => {
                window.location.href = '/register';
            };

            // Agregar botones al contenedor
            buttonContainer.appendChild(loginButton);
            buttonContainer.appendChild(registerButton);

            // Agregar elementos al cuadro de mensaje
            messageBox.appendChild(closeButton);
            messageBox.appendChild(title);
            messageBox.appendChild(message);
            messageBox.appendChild(buttonContainer);
            overlay.appendChild(messageBox);
            document.body.appendChild(overlay);
        }

        function cargarPistas() {
            const idreto = document.getElementById('idreto').innerText;
            const pistasContainer = document.getElementById('pistas-container');

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
                            const botonHTML = retoResuelto
                                ? `<button disabled class="bg-gray-500 text-white font-semibold px-4 py-2 rounded cursor-not-allowed">Reto Resuelto</button>`
                                : `<button onclick="desbloquearPista(${pista.id}, this)" 
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

                    // 🔽 ACTUALIZAR el valor de puntos en el modal
                    const puntosText = document.getElementById('modal-points').innerText; // "Puntos: 200"
                    const puntosOriginales = parseInt(puntosText.match(/\d+/)[0]); // Extrae número
                    const puntosActualizados = Math.max(0, puntosOriginales - totalDescontado);

                    document.getElementById('modal-points').innerText = `Puntos: ${puntosActualizados}`;
                })
                .catch(err => {
                    console.error("Error al obtener pistas:", err);
                    pistasContainer.classList.add('hidden');
                    pistasContainer.innerHTML = '';
                });
        }

        function desbloquearPista(idPista, boton) {
            if (!boton) {
                console.error("El botón no fue pasado correctamente.");
                return;
            }

            const contenedor = boton.closest('div');
            if (!contenedor) {
                console.error("No se encontró el contenedor del botón.");
                return;
            }

            // Desactivar el botón mientras se hace la solicitud
            boton.disabled = true;
            boton.textContent = "Desbloqueando...";

            fetch('/pistas/desbloquear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ idpista: idPista })
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
                    // Limpiar el contenedor
                    contenedor.innerHTML = '';

                    // Crear un nuevo elemento con el contenido
                    const pistaElemento = document.createElement('div');
                    pistaElemento.className = "bg-slate-700/60 p-3 rounded text-gray-100";
                    pistaElemento.innerHTML = `
                        <p>${data.contenido}</p>
                        <p class="text-sm text-red-300 italic mt-1">-${data.valor} puntos</p>
                    `;
                    contenedor.appendChild(pistaElemento);

                    // 🔽 Actualizar los puntos en el modal
                    const puntosText = document.getElementById('modal-points').innerText; // "Puntos: 200"
                    const puntosActuales = parseInt(puntosText.match(/\d+/)[0]);
                    const nuevosPuntos = Math.max(0, puntosActuales - data.valor);
                    document.getElementById('modal-points').innerText = `Puntos: ${nuevosPuntos}`;

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
        function enviarFlag() {
            const flag = document.getElementById('flag-input').value.trim();
            const idreto = document.getElementById('idreto').innerText;

            // Limpiar mensajes anteriores
            document.getElementById('message').innerText = '';
            document.getElementById('result').innerText = '';

            if (!flag) {
                document.getElementById('message').innerText = "Por favor, ingresa una flag.";
                return;
            }

            fetch('/retos/validar-flag', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ idreto: idreto, flag: flag })
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
                    document.getElementById('result').innerText = data.mensaje || "¡Flag correcta!";
                    actualizarEstado(idreto);
                } else {
                    document.getElementById('message').innerText = data.mensaje || "Flag incorrecta.";
                }
            })
            .catch(err => {
                console.error("Error al enviar flag:", err);
                document.getElementById('message').innerText = "Hubo un error al enviar la flag.";
            });
            actualizarIntentos(idreto);
        }

        function actualizarIntentos(idreto) {
        fetch(`/intentos/${idreto}`)
            .then(res => res.json())
            .then(json => {
            const c = json.count;
            document.getElementById('resuelto-count').innerText = c;
            const card = document.querySelector(`.challenge-card[data-id="${idreto}"]`);
            if (card) {
                const span = card.querySelector('.intentos-count');
                if (span) span.innerText = c;
            }
            })
            .catch(console.error);
        }
        function actualizarEstado(idreto) {
        // Encuentra la tarjeta
        const card = document.querySelector(`.challenge-card[data-id="${idreto}"]`);
        if (!card) return;

        // 1) Actualiza el atributo data-solved
        card.dataset.solved = 'true';

        // 2) Sustituye el badge
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




    </script>

    <style>
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
            animation: fade-in 0.6s ease-out;
        }

        .animation-delay-300 {
            animation-delay: 300ms;
        }

        .animation-delay-600 {
            animation-delay: 600ms;
        }

        .animation-delay-900 {
            animation-delay: 900ms;
        }

        .animation-delay-1200 {
            animation-delay: 1200ms;
        }

        /* Line clamp for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Ensure dropdowns appear above everything */
        #categoryMenu,
        #difficultyMenu,
        #statusMenu {
            z-index: 9999 !important;
        }

        /* Smooth transitions for filtered elements */
        .category-container,
        .challenge-card {
            transition: all 0.3s ease;
        }

        /* Enhanced hover effects */
        .challenge-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        /* Custom scrollbar for modal */
        #modal .container::-webkit-scrollbar {
            width: 6px;
        }

        #modal .container::-webkit-scrollbar-track {
            background: rgb(51 65 85 / 0.3);
            border-radius: 10px;
        }

        #modal .container::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #6366f1);
            border-radius: 10px;
        }
    </style>
</x-app-layout>

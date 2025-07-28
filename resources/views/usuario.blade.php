<x-app-layout>
    @section('title', 'Usuarios-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    @push('styles')
        @vite('resources/css/usuario/index-usuario.css')
    @endpush

    @push('scripts')
        @vite('resources/js/usuario/app-usuario.js')
    @endpush


    <!-- Main Content -->
    <div class="bg-gradient-to-b from-slate-800 to-slate-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search and Filter Section -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 mb-8 relative overflow-visible">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 via-transparent to-purple-600/5"></div>

                <div class="relative p-8">
                    <div class="flex flex-col lg:flex-row gap-8 items-center justify-between">

                        <!-- Search Bar -->
                        <div class="w-full lg:w-96">
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                    <i
                                        class="fas fa-search text-gray-400 group-focus-within:text-cyan-400 transition-all duration-300 group-focus-within:scale-110"></i>
                                </div>
                                <input type="search" name="buscar"
                                    class="search-input block w-full pl-12 pr-16 py-4 border border-slate-600/50 rounded-2xl bg-slate-900/50 placeholder-gray-400 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition-all duration-300 backdrop-blur-sm hover:bg-slate-900/70 shadow-inner"
                                    placeholder="Buscar por nombre, nickname o universidad...">
                            </div>
                        </div>

                        <!-- Filter Controls -->
                        <div class="flex items-center space-x-4">
                            <!-- Filter Dropdown -->
                            <div class="relative z-50">
                                <button id="filterButton" onclick="window.usuariosManager.toggleFilterMenu()"
                                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border border-blue-500/30 rounded-2xl font-medium text-blue-400 hover:from-blue-600/40 hover:to-cyan-600/40 hover:border-blue-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500/50 shadow-lg hover:shadow-blue-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-400/5 to-cyan-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-filter mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10">Filtrar</span>
                                    <i
                                        class="fas fa-chevron-down ml-3 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="filterMenu"
                                    class="hidden w-56 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="p-4">
                                        <h3 class="text-white font-semibold mb-4">Filtros</h3>
                                        <div class="space-y-3">
                                            <div>
                                                <label class="text-gray-300 text-sm">Estado</label>
                                                <select data-filter="estado"
                                                    class="w-full mt-1 px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500">
                                                    <option value="todos">Todos</option>
                                                    <option value="1">Activos</option>
                                                    <option value="0">Inactivos</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-gray-300 text-sm">Universidad</label>
                                                <select data-filter="universidad"
                                                    class="w-full mt-1 px-3 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500">
                                                    <option value="todas">Todas</option>
                                                    <option value="unasam">UNASAM</option>
                                                    <option value="otras">Otras</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex space-x-2">
                                            <button onclick="closeFilterMenu()"
                                                class="px-4 py-2 bg-slate-600 text-white rounded-lg text-sm hover:bg-slate-700">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Dropdown -->
                            <div class="relative z-50">
                                <button id="sortButton" onclick="window.usuariosManager.toggleSortMenu()"
                                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-2xl font-medium text-purple-400 hover:from-purple-600/40 hover:to-pink-600/40 hover:border-purple-400/60 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500/50 shadow-lg hover:shadow-purple-500/25 backdrop-blur-sm relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-purple-400/5 to-pink-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    <i
                                        class="fas fa-sort mr-3 group-hover:scale-110 transition-transform relative z-10"></i>
                                    <span class="relative z-10">Ordenar</span>
                                    <i
                                        class="fas fa-chevron-down ml-3 group-hover:rotate-180 transition-transform duration-300 relative z-10"></i>
                                </button>

                                <div id="sortMenu"
                                    class="hidden w-64 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="p-4">
                                        <h3 class="text-white font-semibold mb-4">Ordenar por</h3>
                                        <div class="space-y-2">
                                            <button data-sort="nombre_asc"
                                                class="w-full text-left px-3 py-2 text-gray-300 hover:bg-slate-700 rounded-lg transition-colors">
                                                <i class="fas fa-user mr-2 text-cyan-400"></i>
                                                Nombre A-Z
                                            </button>
                                            <button data-sort="nombre_desc"
                                                class="w-full text-left px-3 py-2 text-gray-300 hover:bg-slate-700 rounded-lg transition-colors">
                                                <i class="fas fa-user mr-2 text-cyan-400"></i>
                                                Nombre Z-A
                                            </button>
                                            <button data-sort="universidad"
                                                class="w-full text-left px-3 py-2 text-gray-300 hover:bg-slate-700 rounded-lg transition-colors">
                                                <i class="fas fa-university mr-2 text-blue-400"></i>
                                                Universidad
                                            </button>
                                            <button data-sort="estado"
                                                class="w-full text-left px-3 py-2 text-gray-300 hover:bg-slate-700 rounded-lg transition-colors">
                                                <i class="fas fa-circle mr-2 text-green-400"></i>
                                                Estado (Activos primero)
                                            </button>
                                        </div>
                                        <div class="mt-4">
                                            <button onclick="closeSortMenu()"
                                                class="w-full px-4 py-2 bg-slate-600 text-white rounded-lg text-sm hover:bg-slate-700">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.userModal')

            <!-- Users Table -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-600/3 via-transparent to-purple-600/3 pointer-events-none">
                </div>

                @if ($v_usuarios->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-24 px-8 relative">
                        <div
                            class="mx-auto w-32 h-32 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full flex items-center justify-center mb-8 relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-blue-400/10 to-cyan-400/10 animate-pulse">
                            </div>
                            <i class="fas fa-users text-5xl text-blue-400 relative z-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-300 mb-4">No se encontraron usuarios</h3>
                        <p class="text-gray-400 max-w-md mx-auto text-lg leading-relaxed">
                            No hay usuarios que coincidan con los criterios de búsqueda.
                            Intenta ajustar los filtros o términos de búsqueda.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        @include('layouts.partials.usuarios-table', ['v_usuarios' => $v_usuarios])
                    </div>

                    <div class="bg-slate-900/60 px-8 py-6 border-t border-slate-700/50 backdrop-blur-sm">
                        @include('layouts.partials.usuarios-pagination', ['v_usuarios' => $v_usuarios])
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

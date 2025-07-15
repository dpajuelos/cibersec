<x-app-layout>
    @section('title', 'Usuarios-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <!-- Hero Section for Users -->
    <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 py-16 overflow-hidden">
        <!-- Background Pattern with Tailwind -->
        <div class="absolute inset-0 opacity-5">
            <div
                class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_1px_1px,rgba(99,102,241,0.3)_1px,transparent_0)] bg-[length:20px_20px]">
            </div>
        </div>

        <!-- Floating particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-20 w-4 h-4 bg-cyan-400/20 rounded-full animate-ping animation-delay-300">
            </div>
            <div
                class="absolute top-40 right-32 w-2 h-2 bg-purple-400/30 rounded-full animate-pulse animation-delay-700">
            </div>
            <div
                class="absolute bottom-32 left-1/3 w-3 h-3 bg-blue-400/25 rounded-full animate-bounce animation-delay-1000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Badge with Tailwind -->
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border border-blue-400/30 rounded-full text-blue-400 text-sm font-medium mb-8 backdrop-blur-sm hover:from-blue-600/30 hover:to-cyan-600/30 hover:border-blue-300/50 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-users mr-3 text-cyan-400 animate-pulse"></i>
                    <span>Comunidad CiberSec</span>
                    <div class="ml-3 w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight">
                    <span
                        class="bg-gradient-to-r from-blue-400 via-cyan-400 to-purple-400 text-transparent bg-clip-text drop-shadow-2xl animate-gradient-x">
                        Directorio de
                    </span>
                    <br>
                    <span class="text-white drop-shadow-lg">Hackers Éticos</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12">
                    Conoce a los miembros de nuestra comunidad de ciberseguridad.
                    <span class="text-cyan-400 font-semibold relative">
                        Cada perfil representa talento
                        <span
                            class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-cyan-400 to-purple-400 rounded-full"></span>
                    </span>, dedicación y pasión por la seguridad digital.
                </p>

                <!-- Stats User -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <div
                        class="group bg-gradient-to-br from-blue-900/40 to-cyan-900/30 backdrop-blur-md rounded-2xl p-6 border border-blue-500/30 hover:border-cyan-400/60 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/20 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-cyan-400/5 to-blue-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-center mb-3">
                                <i
                                    class="fas fa-users text-cyan-400 text-2xl mr-3 group-hover:scale-110 transition-transform"></i>
                                <div
                                    class="text-3xl font-black text-cyan-400 group-hover:text-cyan-300 transition-colors">
                                    {{ $v_usuarios->total() }}
                                </div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">Miembros Activos</div>
                            <div class="w-full bg-cyan-900/30 rounded-full h-2 mt-3 overflow-hidden">
                                <div
                                    class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full w-4/5 animate-pulse">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="group bg-gradient-to-br from-purple-900/40 to-pink-900/30 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30 hover:border-purple-400/60 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-400/5 to-pink-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-center mb-3">
                                <i class="fas fa-circle text-green-400 text-lg mr-3 animate-pulse"></i>
                                <div
                                    class="text-3xl font-black text-purple-400 group-hover:text-purple-300 transition-colors">
                                    {{ $v_usuarios->where('estadousuario', 'activo')->count() }}
                                </div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">En Línea</div>
                            <div class="flex justify-center mt-3 space-x-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="w-1.5 h-1.5 bg-purple-400 rounded-full animate-pulse"
                                        style="animation-delay: {{ $i * 100 }}ms"></div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div
                        class="group bg-gradient-to-br from-green-900/40 to-emerald-900/30 backdrop-blur-md rounded-2xl p-6 border border-green-500/30 hover:border-green-400/60 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-400/5 to-emerald-400/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-center mb-3">
                                <i
                                    class="fas fa-shield-check text-green-400 text-2xl mr-3 group-hover:scale-110 transition-transform"></i>
                                <div
                                    class="text-3xl font-black text-green-400 group-hover:text-green-300 transition-colors">
                                    100%</div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">Verificados</div>
                            <div class="text-xs text-green-400 mt-2 font-medium flex items-center justify-center">
                                <i class="fas fa-check-circle mr-1 animate-pulse"></i>
                                Certificación activa
                            </div>
                        </div>
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
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 mb-8 relative overflow-visible">
                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 via-transparent to-purple-600/5"></div>

                <div class="relative p-8">
                    <div class="flex flex-col lg:flex-row gap-8 items-center justify-between">

                        <!--  Search Bar -->
                        <div class="w-full lg:w-96">
                            <form action="{{ route('usuarios.buscar') }}" method="GET" class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                    <i
                                        class="fas fa-search text-gray-400 group-focus-within:text-cyan-400 transition-all duration-300 group-focus-within:scale-110"></i>
                                </div>
                                <input type="search" name="buscar"
                                    class="block w-full pl-12 pr-16 py-4 border border-slate-600/50 rounded-2xl bg-slate-900/50 placeholder-gray-400 text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500/50 transition-all duration-300 backdrop-blur-sm hover:bg-slate-900/70 focus:bg-slate-900/80 shadow-inner"
                                    placeholder="Buscar por nombre, nickname o universidad...">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <button type="submit"
                                        class="group/btn p-3 text-gray-400 hover:text-cyan-400 transition-all duration-300 hover:bg-cyan-400/10 rounded-lg">
                                        <i
                                            class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                    </button>
                                </div>
                                <!-- Search -->
                                <div
                                    class="absolute inset-0 rounded-2xl bg-gradient-to-r from-cyan-400/10 to-purple-400/10 opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 pointer-events-none">
                                </div>
                            </form>
                        </div>

                        <!-- Filter Controls -->
                        <div class="flex items-center space-x-4">
                            <!-- Filter Dropdown -->
                            <div class="relative">
                                <button id="filterButton" onclick="toggleFilterMenu()"
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
                                    class="hidden absolute right-0 z-[9999] mt-2 w-56 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="py-2">
                                        <div
                                            class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-900/30">
                                            <i class="fas fa-sliders-h mr-2 text-cyan-400"></i>
                                            Estado del Usuario
                                        </div>
                                        <form action="{{ route('usuarios.filtrar') }}" method="GET">
                                            <button type="submit" name="estado" value="activo"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-green-600/20 hover:text-green-400 transition-all duration-300 group/item">
                                                <div
                                                    class="w-3 h-3 bg-green-400 rounded-full mr-4 group-hover/item:scale-110 transition-transform">
                                                </div>
                                                <span class="flex-1 text-left">Activo</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                            <button type="submit" name="estado" value="inactivo"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-red-600/20 hover:text-red-400 transition-all duration-300 group/item">
                                                <div
                                                    class="w-3 h-3 bg-red-400 rounded-full mr-4 group-hover/item:scale-110 transition-transform">
                                                </div>
                                                <span class="flex-1 text-left">Inactivo</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                            <button type="submit" name="estado" value=""
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-gray-600/20 hover:text-gray-200 transition-all duration-300 group/item">
                                                <div
                                                    class="w-3 h-3 bg-gray-400 rounded-full mr-4 group-hover/item:scale-110 transition-transform">
                                                </div>
                                                <span class="flex-1 text-left">Todos</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Dropdown -->
                            <div class="isolate">
                                <button id="sortButton" onclick="toggleSortMenu()"
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
                                    class="hidden absolute mt-2 w-64 bg-slate-800/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden transform transition-all duration-300 scale-95 opacity-0">
                                    <div class="py-2">
                                        <div
                                            class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-slate-700/50 bg-slate-900/30">
                                            <i class="fas fa-sort-amount-down mr-2 text-purple-400"></i>
                                            Ordenar por
                                        </div>
                                        <form action="{{ route('usuarios.ordenar') }}" method="GET">
                                            <button type="submit" name="order" value="nombre_asc"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-purple-600/20 hover:text-purple-400 transition-all duration-300 group/item">
                                                <i
                                                    class="fas fa-sort-alpha-down mr-4 text-purple-400 group-hover/item:scale-110 transition-transform"></i>
                                                <span class="flex-1 text-left">Nombre A-Z</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                            <button type="submit" name="order" value="nombre_desc"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-purple-600/20 hover:text-purple-400 transition-all duration-300 group/item">
                                                <i
                                                    class="fas fa-sort-alpha-up mr-4 text-purple-400 group-hover/item:scale-110 transition-transform"></i>
                                                <span class="flex-1 text-left">Nombre Z-A</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                            <button type="submit" name="order" value="nick_asc"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-purple-600/20 hover:text-purple-400 transition-all duration-300 group/item">
                                                <i
                                                    class="fas fa-user-ninja mr-4 text-purple-400 group-hover/item:scale-110 transition-transform"></i>
                                                <span class="flex-1 text-left">Nickname A-Z</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                            <button type="submit" name="order" value="nick_desc"
                                                class="flex items-center w-full px-6 py-4 text-sm text-gray-300 hover:bg-purple-600/20 hover:text-purple-400 transition-all duration-300 group/item">
                                                <i
                                                    class="fas fa-user-ninja mr-4 text-purple-400 group-hover/item:scale-110 transition-transform"></i>
                                                <span class="flex-1 text-left">Nickname Z-A</span>
                                                <i
                                                    class="fas fa-arrow-right opacity-0 group-hover/item:opacity-100 transition-opacity"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Modal -->
            @include('layouts.userModal')

            <!--  Users Table -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden">
                <!-- Gradient overlay for table -->
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
                        <button onclick="window.location.reload()"
                            class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-medium rounded-xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-cyan-500/25">
                            <i class="fas fa-refresh mr-2"></i>
                            Recargar página
                        </button>
                    </div>
                @else
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-slate-900/60 border-b border-slate-700/50 backdrop-blur-sm">
                                <tr>
                                    <th scope="col"
                                        class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center space-x-3 group cursor-pointer">
                                            <i
                                                class="fas fa-user text-cyan-400 group-hover:scale-110 transition-transform"></i>
                                            <span class="group-hover:text-cyan-400 transition-colors">Usuario</span>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center space-x-3 group cursor-pointer">
                                            <i
                                                class="fab fa-github text-purple-400 group-hover:scale-110 transition-transform"></i>
                                            <span class="group-hover:text-purple-400 transition-colors">GitHub</span>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center space-x-3 group cursor-pointer">
                                            <i
                                                class="fas fa-university text-blue-400 group-hover:scale-110 transition-transform"></i>
                                            <span
                                                class="group-hover:text-blue-400 transition-colors">Universidad</span>
                                        </div>
                                    </th>
                                    <th scope="col"
                                        class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        <div class="flex items-center space-x-3 group cursor-pointer">
                                            <i
                                                class="fas fa-id-badge text-green-400 group-hover:scale-110 transition-transform"></i>
                                            <span class="group-hover:text-green-400 transition-colors">Nickname</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/50">
                                @foreach ($v_usuarios as $usuario)
                                    <tr class="group hover:bg-gradient-to-r hover:from-slate-700/30 hover:to-slate-600/20 transition-all duration-500 cursor-pointer relative"
                                        onclick="openModal('{{ $usuario->usuario }}', '{{ $usuario->nickname }}')">

                                        <!-- User Info -->
                                        <td class="px-8 py-6 whitespace-nowrap relative">
                                            <div class="flex items-center">
                                                <div class="relative flex-shrink-0 h-14 w-14">
                                                    <img src="{{ $usuario->profile_photo_url }}"
                                                        alt="{{ $usuario->usuario }}"
                                                        class="h-14 w-14 rounded-full object-cover ring-2 ring-slate-600 group-hover:ring-cyan-400 transition-all duration-500 shadow-lg group-hover:shadow-cyan-500/25">
                                                    <div
                                                        class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-slate-800 shadow-lg
                                                    {{ $usuario->estadousuario == 'activo' ? 'bg-green-400 animate-pulse' : 'bg-red-400' }}">
                                                    </div>
                                                    <!-- Online indicator glow -->
                                                    @if ($usuario->estadousuario == 'activo')
                                                        <div
                                                            class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-green-400/30 animate-ping">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-6">
                                                    <div
                                                        class="text-sm font-bold text-gray-200 group-hover:text-cyan-400 transition-colors duration-300">
                                                        {{ $usuario->usuario }}
                                                    </div>
                                                    <div class="text-xs text-gray-400 flex items-center mt-1">
                                                        <i
                                                            class="fas fa-circle mr-2 text-xs {{ $usuario->estadousuario == 'activo' ? 'text-green-400 animate-pulse' : 'text-red-400' }}"></i>
                                                        <span
                                                            class="group-hover:text-gray-300 transition-colors">{{ ucfirst($usuario->estadousuario) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- GitHub -->
                                        <td class="px-8 py-6 whitespace-nowrap relative">
                                            <a href="{{ $usuario->link }}"
                                                class="inline-flex items-center text-gray-400 hover:text-purple-400 transition-all duration-300 group-hover:text-purple-300 bg-slate-900/30 px-4 py-2 rounded-xl hover:bg-purple-900/20 backdrop-blur-sm border border-slate-600/30 hover:border-purple-500/50"
                                                onclick="event.stopPropagation()">
                                                <i class="fab fa-github mr-3 text-lg"></i>
                                                <span
                                                    class="truncate max-w-32 font-mono text-sm">{{ basename($usuario->link) }}</span>
                                                <i
                                                    class="fas fa-external-link-alt ml-3 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                                </i>
                                            </a>
                                        </td>

                                        <!-- University -->
                                        <td class="px-8 py-6 whitespace-nowrap relative">
                                            <span
                                                class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-blue-900/40 to-cyan-900/30 text-blue-400 border border-blue-500/30 backdrop-blur-sm shadow-lg">
                                                <i class="fas fa-graduation-cap mr-2"></i>
                                                {{ $usuario->nomuniversidad }}
                                            </span>
                                        </td>

                                        <!-- Nickname -->
                                        <td class="px-8 py-6 whitespace-nowrap relative">
                                            <div class="flex items-center">
                                                <div
                                                    class="font-mono text-sm font-bold text-gray-300 bg-slate-900/50 px-4 py-2 rounded-xl border border-slate-600 shadow-inner backdrop-blur-sm group-hover:bg-slate-800/70 group-hover:border-green-500/30 transition-all duration-300">
                                                    <i
                                                        class="fas fa-user-ninja mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                                                    {{ $usuario->nickname }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--  Pagination -->
                    <div class="bg-slate-900/60 px-8 py-6 border-t border-slate-700/50 backdrop-blur-sm">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <!-- Results Info -->
                            <div
                                class="flex items-center text-sm text-gray-400 bg-slate-800/50 px-4 py-2 rounded-xl border border-slate-600/30 backdrop-blur-sm">
                                <i class="fas fa-info-circle mr-3 text-cyan-400"></i>
                                <span>Mostrando </span>
                                <span class="font-bold text-cyan-400 mx-1">{{ $v_usuarios->firstItem() }}</span>
                                <span>a </span>
                                <span class="font-bold text-cyan-400 mx-1">{{ $v_usuarios->lastItem() }}</span>
                                <span>de </span>
                                <span class="font-bold text-cyan-400 mx-1">{{ $v_usuarios->total() }}</span>
                                <span>usuarios</span>
                            </div>

                            <!-- Pagination Controls -->
                            <nav class="flex items-center space-x-2">
                                <!-- Previous Button -->
                                <a href="{{ $v_usuarios->previousPageUrl() }}"
                                    class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl border border-slate-600 bg-slate-800/80 text-gray-300 hover:bg-slate-700 hover:text-cyan-400 hover:border-cyan-500/50 transition-all duration-300 backdrop-blur-sm shadow-lg hover:shadow-cyan-500/20
                                   {{ $v_usuarios->onFirstPage() ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                    {{ $v_usuarios->onFirstPage() ? 'tabindex=-1' : '' }}>
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    Anterior
                                </a>

                                <!-- Page Numbers -->
                                <div class="hidden sm:flex items-center space-x-1">
                                    @foreach ($v_usuarios->getUrlRange(1, $v_usuarios->lastPage()) as $page => $url)
                                        <a href="{{ $url }}"
                                            class="inline-flex items-center justify-center w-12 h-12 text-sm font-bold rounded-xl border transition-all duration-300 backdrop-blur-sm
                                           {{ $v_usuarios->currentPage() == $page
                                               ? 'border-cyan-500 bg-cyan-600/20 text-cyan-400 shadow-lg shadow-cyan-500/25'
                                               : 'border-slate-600 bg-slate-800/80 text-gray-300 hover:bg-slate-700 hover:text-cyan-400 hover:border-cyan-500/50 hover:shadow-lg hover:shadow-cyan-500/20' }}">
                                            {{ $page }}
                                        </a>
                                    @endforeach
                                </div>

                                <!-- Next Button -->
                                <a href="{{ $v_usuarios->nextPageUrl() }}"
                                    class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl border border-slate-600 bg-slate-800/80 text-gray-300 hover:bg-slate-700 hover:text-cyan-400 hover:border-cyan-500/50 transition-all duration-300 backdrop-blur-sm shadow-lg hover:shadow-cyan-500/20
                                   {{ !$v_usuarios->hasMorePages() ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                                    {{ !$v_usuarios->hasMorePages() ? 'tabindex=-1' : '' }}>
                                    Siguiente
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        //  Toggle Functions
        function toggleFilterMenu() {
            const menu = document.getElementById('filterMenu');
            const isHidden = menu.classList.contains('hidden');

            // Close sort menu first
            closeSortMenu();

            if (isHidden) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('scale-95', 'opacity-0');
                    menu.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                closeFilterMenu();
            }
        }

        function toggleSortMenu() {
            const menu = document.getElementById('sortMenu');
            const isHidden = menu.classList.contains('hidden');

            // Close filter menu first
            closeFilterMenu();

            if (isHidden) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('scale-95', 'opacity-0');
                    menu.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                closeSortMenu();
            }
        }

        function closeFilterMenu() {
            const menu = document.getElementById('filterMenu');
            if (!menu.classList.contains('hidden')) {
                menu.classList.remove('scale-100', 'opacity-100');
                menu.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300);
            }
        }

        function closeSortMenu() {
            const menu = document.getElementById('sortMenu');
            if (!menu.classList.contains('hidden')) {
                menu.classList.remove('scale-100', 'opacity-100');
                menu.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300);
            }
        }

        // Enhanced click outside handler
        window.addEventListener('click', function(event) {
            const filterMenu = document.getElementById('filterMenu');
            const sortMenu = document.getElementById('sortMenu');
            const filterButton = document.getElementById('filterButton');
            const sortButton = document.getElementById('sortButton');

            if (!filterButton.contains(event.target) && !filterMenu.contains(event.target)) {
                closeFilterMenu();
            }

            if (!sortButton.contains(event.target) && !sortMenu.contains(event.target)) {
                closeSortMenu();
            }
        });

        // keyboard navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFilterMenu();
                closeSortMenu();
            }
        });

        // loading state for search
        const searchForm = document.querySelector('form[action*="buscar"]');
        if (searchForm) {
            searchForm.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                const icon = submitBtn.querySelector('i');
                const originalClass = icon.className;

                icon.className = 'fas fa-spinner fa-spin';
                submitBtn.disabled = true;

                // Reset after 3 seconds if form doesn't navigate
                setTimeout(() => {
                    icon.className = originalClass;
                    submitBtn.disabled = false;
                }, 3000);
            });
        }
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
            animation: fade-in 0.6s ease-out;
        }

        .animation-delay-300 {
            animation-delay: 300ms;
        }

        .animation-delay-700 {
            animation-delay: 700ms;
        }

        .animation-delay-1000 {
            animation-delay: 1000ms;
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
    </style>
</x-app-layout>

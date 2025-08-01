<x-admin-layout>
    @section('title', 'Gestión de Categorías')
    @push('scripts')
        @vite('resources/js/admin/categoria.js')
    @endpush
    <div
        class="relative font-sans antialiased bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 min-h-screen py-16">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-indigo-500/5 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -left-8 w-96 h-96 bg-pink-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600/20 to-pink-600/20 border border-indigo-400/30 rounded-full text-indigo-400 text-sm font-medium mb-6 backdrop-blur-sm">
                    <i class="fas fa-layer-group mr-3 animate-pulse"></i>
                    <span>Gestión de Categorías</span>
                </div>

                <div class="flex justify-between items-center">
                    <h1 class="text-4xl md:text-5xl font-black text-white">
                        <span
                            class="bg-gradient-to-r from-cyan-400 via-pink-400 to-purple-400 text-transparent bg-clip-text">
                            Categorías
                        </span>
                    </h1>
                    <button id="crear-categoria-btn"
                        class="group bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-indigo-500/25 border border-indigo-400/30">
                        <i class="fas fa-plus mr-3 group-hover:rotate-180 transition-transform duration-300"></i>
                        Nueva Categoría
                    </button>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-indigo-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-indigo-400">{{ $categorias->total() }}</div>
                            <div class="text-gray-300 text-sm">Total Categorías</div>
                        </div>
                        <div class="p-3 bg-indigo-500/20 rounded-xl">
                            <i class="fas fa-layer-group text-indigo-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-purple-400">
                                {{ $categorias->filter(function ($cat) {return $cat->retos_count > 0;})->count() }}
                            </div>
                            <div class="text-gray-300 text-sm">Con Retos</div>
                        </div>
                        <div class="p-3 bg-purple-500/20 rounded-xl">
                            <i class="fas fa-check-circle text-purple-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-6 border border-pink-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-pink-400">{{ $totalRetos ?? 0 }}</div>
                            <div class="text-gray-300 text-sm">Total Retos</div>
                        </div>
                        <div class="p-3 bg-pink-500/20 rounded-xl">
                            <i class="fas fa-flag text-pink-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl p-8 mb-8 border border-slate-600/50 shadow-2xl">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-search mr-3 text-indigo-400"></i>
                    Búsqueda de Categorías
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-3">Buscar</label>
                        <div class="relative">
                            <input type="text" id="buscar-categoria" placeholder="Buscar por nombre de categoría..."
                                class="w-full px-4 py-3 pl-12 bg-slate-700/50 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button id="limpiar-filtros"
                            class="w-full bg-gradient-to-r from-slate-600 to-gray-600 hover:from-slate-500 hover:to-gray-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg shadow-slate-500/25 font-medium">
                            <i class="fas fa-eraser mr-2"></i>Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla de Categorías -->
            <div
                class="bg-slate-800/60 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border border-slate-600/50">
                <div class="px-8 py-6 border-b border-slate-600/50">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-list mr-3 text-pink-400"></i>
                        Lista de Categorías
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-700/50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-indigo-400 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2"></i>ID
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-indigo-400 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2"></i>Categoría
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-indigo-400 uppercase tracking-wider">
                                    <i class="fas fa-flag mr-2"></i>Retos Asociados
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-sm font-bold text-indigo-400 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla-categorias" class="bg-slate-800/30 divide-y divide-slate-600/30">
                            @forelse ($categorias as $categoria)
                                <tr class="hover:bg-slate-700/30 transition-colors duration-200 categoria-row">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-xl flex items-center justify-center">
                                                <span
                                                    class="text-indigo-400 font-bold">#{{ $categoria->idcategoria }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-layer-group text-purple-400 text-lg"></i>
                                            </div>
                                            <div>
                                                <div class="text-lg font-bold text-white categoria-nombre">
                                                    {{ $categoria->nomcategoria }}
                                                </div>
                                                <div class="text-sm text-gray-400">
                                                    <i class="fas fa-tag mr-1"></i>
                                                    Categoría de retos
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-flag text-cyan-400 text-sm"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-xl font-bold text-cyan-400">{{ $categoria->retos_count ?? 0 }}</span>
                                                <span class="text-xs text-gray-500">
                                                    {{ $categoria->retos_count == 1 ? 'reto' : 'retos' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex space-x-3">
                                            <button data-action="editar" data-id="{{ $categoria->idcategoria }}"
                                                class="group p-3 bg-gradient-to-r from-purple-500/20 to-pink-500/20 hover:from-purple-500/30 hover:to-pink-500/30 text-purple-300 border border-purple-400/30 rounded-xl transition-all duration-300 transform hover:scale-105"
                                                title="Editar categoría">
                                                <i class="fas fa-edit group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                            <button data-action="eliminar" data-id="{{ $categoria->idcategoria }}"
                                                class="group p-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 hover:from-red-500/30 hover:to-pink-500/30 text-red-300 border border-red-400/30 rounded-xl transition-all duration-300 transform hover:scale-105 {{ $categoria->retos_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                title="{{ $categoria->retos_count > 0 ? 'No se puede eliminar: tiene retos asociados' : 'Eliminar categoría' }}"
                                                {{ $categoria->retos_count > 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash group-hover:rotate-12 transition-transform"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-gray-500/20 to-slate-500/20 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-layer-group text-gray-400 text-2xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-white mb-2">No hay categorías</h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{ request('search') ? 'No se encontraron resultados para tu búsqueda.' : 'Aún no has creado ninguna categoría.' }}
                                                </p>
                                            </div>
                                            @if (!request('search'))
                                                <button
                                                    onclick="document.getElementById('crear-categoria-btn').click()"
                                                    class="mt-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Crear primera categoría
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if ($categorias->hasPages())
                    <div class="px-8 py-6 border-t border-slate-600/50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de
                                {{ $categorias->total() }} categorías
                            </div>
                            <div class="flex space-x-2">
                                {{ $categorias->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Incluir el modal -->
    @include('admin.components.categoria-modal')

    <!-- Efectos de partículas -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-indigo-400 rounded-full opacity-20 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2 h-2 bg-pink-400 rounded-full opacity-15 animate-ping delay-1000">
        </div>
        <div
            class="absolute bottom-1/4 left-1/2 w-1 h-1 bg-indigo-300 rounded-full opacity-25 animate-pulse delay-500">
        </div>
    </div>
</x-admin-layout>

<x-app-layout>
    @section('title', 'Usuarios-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-0 max-w-full">
        <header class="mb-10">
            <h1 class="text-4xl font-bold text-center text-white mb-3">Lista de Usuarios</h1>
            <p class="text-center text-gray-400">Perfiles de participantes</p>
        </header>
         
            <!-- Incluir el modal -->
        @include('layouts.userModal', [
            
        ])
        
        <div class="bg-gray-800 rounded-lg shadow-lg">
            <!-- Search and Filter Bar -->
            <div class="border-b border-gray-700 px-6 py-4 br-gray-900 relative z-10"> <!-- modiiiii -->
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <!-- Search Bar -->
                    <form action="{{ route('usuarios.buscar') }}" method="GET" class="relative w-full sm:w-96">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="search" name="buscar"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-600 rounded-lg leading-5 bg-gray-800 placeholder-gray-500 text-gray-200 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                placeholder="Buscar usuario...">
                    </form>
                    <!-- Filter Buttons -->
                    <div class="flex space-x-2">
                        <div class="relative inline-block text-left">
                            <div>
                                <button id="filterButton" onclick="toggleFilterMenu()" class="inline-flex items-center px-3 py-2 border border-gray-600 rounded-md text-sm font-medium text-gray-200 bg-gray-800 hover:bg-gray-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                    Filtrar
                                </button>
                            </div>
                            <div id="filterMenu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5">
                                <form action="{{ route('usuarios.filtrar') }}" method="GET">
                                    <button type="submit" name="estado" value="activo" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Activo</button>
                                    <button type="submit" name="estado" value="inactivo" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Inactivo</button>
                                    <button type="submit" name="estado" value="" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Ninguno</button>
                                </form>
                            </div>
                        </div>
                        <div class="relative inline-block text-left ml-2">
                            <div>
                                <button id="sortButton" onclick="toggleSortMenu()" class="inline-flex items-center px-3 py-2 border border-gray-600 rounded-md text-sm font-medium text-gray-200 bg-gray-800 hover:bg-gray-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                                    </svg>
                                    Ordenar
                                </button>
                            </div>
                            <div id="sortMenu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5">
                                <form action="{{ route('usuarios.ordenar') }}" method="GET">
                                    <button type="submit" name="order" value="nombre_asc" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Nombre Ascendente</button>
                                    <button type="submit" name="order" value="nombre_desc" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Nombre Descendente</button>
                                    <button type="submit" name="order" value="nick_asc" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Nickname Ascendente</button>
                                    <button type="submit" name="order" value="nick_desc" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-700">Nickname Descendente</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tablita como mi ex :3 -->
            <div class="overflow-x-auto">
                @if($usuarios->isEmpty())
                    <p class="text-center text-gray-400">No se encontraron usuarios con el término de búsqueda.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Usuario
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Web
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Universidad
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Nickname
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @foreach ($usuarios as $usuario)
                            <tr class="hover:bg-gray-800">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center cursor-pointer" onclick="openModal('{{ $usuario->usuario }}', '{{ $usuario->nickname }}')">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center">
                                            <img src="{{ $usuario->foto }}" alt="Imagen" class="h-full w-full rounded-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-300">{{ $usuario->usuario }}</div>
                                            <div class="text-sm text-gray-400" >{{ $usuario->estadousuario }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ $usuario->link }}" class="flex items-center text-gray-400 hover:text-gray-300">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $usuario->link }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-medium bg-gray-800 text-gray-300 rounded-full">
                                    {{ $usuario->nomuniversidad }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-mono text-gray-400">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $usuario->nickname }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- Card Footer -->
            <div class="bg-gray-800 px-6 py-4 border-t border-gray-700">
                <div class="flex items-center justify-between">
                    <!-- Muestra el rango de elementos actuales y el total de usuarios -->
                    <span class="text-sm text-gray-400">
                          Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios 
                    </span>
                    
                    <div class="flex-1 flex justify-end">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <!-- Botón Anterior -->
                            <a href="{{ $usuarios->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-600 bg-gray-700 text-sm font-medium text-gray-400 hover:bg-gray-600 {{ $usuarios->onFirstPage() ? 'disabled:opacity-50 disabled:cursor-not-allowed' : '' }}" {{ $usuarios->onFirstPage() ? 'aria-disabled=true tabindex=-1' : '' }}>
                                Anterior
                            </a>
                            <!-- Mostrar número de páginas -->
                            @foreach ($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-600 {{ $usuarios->currentPage() == $page ? 'bg-blue-800 text-blue-400' : 'bg-gray-700 text-gray-400 hover:bg-gray-600' }}">
                                    {{ $page }}
                                </a>
                            @endforeach
                            <!-- Botón Siguiente -->
                            <a href="{{ $usuarios->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-600 bg-gray-700 text-sm font-medium text-gray-400 hover:bg-gray-600 {{ !$usuarios->hasMorePages() ? 'disabled:opacity-50 disabled:cursor-not-allowed' : '' }}" {{ !$usuarios->hasMorePages() ? 'aria-disabled=true tabindex=-1' : '' }}>
                                Siguiente
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function toggleFilterMenu() {
    const menu = document.getElementById('filterMenu');
    menu.classList.toggle('hidden');
}
function toggleSortMenu() {
    const menu = document.getElementById('sortMenu');
    menu.classList.toggle('hidden');
}
window.onclick = function(event) {
    const filterMenu = document.getElementById('filterMenu');
    const sortMenu = document.getElementById('sortMenu');
    const isFilterButton = event.target.matches('#filterButton');
    const isSortButton = event.target.matches('#sortButton');
    // Cierra el menú de filtro si se hace clic fuera del botón de filtro y del menú de filtro
    if (!isFilterButton && !filterMenu.contains(event.target) && !filterMenu.classList.contains('hidden')) {
        filterMenu.classList.add('hidden');
    }
    // Cierra el menú de orden si se hace clic fuera del botón de orden y del menú de orden
    if (!isSortButton && !sortMenu.contains(event.target) && !sortMenu.classList.contains('hidden')) {
        sortMenu.classList.add('hidden');
    }
};
</script>
</x-app-layout>
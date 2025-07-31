<div class="bg-slate-900/60 px-8 py-6 border-t border-slate-700/50 backdrop-blur-sm">
    <!-- Paginación simple y moderna -->
    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
        <!-- Información de resultados -->
        <div class="text-sm text-gray-400">
            Mostrando <span class="font-semibold text-cyan-400">{{ $v_usuarios->firstItem() }}</span>
            a <span class="font-semibold text-cyan-400">{{ $v_usuarios->lastItem() }}</span>
            de <span class="font-semibold text-cyan-400">{{ $v_usuarios->total() }}</span>
            usuarios
        </div>

        <!-- Controles de paginación -->
        <nav class="flex items-center space-x-2">
            {{-- Botón Anterior --}}
            @if ($v_usuarios->onFirstPage())
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-slate-800 border border-slate-600 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-left mr-1"></i>
                    Anterior
                </span>
            @else
                <a href="{{ $v_usuarios->previousPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-gray-300 bg-slate-800 border border-slate-600 rounded-lg hover:bg-slate-700 hover:text-white hover:border-cyan-500 transition-all duration-200">
                    <i class="fas fa-chevron-left mr-1"></i>
                    Anterior
                </a>
            @endif

            @php
                $start = max(1, $v_usuarios->currentPage() - 2);
                $end = min($v_usuarios->lastPage(), $v_usuarios->currentPage() + 2);
            @endphp

            @if ($start > 1)
                <a href="{{ $v_usuarios->url(1) }}"
                    class="px-3 py-2 text-sm font-medium text-gray-300 bg-slate-800 border border-slate-600 rounded-lg hover:bg-slate-700 hover:text-white hover:border-cyan-500 transition-all duration-200">1</a>
                @if ($start > 2)
                    <span class="px-3 py-2 text-sm text-gray-500">...</span>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $v_usuarios->currentPage())
                    <span
                        class="px-3 py-2 text-sm font-bold text-white bg-gradient-to-r from-cyan-600 to-blue-600 border border-cyan-500 rounded-lg shadow-lg">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $v_usuarios->url($page) }}"
                        class="px-3 py-2 text-sm font-medium text-gray-300 bg-slate-800 border border-slate-600 rounded-lg hover:bg-slate-700 hover:text-white hover:border-cyan-500 transition-all duration-200">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            @if ($end < $v_usuarios->lastPage())
                @if ($end < $v_usuarios->lastPage() - 1)
                    <span class="px-3 py-2 text-sm text-gray-500">...</span>
                @endif
                <a href="{{ $v_usuarios->url($v_usuarios->lastPage()) }}"
                    class="px-3 py-2 text-sm font-medium text-gray-300 bg-slate-800 border border-slate-600 rounded-lg hover:bg-slate-700 hover:text-white hover:border-cyan-500 transition-all duration-200">{{ $v_usuarios->lastPage() }}</a>
            @endif

            {{-- Botón Siguiente --}}
            @if ($v_usuarios->hasMorePages())
                <a href="{{ $v_usuarios->nextPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-gray-300 bg-slate-800 border border-slate-600 rounded-lg hover:bg-slate-700 hover:text-white hover:border-cyan-500 transition-all duration-200">
                    Siguiente
                    <i class="fas fa-chevron-right ml-1"></i>
                </a>
            @else
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-slate-800 border border-slate-600 rounded-lg cursor-not-allowed">
                    Siguiente
                    <i class="fas fa-chevron-right ml-1"></i>
                </span>
            @endif
        </nav>
    </div>
</div>

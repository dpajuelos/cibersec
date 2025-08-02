<x-app-layout>
    @section('title', 'Ranking-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ranking') }}
        </h2>
    </x-slot>

    @push('styles')
        @vite('resources/css/ranking/ranking-styles.css')
    @endpush

    @push('scripts')
        @vite('resources/js/ranking/ranking-manager.js')
    @endpush

    <!-- Hero Section for Ranking -->
    <div class="relative bg-gradient-to-br from-yellow-900 via-orange-900 to-red-900 py-16 overflow-hidden">
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
                    <i class="fas fa-crown ml-3 text-yellow-400 animate-bounce"></i>
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
                    <span class="text-white drop-shadow-lg text-3xl md:text-4xl lg:text-5xl">Elite of the
                        Community</span>
                </h1>

                <!-- Subtitle with medal icons -->
                <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12">
                    Los mejores de nuestra comunidad.
                    <span class="text-yellow-400 font-bold relative inline-flex items-center">
                        <i class="fas fa-medal mr-2 animate-spin-slow"></i>
                        Solo los más dedicados
                        <i class="fas fa-star ml-2 animate-pulse"></i>
                    </span>
                    llegan al top del ranking.
                </p>

                <!-- Enhanced Podium Preview with Correct Heights -->
                @if (!$rankings->isEmpty())
                    <div class="flex justify-center items-end space-x-4 mb-8 max-w-4xl mx-auto">
                        <!-- 2nd Place -->
                        @if (isset($top3[1]))
                            <div
                                class="group bg-gradient-to-t from-gray-600/30 to-gray-400/30 backdrop-blur-md rounded-t-3xl p-4 border border-gray-400/40 hover:border-gray-300/60 transition-all duration-500 hover:scale-105 relative w-32 h-40 flex flex-col justify-between">
                                <div class="text-center flex-1 flex flex-col justify-center">
                                    <!-- Profile Photo -->
                                    <div class="relative mb-3">
                                        <img src="{{ $top3[1]->profile_photo_url }}" alt="{{ $top3[1]->usuario }}"
                                            class="w-12 h-12 rounded-full mx-auto border-3 border-gray-400/50 shadow-lg group-hover:scale-110 transition-transform object-cover">
                                        <div
                                            class="absolute -top-1 -right-1 w-6 h-6 bg-gray-400/80 rounded-full flex items-center justify-center">
                                            <i class="fas fa-medal text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <!-- User Info -->
                                    <div class="text-sm font-bold text-gray-300 mb-1 truncate px-1"
                                        title="{{ $top3[1]->usuario }}">
                                        {{ Str::limit($top3[1]->usuario, 10) }}
                                    </div>
                                    <div class="text-xs text-gray-400 mb-2">{{ $top3[1]->total_puntos }} pts</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-gray-300">2°</div>
                                    <div class="text-xs text-gray-400">Plata</div>
                                </div>
                                <div class="absolute -top-2 -right-2 w-3 h-3 bg-gray-400/20 rounded-full animate-pulse">
                                </div>
                            </div>
                        @endif

                        <!-- 1st Place - Higher than others -->
                        @if (isset($top3[0]))
                            <div
                                class="group bg-gradient-to-t from-yellow-600/40 to-yellow-400/40 backdrop-blur-md rounded-t-3xl p-6 border border-yellow-400/50 hover:border-yellow-300/70 transition-all duration-500 hover:scale-110 relative w-36 h-56 flex flex-col justify-between">
                                <div class="text-center flex-1 flex flex-col justify-center">
                                    <!-- Profile Photo -->
                                    <div class="relative mb-3">
                                        <img src="{{ $top3[0]->profile_photo_url }}" alt="{{ $top3[0]->usuario }}"
                                            class="w-16 h-16 rounded-full mx-auto border-4 border-yellow-400/70 shadow-xl group-hover:scale-110 transition-transform object-cover animate-pulse">
                                        <div
                                            class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400/90 rounded-full flex items-center justify-center animate-bounce">
                                            <i class="fas fa-crown text-yellow-900 text-sm"></i>
                                        </div>
                                    </div>
                                    <!-- User Info -->
                                    <div class="text-base font-black text-yellow-300 mb-2 truncate px-1"
                                        title="{{ $top3[0]->usuario }}">
                                        {{ Str::limit($top3[0]->usuario, 12) }}
                                    </div>
                                    <div class="text-sm text-yellow-400 font-bold mb-3">{{ $top3[0]->total_puntos }}
                                        pts</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-xl font-black text-yellow-300">1°</div>
                                    <div class="text-sm text-yellow-400 font-bold">Oro</div>
                                </div>
                                <div
                                    class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400/30 rounded-full animate-ping">
                                </div>
                            </div>
                        @endif

                        <!-- 3rd Place -->
                        @if (isset($top3[2]))
                            <div
                                class="group bg-gradient-to-t from-orange-600/30 to-orange-400/30 backdrop-blur-md rounded-t-3xl p-4 border border-orange-400/40 hover:border-orange-300/60 transition-all duration-500 hover:scale-105 relative w-32 h-36 flex flex-col justify-between">
                                <div class="text-center flex-1 flex flex-col justify-center">
                                    <!-- Profile Photo -->
                                    <div class="relative mb-3">
                                        <img src="{{ $top3[2]->profile_photo_url }}" alt="{{ $top3[2]->usuario }}"
                                            class="w-12 h-12 rounded-full mx-auto border-3 border-orange-400/50 shadow-lg group-hover:scale-110 transition-transform object-cover">
                                        <div
                                            class="absolute -top-1 -right-1 w-6 h-6 bg-orange-400/80 rounded-full flex items-center justify-center">
                                            <i class="fas fa-medal text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <!-- User Info -->
                                    <div class="text-sm font-bold text-orange-300 mb-1 truncate px-1"
                                        title="{{ $top3[2]->usuario }}">
                                        {{ Str::limit($top3[2]->usuario, 10) }}
                                    </div>
                                    <div class="text-xs text-orange-400 mb-2">{{ $top3[2]->total_puntos }} pts</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-orange-300">3°</div>
                                    <div class="text-xs text-orange-400">Bronce</div>
                                </div>
                                <div
                                    class="absolute -top-2 -left-2 w-3 h-3 bg-orange-400/20 rounded-full animate-pulse">
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gradient-to-b from-slate-800 to-slate-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($rankings->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div
                            class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-yellow-900/40 to-orange-900/40 rounded-full flex items-center justify-center border border-yellow-500/30">
                            <i class="fas fa-trophy text-yellow-400 text-3xl animate-pulse"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">¡Sé el Primero en el Ranking!</h3>
                        <p class="text-gray-400 mb-8">Aún no hay participantes en el ranking. ¡Es tu oportunidad de ser
                            el primer hacker en aparecer aquí!</p>
                        <div class="space-y-4">
                            <a href="{{ route('retos') }}"
                                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-bold rounded-xl hover:from-yellow-500 hover:to-orange-500 transform hover:scale-105 transition-all duration-300 shadow-lg shadow-yellow-500/25">
                                <i class="fas fa-rocket mr-3"></i>
                                Resolver Retos Ahora
                            </a>
                            <p class="text-sm text-gray-500">Resuelve retos para ganar puntos y aparecer en el ranking
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div
                        class="bg-gradient-to-br from-yellow-900/40 to-orange-900/30 backdrop-blur-md rounded-2xl p-6 border border-yellow-500/30 hover:border-yellow-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20 relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <i
                                    class="fas fa-trophy text-yellow-400 text-3xl group-hover:scale-110 transition-transform"></i>
                                <div class="text-2xl font-black text-yellow-400">{{ $rankings->take(10)->count() }}
                                </div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">Top Hackers</div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-purple-900/40 to-blue-900/30 backdrop-blur-md rounded-2xl p-6 border border-purple-500/30 hover:border-purple-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <i
                                    class="fas fa-chart-line text-purple-400 text-3xl group-hover:scale-110 transition-transform"></i>
                                <div class="text-2xl font-black text-purple-400">LIVE</div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">
                                <span>Actualización 30s</span>
                                <div class="flex items-center mt-1">
                                    <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse mr-2"></div>
                                    <span class="text-xs text-gray-400">En línea</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-green-900/40 to-cyan-900/30 backdrop-blur-md rounded-2xl p-6 border border-green-500/30 hover:border-green-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20 relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <i
                                    class="fas fa-users text-green-400 text-3xl group-hover:scale-110 transition-transform"></i>
                                <div class="text-2xl font-black text-green-400">{{ count($rankings) }}</div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">Participantes</div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-red-900/40 to-pink-900/30 backdrop-blur-md rounded-2xl p-6 border border-red-500/30 hover:border-red-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-red-500/20 relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <i
                                    class="fas fa-fire text-red-400 text-3xl group-hover:scale-110 transition-transform"></i>
                                <div class="text-2xl font-black text-red-400">
                                    {{ $rankings->first()->total_puntos ?? 0 }}</div>
                            </div>
                            <div class="text-gray-300 text-sm font-medium">Max Puntos</div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Enhanced Table Section -->
                    <div class="lg:col-span-2">
                        <div
                            class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden relative">
                            <!-- Table header -->
                            <div
                                class="bg-gradient-to-r from-purple-900/30 via-blue-900/20 to-cyan-900/30 p-6 border-b border-slate-700/50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-purple-400 flex items-center">
                                            <i class="fas fa-list-ol mr-3 text-purple-400"></i>
                                            Tabla de Posiciones
                                        </h3>
                                        <p class="text-gray-400 text-sm mt-1">Elite hackers de la comunidad</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-xs text-gray-400">Live</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Table with Better Responsive Design -->
                            <div class="max-h-[600px] overflow-y-auto custom-scrollbar">
                                <table class="min-w-full table-auto">
                                    <thead
                                        class="bg-slate-900/60 border-b border-slate-700/50 sticky top-0 backdrop-blur-sm">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider w-16">
                                                <div class="flex items-center justify-center space-x-1">
                                                    <i class="fas fa-hashtag text-yellow-400 text-xs"></i>
                                                    <span>Pos</span>
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-4 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center space-x-1">
                                                    <i class="fas fa-user-ninja text-purple-400 text-xs"></i>
                                                    <span>Usuario</span>
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-4 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center space-x-1">
                                                    <i class="fas fa-university text-blue-400 text-xs"></i>
                                                    <span>Universidad</span>
                                                </div>
                                            </th>
                                            <th scope="col"
                                                class="px-4 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider w-24">
                                                <div class="flex items-center justify-center space-x-1">
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                    <span>Pts</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/50" id="rankingTableBody">
                                        @foreach ($rankings as $index => $ranking)
                                            <tr class="group hover:bg-gradient-to-r hover:from-slate-700/30 hover:to-slate-600/20 transition-all duration-500 cursor-pointer relative overflow-hidden"
                                                onclick="openModal('{{ $ranking->usuario }}', '{{ $ranking->nickname }}')">

                                                <!-- Position -->
                                                <td class="px-4 py-4 whitespace-nowrap text-center relative">
                                                    <div class="flex items-center justify-center">
                                                        @if ($ranking->puesto == 1)
                                                            <div class="relative">
                                                                <i
                                                                    class="fas fa-crown text-yellow-400 text-lg animate-pulse"></i>
                                                                <div
                                                                    class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-300 rounded-full animate-ping">
                                                                </div>
                                                            </div>
                                                        @elseif($ranking->puesto == 2)
                                                            <i class="fas fa-medal text-gray-400 text-base"></i>
                                                        @elseif($ranking->puesto == 3)
                                                            <i class="fas fa-medal text-orange-400 text-base"></i>
                                                        @else
                                                            <div
                                                                class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center border border-slate-600 group-hover:border-purple-500/50 transition-colors">
                                                                <span
                                                                    class="text-sm font-bold text-gray-400 group-hover:text-purple-400">{{ $ranking->puesto }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>

                                                <!-- User Info with Photo -->
                                                <td class="px-4 py-4 text-left relative">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ $ranking->profile_photo_url }}"
                                                                alt="{{ $ranking->usuario }}"
                                                                class="w-12 h-12 rounded-full border-2 border-slate-600/50 group-hover:border-purple-500/50 transition-colors object-cover">
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div
                                                                class="text-base font-semibold text-gray-200 group-hover:text-purple-400 transition-colors">
                                                                {{ $ranking->usuario }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $ranking->nickname ?? 'Sin nickname' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Universidad -->
                                                <td class="px-4 py-4 text-left relative">
                                                    <div class="max-w-xs">
                                                        <div class="text-sm text-gray-300 font-medium truncate"
                                                            title="{{ $ranking->universidad }}">
                                                            {{ $ranking->universidad }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            Institución educativa
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Points -->
                                                <td class="px-4 py-4 whitespace-nowrap text-center relative">
                                                    @if ($ranking->puesto <= 3)
                                                        <span
                                                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-black shadow-lg border-2 transform group-hover:scale-105 transition-transform
                                                        {{ $ranking->puesto == 1
                                                            ? 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-yellow-900 border-yellow-500 shadow-yellow-500/25'
                                                            : ($ranking->puesto == 2
                                                                ? 'bg-gradient-to-r from-gray-400 to-gray-600 text-gray-900 border-gray-500 shadow-gray-500/25'
                                                                : 'bg-gradient-to-r from-orange-400 to-orange-600 text-orange-900 border-orange-500 shadow-orange-500/25') }}">
                                                            <i class="fas fa-star mr-2 text-sm"></i>
                                                            {{ $ranking->total_puntos }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-semibold bg-gradient-to-r from-slate-600 to-slate-700 text-gray-200 border border-slate-500/50 shadow-lg group-hover:from-purple-600/20 group-hover:to-purple-700/20 group-hover:border-purple-500/50 transition-all">
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

                    <!-- Quick Stats Section -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-slate-800/60 backdrop-blur-md rounded-3xl border border-slate-700/50 shadow-2xl shadow-slate-900/50 overflow-hidden relative">
                            <!-- Quick Stats header -->
                            <div
                                class="bg-gradient-to-r from-yellow-900/30 via-orange-900/20 to-red-900/30 p-6 border-b border-slate-700/50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-yellow-400 flex items-center">
                                            <i class="fas fa-chart-bar mr-3 text-yellow-400"></i>
                                            Estadísticas
                                        </h3>
                                        <p class="text-gray-400 text-sm mt-1">Resumen del ranking</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Stats content -->
                            <div class="p-6 space-y-4" id="rankingStats">
                                <!-- Top 3 Quick View -->
                                @foreach ($rankings->take(3) as $index => $ranking)
                                    <div
                                        class="flex items-center space-x-3 p-4 rounded-xl 
                                        {{ $index == 0
                                            ? 'bg-gradient-to-r from-yellow-900/20 to-yellow-800/20 border border-yellow-500/30'
                                            : ($index == 1
                                                ? 'bg-gradient-to-r from-gray-900/20 to-gray-800/20 border border-gray-500/30'
                                                : 'bg-gradient-to-r from-orange-900/20 to-orange-800/20 border border-orange-500/30') }}">
                                        <div class="relative">
                                            <img src="{{ $ranking->profile_photo_url }}"
                                                alt="{{ $ranking->usuario }}"
                                                class="w-10 h-10 rounded-full border-2 {{ $index == 0 ? 'border-yellow-400/50' : ($index == 1 ? 'border-gray-400/50' : 'border-orange-400/50') }} object-cover">
                                            <div
                                                class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full flex items-center justify-center
                                                {{ $index == 0 ? 'bg-yellow-400' : ($index == 1 ? 'bg-gray-400' : 'bg-orange-400') }}">
                                                <i
                                                    class="fas {{ $index == 0 ? 'fa-crown' : 'fa-medal' }} text-white text-xs"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div
                                                class="text-sm font-bold {{ $index == 0 ? 'text-yellow-300' : ($index == 1 ? 'text-gray-300' : 'text-orange-300') }} truncate">
                                                {{ $ranking->usuario }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                {{ $ranking->puesto }}° lugar • {{ $ranking->total_puntos }} pts
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Divider -->
                                <div class="border-t border-slate-700/50 my-6"></div>

                                <!-- Additional Stats -->
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400">Total de participantes:</span>
                                        <span class="text-white font-bold">{{ count($rankings) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400">Puntos promedio:</span>
                                        <span
                                            class="text-white font-bold">{{ round($rankings->avg('total_puntos')) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-400">Último actualizado:</span>
                                        <span class="text-green-400 font-bold text-xs">Hace pocos segundos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Include Modal -->
    @include('layouts.userModal')

    <!-- Scripts Configuration -->
    <script>
        // Configuración global para el ranking manager
        window.hasRankings = {{ $rankings->isEmpty() ? 'false' : 'true' }};

        @if (!$rankings->isEmpty())
            window.routes = {
                json: '{{ route('ranking.json') }}'
            };
        @endif
    </script>
</x-app-layout>

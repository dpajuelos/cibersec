<table class="min-w-full">
    <thead class="bg-slate-900/60 border-b border-slate-700/50 backdrop-blur-sm">
        <tr>
            <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <i class="fas fa-user text-cyan-400 group-hover:scale-110 transition-transform"></i>
                    <span class="group-hover:text-cyan-400 transition-colors">Usuario</span>
                </div>
            </th>
            <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <i class="fab fa-github text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span class="group-hover:text-purple-400 transition-colors">GitHub</span>
                </div>
            </th>
            <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <i class="fas fa-university text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span class="group-hover:text-blue-400 transition-colors">Universidad</span>
                </div>
            </th>
            <th scope="col" class="px-8 py-6 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <i class="fas fa-id-badge text-green-400 group-hover:scale-110 transition-transform"></i>
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
                            <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->usuario }}"
                                class="h-14 w-14 rounded-full object-cover ring-2 ring-slate-600 group-hover:ring-cyan-400 transition-all duration-500 shadow-lg group-hover:shadow-cyan-500/25">
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-slate-800 shadow-lg
                                {{ $usuario->estadousuario == 1 ? 'bg-green-400 animate-pulse' : 'bg-red-400' }}">
                            </div>
                            @if ($usuario->estadousuario == 1)
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
                                    class="fas fa-circle mr-2 text-xs {{ $usuario->estadousuario == 1 ? 'text-green-400 animate-pulse' : 'text-red-400' }}"></i>
                                <span
                                    class="group-hover:text-gray-300 transition-colors">{{ $usuario->estadousuario == 1 ? 'Activo' : 'Inactivo' }}</span>
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
                        <span class="truncate max-w-32 font-mono text-sm">{{ basename($usuario->link) }}</span>
                        <i
                            class="fas fa-external-link-alt ml-3 text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
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

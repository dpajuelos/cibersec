<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('CiberSec UNASAM - Admisión 2.0') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute top-1/2 -left-8 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000">
            </div>
            <div
                class="absolute bottom-10 right-1/3 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse delay-500">
            </div>
        </div>

        <div class="relative pt-16 pb-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <!-- Main Title with better hierarchy -->
                <div class="mb-12">
                    <!-- Badge with countdown timer -->
                    <div
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600/20 to-purple-600/20 border border-cyan-400/30 rounded-full text-cyan-400 text-sm font-medium mb-8 backdrop-blur-sm">
                        <i class="fas fa-rocket mr-3 animate-pulse"></i>
                        <span class="mr-3">Segunda Edición - Admisión 2025</span>
                        <span class="px-3 py-1 bg-cyan-400/20 rounded-full text-xs font-bold">
                            <i class="fas fa-clock mr-1"></i>
                            ACTIVO
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-8 leading-tight">
                        <span
                            class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 text-transparent bg-clip-text drop-shadow-2xl">
                            CiberSec UNASAM
                        </span>
                        <br>
                        <span class="text-white text-3xl md:text-5xl lg:text-6xl mt-6 block font-bold">
                            Recruit Challenge 2.0
                        </span>
                    </h1>
                </div>

                <!-- Enhanced Subtitle with visual separator -->
                <div class="mb-6">
                    <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-400 mx-auto mb-6 rounded-full"></div>
                    <p class="text-xl md:text-2xl text-gray-300 mb-6 max-w-4xl mx-auto leading-relaxed">
                        ¿Tienes lo necesario para unirte a la élite de
                        <span class="text-cyan-400 font-bold relative">
                            hackers éticos
                            <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-cyan-400/50"></span>
                        </span>
                        de UNASAM?
                    </p>
                    <p class="text-lg text-gray-400 max-w-3xl mx-auto">
                        Demuestra tus habilidades en nuestro proceso de admisión más desafiante y forma parte del futuro
                        de la ciberseguridad.
                    </p>
                </div>

                <!-- Enhanced Stats Counter with micro-interactions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 max-w-4xl mx-auto">
                    <div
                        class="group bg-blue-900/40 backdrop-blur-md rounded-xl p-6 border border-blue-500/30 hover:border-cyan-400/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/20">
                        <div class="flex items-center justify-center mb-3">
                            <i class="fas fa-users text-cyan-400 text-2xl mr-3"></i>
                            <div class="text-4xl font-black text-cyan-400 group-hover:text-cyan-300 transition-colors">
                                {{ \App\Models\User::count() }}+
                            </div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Candidatos Registrados</div>
                        <div class="w-full bg-cyan-900/30 rounded-full h-2 mt-3">
                            <div
                                class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full w-3/4 animate-pulse">
                            </div>
                        </div>
                    </div>

                    <div
                        class="group bg-purple-900/40 backdrop-blur-md rounded-xl p-6 border border-purple-500/30 hover:border-purple-400/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20">
                        <div class="flex items-center justify-center mb-3">
                            <i class="fas fa-layer-group text-purple-400 text-2xl mr-3"></i>
                            <div
                                class="text-4xl font-black text-purple-400 group-hover:text-purple-300 transition-colors">
                                6</div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Categorías de Retos</div>
                        <div class="flex justify-center mt-3 space-x-1">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"
                                    style="animation-delay: {{ $i * 100 }}ms"></div>
                            @endfor
                        </div>
                    </div>

                    <div
                        class="group bg-green-900/40 backdrop-blur-md rounded-xl p-6 border border-green-500/30 hover:border-green-400/50 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20">
                        <div class="flex items-center justify-center mb-3">
                            <i class="fas fa-stopwatch text-green-400 text-2xl mr-3"></i>
                            <div
                                class="text-4xl font-black text-green-400 group-hover:text-green-300 transition-colors">
                                48H</div>
                        </div>
                        <div class="text-gray-300 text-sm font-medium">Duración del Challenge</div>
                        <div class="text-xs text-green-400 mt-2 font-medium">
                            <i class="fas fa-fire mr-1"></i>
                            Tiempo límite activo
                        </div>
                    </div>
                </div>

                <!-- Enhanced CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                    @auth
                        <a href="{{ route('retos') }}"
                            class="group relative px-10 py-5 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold rounded-xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/30 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-cyan-500/50"
                            role="button" aria-label="Iniciar retos CTF">
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-flag mr-3 group-hover:animate-pulse"></i>
                                Iniciar Retos
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity">
                            </div>
                        </a>
                        <a href="/ranking"
                            class="px-10 py-5 border-2 border-purple-500 text-purple-400 font-bold rounded-xl hover:bg-purple-500 hover:text-white transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/30 focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                            role="button" aria-label="Ver ranking de participantes">
                            <i class="fas fa-trophy mr-3"></i>
                            Ver Ranking
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="group relative px-10 py-5 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold rounded-xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/30 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-cyan-500/50"
                            role="button" aria-label="Registrarse para el challenge">
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-user-plus mr-3 group-hover:animate-pulse"></i>
                                Unirse al Challenge
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity">
                            </div>
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-10 py-5 border-2 border-purple-500 text-purple-400 font-bold rounded-xl hover:bg-purple-500 hover:text-white transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/30 focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                            role="button" aria-label="Iniciar sesión">
                            <i class="fas fa-sign-in-alt mr-3"></i>
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="flex flex-col items-center animate-bounce">
                <span class="text-cyan-400 text-xs mb-2 font-medium">Explorar categorías</span>
                <i class="fas fa-chevron-down text-cyan-400 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Challenge Categories -->
    <div class="bg-gradient-to-b from-slate-800 to-slate-900 py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-600/10 to-purple-600/10 border border-cyan-400/20 rounded-full text-cyan-400 text-sm font-medium mb-6">
                    <i class="fas fa-layer-group mr-2"></i>
                    Dominios Especializados
                </div>
                <h2 class="text-5xl md:text-6xl font-black mb-8">
                    <span class="bg-gradient-to-r from-cyan-400 to-purple-400 text-transparent bg-clip-text">
                        Categorías de Retos
                    </span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Seis dominios especializados donde demostrarás tu expertise en ciberseguridad y destacarás entre los
                    mejores
                </p>
            </div>

            <!-- Enhanced Categories-->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Cryptography -->
                <div
                    class="group relative bg-gradient-to-br from-blue-900/60 to-cyan-900/60 backdrop-blur-md rounded-2xl p-8 border border-cyan-500/30 hover:border-cyan-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-cyan-400/20 text-cyan-400 px-2 py-1 rounded-full text-xs font-bold">
                            Avanzado
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="p-4 bg-cyan-500/20 rounded-xl mr-4 group-hover:bg-cyan-500/30 transition-colors">
                            <i
                                class="fas fa-lock text-cyan-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-cyan-400 group-hover:text-cyan-300 transition-colors">
                            Criptografía</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Descifra algoritmos, rompe implementaciones débiles y domina tanto cifrados clásicos como
                        modernos.
                        Desde César hasta RSA, cada reto pondrá a prueba tu comprensión matemática y analítica.
                    </p>
                    <div class="flex items-center justify-between text-cyan-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-chart-line mr-2"></i>
                            Intermedio - Avanzado
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-cyan-400/5 to-blue-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <!-- Steganography -->
                <div
                    class="group relative bg-gradient-to-br from-purple-900/60 to-pink-900/60 backdrop-blur-md rounded-2xl p-8 border border-purple-500/30 hover:border-purple-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-purple-400/20 text-purple-400 px-2 py-1 rounded-full text-xs font-bold">
                            Intermedio
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div
                            class="p-4 bg-purple-500/20 rounded-xl mr-4 group-hover:bg-purple-500/30 transition-colors">
                            <i
                                class="fas fa-eye-slash text-purple-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-purple-400 group-hover:text-purple-300 transition-colors">
                            Esteganografía</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Encuentra secretos ocultos en archivos aparentemente normales. Analiza metadatos, bits LSB,
                        canales de color y patrones invisibles al ojo humano.
                    </p>
                    <div class="flex items-center justify-between text-purple-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            Principiante - Intermedio
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-400/5 to-pink-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <!-- Web Exploitation -->
                <div
                    class="group relative bg-gradient-to-br from-red-900/60 to-orange-900/60 backdrop-blur-md rounded-2xl p-8 border border-red-500/30 hover:border-red-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-red-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-red-400/20 text-red-400 px-2 py-1 rounded-full text-xs font-bold">
                            Avanzado
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="p-4 bg-red-500/20 rounded-xl mr-4 group-hover:bg-red-500/30 transition-colors">
                            <i
                                class="fas fa-globe text-red-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-red-400 group-hover:text-red-300 transition-colors">Web
                            Exploitation</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Explota vulnerabilidades web desde SQL injection hasta XSS avanzado. Bypass de autenticación,
                        CSRF y configuraciones inseguras te esperan.
                    </p>
                    <div class="flex items-center justify-between text-red-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-fire mr-2"></i>
                            Intermedio - Avanzado
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-400/5 to-orange-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <!-- OSINT -->
                <div
                    class="group relative bg-gradient-to-br from-green-900/60 to-teal-900/60 backdrop-blur-md rounded-2xl p-8 border border-green-500/30 hover:border-green-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-green-400/20 text-green-400 px-2 py-1 rounded-full text-xs font-bold">
                            Intermedio
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="p-4 bg-green-500/20 rounded-xl mr-4 group-hover:bg-green-500/30 transition-colors">
                            <i
                                class="fas fa-satellite-dish text-green-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-green-400 group-hover:text-green-300 transition-colors">
                            OSINT</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Conviértete en detective digital. Rastrea información pública, conecta pistas dispersas
                        y descubre secretos escondidos a plena vista en Internet.
                    </p>
                    <div class="flex items-center justify-between text-green-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-binoculars mr-2"></i>
                            Principiante - Intermedio
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-400/5 to-teal-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <!-- Forensics -->
                <div
                    class="group relative bg-gradient-to-br from-indigo-900/60 to-blue-900/60 backdrop-blur-md rounded-2xl p-8 border border-indigo-500/30 hover:border-indigo-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-indigo-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-indigo-400/20 text-indigo-400 px-2 py-1 rounded-full text-xs font-bold">
                            Avanzado
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div
                            class="p-4 bg-indigo-500/20 rounded-xl mr-4 group-hover:bg-indigo-500/30 transition-colors">
                            <i
                                class="fas fa-search-plus text-indigo-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-indigo-400 group-hover:text-indigo-300 transition-colors">
                            Forense Digital</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Analiza evidencia digital, recupera archivos eliminados, examina logs del sistema
                        y reconstruye la cronología de incidentes de seguridad.
                    </p>
                    <div class="flex items-center justify-between text-indigo-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-microscope mr-2"></i>
                            Intermedio - Avanzado
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-400/5 to-blue-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>

                <!-- Knowledge Check -->
                <div
                    class="group relative bg-gradient-to-br from-yellow-900/60 to-amber-900/60 backdrop-blur-md rounded-2xl p-8 border border-yellow-500/30 hover:border-yellow-400/60 transition-all duration-500 hover:transform hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20 cursor-pointer">
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-yellow-400/20 text-yellow-400 px-2 py-1 rounded-full text-xs font-bold">
                            Todos
                        </span>
                    </div>
                    <div class="flex items-center mb-6">
                        <div
                            class="p-4 bg-yellow-500/20 rounded-xl mr-4 group-hover:bg-yellow-500/30 transition-colors">
                            <i
                                class="fas fa-brain text-yellow-400 text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-400 group-hover:text-yellow-300 transition-colors">
                            Knowledge Check</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 group-hover:text-gray-200 transition-colors">
                        Pon a prueba tu conocimiento teórico en ciberseguridad. Historia, protocolos, herramientas
                        y conceptos fundamentales que todo profesional debe dominar.
                    </p>
                    <div class="flex items-center justify-between text-yellow-400 text-sm">
                        <span class="flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Todos los niveles
                        </span>
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-amber-400/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>
            </div>

            <!-- Progress indicator -->
            <div class="text-center mt-16">
                <p class="text-gray-400 text-sm mb-4">Completa retos en todas las categorías para maximizar tu
                    puntuación</p>
                <div class="w-48 h-2 bg-slate-700 rounded-full mx-auto">
                    <div class="h-2 bg-gradient-to-r from-cyan-400 to-purple-400 rounded-full w-0 animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Call to Action Section -->
    <div class="relative bg-gradient-to-r from-cyan-900 via-blue-900 to-purple-900 py-24 overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-purple-500/10"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <span
                    class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white text-sm font-medium mb-6">
                    <i class="fas fa-star mr-2"></i>
                    ¡Última oportunidad para destacar!
                </span>
                <h2 class="text-5xl md:text-6xl font-black mb-8 text-white leading-tight">
                    ¿Listo para el
                    <span class="bg-gradient-to-r from-cyan-400 to-purple-400 text-transparent bg-clip-text">
                        Challenge?
                    </span>
                </h2>
            </div>

            <p class="text-2xl text-gray-200 mb-6 max-w-3xl mx-auto leading-relaxed">
                Solo los mejores serán seleccionados para formar parte del equipo CiberSec UNASAM.
            </p>
            <p class="text-lg text-gray-300 mb-12 max-w-2xl mx-auto">
                ¿Tienes lo que se necesita para estar entre la élite de la ciberseguridad?
            </p>

            @guest
                <div class="space-y-6 sm:space-y-0 sm:space-x-6 sm:flex sm:justify-center">
                    <a href="{{ route('register') }}"
                        class="group inline-block relative px-12 py-6 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold rounded-2xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/30 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-cyan-500/50">
                        <span class="relative z-10 flex items-center text-lg">
                            <i class="fas fa-rocket mr-3 group-hover:animate-pulse"></i>
                            Comenzar Ahora
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-2xl opacity-0 group-hover:opacity-20 transition-opacity">
                        </div>
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block px-12 py-6 border-2 border-white text-white font-bold rounded-2xl hover:bg-white hover:text-gray-900 transition-all duration-300 hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-white/50 text-lg">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        Ya tengo cuenta
                    </a>
                </div>
            @else
                <a href="{{ route('retos') }}"
                    class="group inline-block relative px-12 py-6 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-bold rounded-2xl hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/30 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-cyan-500/50">
                    <span class="relative z-10 flex items-center text-lg">
                        <i class="fas fa-flag mr-3 group-hover:animate-pulse"></i>
                        Continuar Retos
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-2xl opacity-0 group-hover:opacity-20 transition-opacity">
                    </div>
                </a>
            @endauth

            <!-- Social proof -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold text-cyan-400 mb-2">95%</div>
                    <div class="text-gray-300 text-sm">Tasa de satisfacción</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-400 mb-2">24/7</div>
                    <div class="text-gray-300 text-sm">Soporte disponible</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">100%</div>
                    <div class="text-gray-300 text-sm">Gratuito y accesible</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced floating particles effect -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-cyan-400 rounded-full opacity-30 animate-ping"></div>
        <div class="absolute top-3/4 right-1/4 w-2 h-2 bg-purple-400 rounded-full opacity-40 animate-pulse"></div>
        <div class="absolute top-1/2 left-3/4 w-2.5 h-2.5 bg-blue-400 rounded-full opacity-25 animate-ping delay-1000">
        </div>
        <div
            class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-green-400 rounded-full opacity-35 animate-pulse delay-500">
        </div>
        <div class="absolute bottom-1/4 left-1/2 w-2 h-2 bg-yellow-400 rounded-full opacity-30 animate-ping delay-700">
        </div>
    </div>
</x-app-layout>

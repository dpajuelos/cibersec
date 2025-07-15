<footer class="bg-gradient-to-t from-slate-900 via-slate-800 to-blue-900 border-t border-blue-500/30 shadow-lg">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo y descripción -->
            <div class="md:col-span-1">
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="CIBERSEC Logo" class="h-12 w-12 mr-3">
                    <h3
                        class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 text-transparent bg-clip-text">
                        CIBERSEC-UNASAM
                    </h3>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Plataforma CTF dedicada al aprendizaje y práctica de ciberseguridad.
                    Desafía tus habilidades en un entorno seguro y educativo.
                </p>
            </div>

            <!-- Contacto -->
            <div>
                <h3 class="text-lg font-bold text-cyan-400 mb-4 flex items-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Contacto
                </h3>
                <ul class="space-y-3">
                    <li class="text-gray-300 hover:text-cyan-400 transition-colors flex items-center">
                        <i class="fas fa-envelope mr-3 text-cyan-400 w-4"></i>
                        <a href="mailto:cibersec@unasam.edu.pe" class="hover:underline">
                            cibersec@unasam.edu.pe
                        </a>
                    </li>
                    <li class="text-gray-300 flex items-center">
                        <i class="fas fa-phone mr-3 text-cyan-400 w-4"></i>
                        +51 999 888 777
                    </li>
                    <li class="text-gray-300 flex items-center">
                        <i class="fas fa-map-marker-alt mr-3 text-cyan-400 w-4"></i>
                        Huaraz, Ancash, Perú
                    </li>
                </ul>
            </div>

            <!-- Enlaces Rápidos -->
            <div>
                <h3 class="text-lg font-bold text-purple-400 mb-4 flex items-center">
                    <i class="fas fa-link mr-2"></i>
                    Enlaces Rápidos
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('retos') }}"
                            class="text-gray-300 hover:text-purple-400 transition-colors flex items-center">
                            <i class="fas fa-flag mr-2 text-purple-400"></i>
                            Retos CTF
                        </a>
                    </li>
                    <li>
                        <a href="/ranking"
                            class="text-gray-300 hover:text-purple-400 transition-colors flex items-center">
                            <i class="fas fa-trophy mr-2 text-purple-400"></i>
                            Ranking
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="{{ route('terms.show') }}"
                            class="text-gray-300 hover:text-purple-400 transition-colors flex items-center">
                            <i class="fas fa-file-contract mr-2 text-purple-400"></i>
                            Términos y Condiciones
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="{{ route('policy.show') }}"
                            class="text-gray-300 hover:text-purple-400 transition-colors flex items-center">
                            <i class="fas fa-user-shield mr-2 text-purple-400"></i>
                            Política de Privacidad
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Redes Sociales y Stats -->
            <div>
                <h3 class="text-lg font-bold text-blue-400 mb-4 flex items-center">
                    <i class="fas fa-users mr-2"></i>
                    Comunidad
                </h3>

                <!-- Redes Sociales -->
                <div class="flex space-x-4 mb-6">
                    <a target="_blank" href="https://www.facebook.com/cibersecunasam"
                        class="text-gray-400 hover:text-blue-500 transition-colors bg-blue-900/30 p-3 rounded-lg hover:bg-blue-800/50">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a target="_blank" href="https://www.linkedin.com/company/cibersec-unasam/posts/?feedView=all"
                        class="text-gray-400 hover:text-blue-400 transition-colors bg-blue-900/30 p-3 rounded-lg hover:bg-blue-800/50">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/cibersecunasam/"
                        class="text-gray-400 hover:text-pink-500 transition-colors bg-blue-900/30 p-3 rounded-lg hover:bg-pink-800/50">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>

                <!-- Stats rápidas -->
                <div class="bg-blue-900/20 rounded-lg p-4 border border-blue-500/20">
                    <div class="text-center">
                        <div class="text-cyan-400 font-bold text-lg">{{ \App\Models\User::count() }}+</div>
                        <div class="text-gray-400 text-sm">Hackers Éticos</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Línea divisoria con efectos -->
        <div class="mt-12 pt-8 border-t border-gradient-to-r from-transparent via-blue-500/30 to-transparent">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">
                        © {{ date('Y') }} CIBERSEC-UNASAM. Todos los derechos reservados.
                    </p>
                    <p class="text-gray-500 text-xs mt-1">
                        Desarrollado con <i class="fas fa-heart text-red-500"></i> para la comunidad hacker ética
                    </p>
                </div>

                <!-- Badges CTF -->
                <div class="flex items-center space-x-3">
                    <span
                        class="bg-gradient-to-r from-green-600 to-green-700 text-white px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-lock mr-1"></i>
                        Secure Platform
                    </span>
                    <span
                        class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-code mr-1"></i>
                        CTF Ready
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Efecto de partículas de fondo -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-1 -left-1 w-2 h-2 bg-cyan-400 rounded-full opacity-20 animate-pulse"></div>
        <div class="absolute top-1/2 right-10 w-1 h-1 bg-blue-400 rounded-full opacity-30 animate-ping"></div>
        <div class="absolute bottom-10 left-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-25 animate-pulse"></div>
    </div>
</footer>

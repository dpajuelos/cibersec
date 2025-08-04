<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 overflow-hidden py-4">
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

        <!-- CTF Side Effects -->
        <!-- Left Side CTF Elements -->
        <div class="fixed left-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Terminal Window -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-green-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="flex items-center mb-3">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <span class="ml-2 text-green-400 text-xs font-mono">terminal.exe</span>
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">$ whoami</div>
                        <div class="text-white">cybersec_candidate</div>
                        <div class="text-green-400">$ cat flag.txt</div>
                        <div class="text-white animate-pulse">UNASAM{w3lc0m3_t0_cyb3r}</div>
                        <div class="text-green-400">$ <span class="animate-pulse">_</span></div>
                    </div>
                </div>

                <!-- Hex Viewer -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-cyan-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-white text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-terminal mr-2"></i>
                        HEX VIEWER
                    </div>
                    <div class="font-mono text-xs space-y-1 text-gray-300">
                        <div>00000000: 464c 4147 7b63 7962 FLAG{cyb</div>
                        <div>00000010: 6572 7365 6375 7269 ersecuri</div>
                        <div class="text-purple-400 animate-pulse">00000020: 7479 5f69 735f 6675 ty_is_fu</div>
                        <div>00000030: 6e7d 0a00 0000 0000 n}....</div>
                    </div>
                </div>

                <!-- Network Traffic -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-purple-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-purple-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-wifi mr-2 animate-pulse"></i>
                        NETWORK TRAFFIC
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">✓ TCP 192.168.1.100:22</div>
                        <div class="text-yellow-400">⚠ HTTP 10.0.0.1:80</div>
                        <div class="text-red-400 animate-pulse">✗ HTTPS 172.16.0.5:443</div>
                        <div class="text-blue-400">📡 DNS 8.8.8.8:53</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side CTF Elements -->
        <div class="fixed right-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Hash Cracker -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-yellow-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-yellow-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-lock mr-2"></i>
                        HASH CRACKER
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-400">MD5: 5d41402abc4b2a...</div>
                        <div class="text-green-400">✓ Cracked: hello</div>
                        <div class="text-gray-400">SHA1: aaf4c61ddcc5e8...</div>
                        <div class="text-yellow-400 animate-pulse">⚡ Cracking...</div>
                        <div class="w-full bg-slate-700 rounded-full h-1 mt-2">
                            <div class="bg-yellow-400 h-1 rounded-full w-3/4 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Steganography Tool -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-pink-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-pink-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-image mr-2"></i>
                        STEGANOGRAPHY
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-300">📸 image.jpg</div>
                        <div class="text-white">LSB Analysis: ✓</div>
                        <div class="text-green-400">Hidden data found!</div>
                        <div class="text-purple-400 animate-pulse">flag{h1dd3n_m3ss4g3}</div>
                    </div>
                </div>

                <!-- SQL Injection -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-red-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-red-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-database mr-2"></i>
                        SQL INJECTION
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-300">Target: /login.php</div>
                        <div class="text-yellow-400">Payload: ' OR 1=1--</div>
                        <div class="text-green-400 animate-pulse">✓ Bypassed!</div>
                        <div class="text-white">Admin access gained</div>
                    </div>
                </div>

                <!-- Forensics -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-indigo-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-indigo-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-search mr-2"></i>
                        FORENSICS
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-300">🔍 Analyzing logs...</div>
                        <div class="text-blue-400">Timestamp: 14:23:17</div>
                        <div class="text-yellow-400">Suspicious activity</div>
                        <div class="text-red-400 animate-pulse">Evidence found!</div>
                    </div>
                </div>
            </div>
        </div>

        <x-authentication-card>
            <x-slot name="logo">
                <div class="flex flex-col items-center justify-center text-center">
                    <x-authentication-card-logo class="mx-auto" />
                    <p class="text-lg text-gray-300 mt-4">Forma parte de nuestra comunidad</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-400 mx-auto mt-2 rounded-full"></div>
                </div>
            </x-slot>

            <div class="relative bg-slate-900/80 backdrop-blur-md rounded-2xl p-8 border border-cyan-500/30 shadow-2xl">
                <form method="POST" action="{{ route('register') }}" id="register" name="register">
                    @csrf
                    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-6">
                        <!-- Nombres -->
                        <div class="">
                            <x-label for="name" value="{{ __('Nombres') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Nombres') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="name"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="name" required autofocus autocomplete="name"
                                    autocomplete="off" placeholder="Ingrese sus nombres" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-user text-blue-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Usuario -->
                        <div>
                            <x-label for="usuario" value="{{ __('Usuario') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Usuario') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="usuario"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="usuario" required autofocus autocomplete="usuario"
                                    autocomplete="off" placeholder="Nickname o usuario" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-user-circle text-indigo-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                        </div>

                        <!-- Apellido paterno -->
                        <div>
                            <x-label for="paterno" value="{{ __('Apellido paterno') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Apellido paterno') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="paterno"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="paterno" required autofocus autocomplete="paterno"
                                    autocomplete="off" placeholder="Apellido paterno" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-user-tag text-blue-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Apellido materno -->
                        <div>
                            <x-label for="materno" value="{{ __('Apellido materno') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Apellido materno') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="materno"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="materno" required autofocus autocomplete="materno"
                                    autocomplete="off" placeholder="Apellido materno" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-user-tag text-indigo-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- DNI -->
                        <div>
                            <x-label for="dni" value="{{ __('DNI') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('DNI') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="dni"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="dni" required autocomplete="dni" autocomplete="off"
                                    placeholder="Ingrese el número de su DNI" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-fingerprint text-purple-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                        </div>

                        <!-- Fecha de nacimiento -->
                        <div>
                            <x-label for="fecnac" value="{{ __('Fecha de nacimiento') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Fecha de nacimiento') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="fecnac"
                                    class="block mt-1 w-full bg-slate-800/80 border-2 border-blue-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50 pl-12 pr-12 py-3"
                                    type="date" name="fecnac" required autocomplete="fecnac" />

                                <!-- Icono izquierdo -->
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <i class="fas fa-calendar-alt text-cyan-400 text-sm"></i>
                                </div>

                                <!-- Icono derecho para indicar que es clickeable -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <i class="fas fa-chevron-down text-cyan-400/60 text-xs"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                        </div>

                        <!-- Celular -->
                        <div>
                            <x-label for="celular" value="{{ __('Celular') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Celular') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="celular"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="text" name="celular" required autocomplete="celular" autocomplete="off"
                                    placeholder="Ingrese su celular" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-mobile-alt text-blue-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                        </div>

                        <!-- Género -->
                        <div>
                            <x-label for="genero" value="{{ __('Género') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Género') }}
                            </x-label>
                            <div class="relative">
                                <select
                                    class="custom-select block mt-1 w-full bg-slate-800/80 border-2 border-blue-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 rounded-xl text-white backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50 pl-12 pr-12 py-3 appearance-none cursor-pointer"
                                    name="genero" id="genero" required autocomplete="genero">
                                    <option value="" disabled selected class="bg-slate-800 text-gray-400">
                                        Seleccionar género
                                    </option>
                                    <option value="Masculino" class="bg-slate-800 text-white hover:bg-cyan-600">
                                        Masculino
                                    </option>
                                    <option value="Femenino" class="bg-slate-800 text-white hover:bg-cyan-600">
                                        Femenino
                                    </option>
                                    <option value="Otro" class="bg-slate-800 text-white hover:bg-cyan-600">Prefiero
                                        no
                                        decirlo</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <i class="fas fa-user-friends text-indigo-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Universidad -->
                        <div class="lg:col-span-2 sm:cols-span-1">
                            <x-label for="universidad" value="{{ __('Universidad') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Universidad') }}
                            </x-label>
                            <div class="relative">
                                <select
                                    class="custom-select block mt-1 w-full bg-slate-800/80 border-2 border-blue-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 rounded-xl text-white backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50 pl-12 pr-12 py-3 appearance-none cursor-pointer"
                                    name="universidad" id="universidad" required autocomplete="universidad">
                                    <option value="" disabled selected class="bg-slate-800 text-gray-400">
                                        Seleccionar
                                        universidad</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <i class="fas fa-graduation-cap text-cyan-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="lg:col-span-2 sm:cols-span-1">
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Email') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="email"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="email" name="email" required autocomplete="email" autocomplete="off"
                                    placeholder="usuario@universidad.edu.pe" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-at text-blue-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <x-label for="password" value="{{ __('Contraseña') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Contraseña') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="password"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="password" name="password" required autocomplete="new-password"
                                    placeholder="Ingrese su contraseña segura" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-key text-indigo-400 text-sm"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>

                            </div>
                            <div class="password-strength hidden mt-1">
                                <div class="flex space-x-1">
                                    <div class="strength-bar h-1 bg-gray-600 rounded flex-1 transition-colors"></div>
                                    <div class="strength-bar h-1 bg-gray-600 rounded flex-1 transition-colors"></div>
                                    <div class="strength-bar h-1 bg-gray-600 rounded flex-1 transition-colors"></div>
                                    <div class="strength-bar h-1 bg-gray-600 rounded flex-1 transition-colors"></div>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5 strength-text">Ingrese una contraseña</p>
                            </div>
                        </div>

                        <!-- Repetir contraseña -->
                        <div>
                            <x-label for="password_confirmation" value="{{ __('Repetir contraseña') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                {{ __('Repetir contraseña') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="password_confirmation"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12 pr-12"
                                    type="password" name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmar contraseña" />

                                <!-- Icono izquierdo -->
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-lock text-purple-400 text-sm"></i>
                                </div>

                                <!-- Indicadores de coincidencia (derecha) -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-check text-green-400 text-xs hidden match-success"></i>
                                    <i class="fas fa-times text-red-400 text-xs hidden match-error"></i>
                                </div>
                            </div>

                            <!-- Mensaje de coincidencia -->
                            <div class="password-match hidden mt-1">
                                <p class="text-xs text-green-400 match-success-text hidden">
                                    <i class="fas fa-check mr-1"></i>Las contraseñas coinciden
                                </p>
                                <p class="text-xs text-red-400 match-error-text hidden">
                                    <i class="fas fa-times mr-1"></i>Las contraseñas no coinciden
                                </p>
                            </div>
                        </div>


                    </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div
                    class="my-6 p-4 bg-gradient-to-r from-cyan-900/20 to-purple-900/20 border border-cyan-400/20 rounded-xl backdrop-blur-sm">
                    <x-label for="terms" class="text-white">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required
                                class="border-cyan-400 text-black focus:ring-cyan-400/20" />

                            <div class="ms-2 text-gray-200">
                                {!! __('Estoy de acuerdo con los :terms_of_service y :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-white hover:text-cyan-300 transition-colors">' .
                                        __('términos de servicio') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-purple-400 hover:text-purple-300 transition-colors">' .
                                        __('políticas de privacidad') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div
                class="flex items-center justify-center mt-6 space-y-4 sm:space-y-0 sm:space-x-4 sm:flex-row flex-col">
                <a class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors flex items-center"
                    href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    {{ __('Ya está registrado?') }}
                </a>

                <x-button
                    class="group relative px-8 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-cyan-500/30 transform hover:scale-105 border-0 rounded-xl">
                    <span class="flex items-center">
                        <i class="fas fa-rocket mr-3 group-hover:animate-pulse"></i>
                        {{ __('Registrarse') }}
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </x-button>
            </div>
            </form>
    </div>
    </x-authentication-card>

    <!-- Floating particles effect -->
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
    </div>
    <style>
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-toast {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .strength-bar {
            transition: background-color 0.3s ease;
        }

        .custom-select:focus {
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
        }
    </style>
    <script>
        $(document).ready(function() {
            // Función única para limpiar errores
            function clearErrors() {
                $('.invalid-feedback').remove();
                $('.password-match').addClass('hidden');
                $('.match-success, .match-error').addClass('hidden');
                $('input, select').removeClass('border-red-500 focus:border-red-500');
                $('input, select').addClass('border-blue-500/30 focus:border-blue-400');
            }

            // Función única para mostrar errores
            function showFieldError(fieldName, message) {
                const field = $(`#${fieldName}`);
                const fieldContainer = field.closest('div').parent();

                // Eliminar errores previos para este campo específico
                fieldContainer.find('.invalid-feedback').remove();

                // Cambiar estilo del campo
                field.removeClass(
                    'border-blue-500/30 border-cyan-400/30 focus:border-blue-400 focus:border-cyan-400 border-green-500/70'
                );
                field.addClass('border-red-500 focus:border-red-500');

                // Crear mensaje de error
                const errorHtml = `
                <div class="invalid-feedback text-red-400 text-xs mt-1 flex items-center animate-fadeIn">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    <span class="error-message">${message}</span>
                </div>
            `;

                // Insertar después del contenedor del campo
                field.closest('div').after(errorHtml);
            }

            // Función para mostrar notificaciones
            function showNotification(message, type = 'error') {
                // Remover notificaciones existentes
                $('.notification-toast').remove();

                const bgColor = type === 'error' ? 'bg-red-600/90 border-red-500/50' :
                    'bg-green-600/90 border-green-500/50';
                const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';

                const notificationHtml = `
                <div class="notification-toast fixed top-4 right-4 z-50 max-w-sm p-4 rounded-xl shadow-lg transition-all duration-300 ${bgColor} backdrop-blur-md transform translate-x-full opacity-0">
                    <div class="flex items-center text-white">
                        <i class="fas ${icon} mr-3"></i>
                        <span>${message}</span>
                    </div>
                </div>
            `;

                $('body').append(notificationHtml);

                // Animación de entrada
                setTimeout(() => {
                    $('.notification-toast').removeClass('translate-x-full opacity-0');
                }, 100);

                // Remover después de 5 segundos
                setTimeout(() => {
                    $('.notification-toast').addClass('translate-x-full opacity-0');
                    setTimeout(() => $('.notification-toast').remove(), 300);
                }, 5000);
            }

            // Validación de fortaleza de contraseña
            function checkPasswordStrength(password) {
                const strengthBars = $('.strength-bar');
                const strengthText = $('.strength-text');
                const strengthContainer = $('.password-strength');

                if (password.length === 0) {
                    strengthContainer.addClass('hidden');
                    return;
                }

                strengthContainer.removeClass('hidden');

                let strength = 0;
                let message = '';
                let color = '';

                // Criterios de fortaleza
                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                // Resetear barras
                strengthBars.removeClass('bg-red-500 bg-yellow-500 bg-blue-500 bg-green-500').addClass(
                    'bg-gray-600');

                switch (strength) {
                    case 0:
                    case 1:
                        strengthBars.eq(0).removeClass('bg-gray-600').addClass('bg-red-500');
                        message = 'Muy débil';
                        color = 'text-red-400';
                        break;
                    case 2:
                        strengthBars.slice(0, 2).removeClass('bg-gray-600').addClass('bg-yellow-500');
                        message = 'Débil';
                        color = 'text-yellow-400';
                        break;
                    case 3:
                        strengthBars.slice(0, 3).removeClass('bg-gray-600').addClass('bg-blue-500');
                        message = 'Moderada';
                        color = 'text-blue-400';
                        break;
                    case 4:
                    case 5:
                        strengthBars.removeClass('bg-gray-600').addClass('bg-green-500');
                        message = 'Fuerte';
                        color = 'text-green-400';
                        break;
                }

                strengthText.removeClass('text-red-400 text-yellow-400 text-blue-400 text-green-400 text-gray-400');
                strengthText.addClass(color).text(message);
            }

            // Validación de coincidencia de contraseñas
            function checkPasswordMatch() {
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();
                const matchContainer = $('.password-match');
                const successText = $('.match-success-text');
                const errorText = $('.match-error-text');
                const successIcon = $('.match-success');
                const errorIcon = $('.match-error');

                if (passwordConfirmation.length === 0) {
                    matchContainer.addClass('hidden');
                    successIcon.addClass('hidden');
                    errorIcon.addClass('hidden');
                    return;
                }

                matchContainer.removeClass('hidden');

                if (password === passwordConfirmation && password.length > 0) {
                    // Contraseñas coinciden
                    successText.removeClass('hidden');
                    errorText.addClass('hidden');
                    successIcon.removeClass('hidden');
                    errorIcon.addClass('hidden');

                    $('#password_confirmation').removeClass('border-red-500').addClass('border-green-500/70');
                } else {
                    // Contraseñas no coinciden
                    successText.addClass('hidden');
                    errorText.removeClass('hidden');
                    successIcon.addClass('hidden');
                    errorIcon.removeClass('hidden');

                    $('#password_confirmation').removeClass('border-green-500/70').addClass('border-red-500');
                }
            }

            // Event listeners
            $('#password').on('input', function() {
                checkPasswordStrength($(this).val());
                checkPasswordMatch();
            });

            fetch(`/universidades`)
                .then(response => response.json())
                .then(data => {
                    const categorySelect = document.getElementById('universidad');
                    categorySelect.innerHTML =
                        `<option value="" disabled selected class="bg-slate-800 text-gray-400">Seleccionar universidad</option>`;
                    data.forEach(universidad => {
                        const option = document.createElement('option');
                        option.value = universidad.iduniversidad;
                        option.text = universidad.nomuniversidad;
                        option.className = 'bg-slate-800 text-white hover:bg-cyan-600';
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar las universidades', error))

            $('#password_confirmation').on('input', function() {
                checkPasswordMatch();
            });

            // Limpiar errores al escribir
            $('input, select').on('input change', function() {
                const field = $(this);
                const fieldContainer = field.closest('div').parent();

                // Restaurar estilos normales
                field.removeClass('border-red-500 focus:border-red-500');
                field.addClass('border-blue-500/30 focus:border-blue-400');

                // Remover mensajes de error específicos del campo
                fieldContainer.find('.invalid-feedback').remove();
            });

            // Envío del formulario
            $('#register').on('submit', function(e) {
                e.preventDefault();
                clearErrors();

                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();

                // Mostrar loading
                submitBtn.html(`
                <span class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Registrando...
                </span>
            `).prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: '/register',
                    data: $(this).serialize(),
                    success: function(response) {
                        showNotification('¡Registro exitoso! Redirigiendo...', 'success');
                        setTimeout(() => {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 1500);
                    },
                    error: function(xhr) {
                        submitBtn.html(originalText).prop('disabled', false);

                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorCount = 0;

                            // Mostrar errores específicos
                            for (const field in errors) {
                                if (errors[field].length > 0) {
                                    showFieldError(field, errors[field][0]);
                                    errorCount++;
                                }
                            }

                            showNotification(
                                `Se encontraron ${errorCount} error(es). Revise los campos marcados.`,
                                'error');

                        } else if (xhr.status === 500) {
                            const errorMessage = xhr.responseJSON?.error ||
                                'Error interno del servidor';
                            showNotification(errorMessage, 'error');
                        } else {
                            showNotification('Error inesperado. Intente nuevamente.', 'error');
                        }
                    }
                });
            });
        });
    </script>

</x-guest-layout>

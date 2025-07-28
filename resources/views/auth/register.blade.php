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
                        <i class="fas fa-code mr-2"></i>
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
                    <p class="text-lg text-gray-300 mt-4">Forma parte de la élite en ciberseguridad</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-400 mx-auto mt-2 rounded-full"></div>
                </div>
            </x-slot>

            <div class="relative bg-slate-900/80 backdrop-blur-md rounded-2xl p-8 border border-cyan-500/30 shadow-2xl">
                <form method="POST" action="{{ route('register') }}" id="register" name="register">
                    @csrf
                    <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-6">
                        <div class="">
                            <x-label for="name" value="{{ __('Nombres') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-user mr-2 text-white"></i>
                                {{ __('Nombres') }}
                            </x-label>
                            <x-input id="name"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="name" required autofocus autocomplete="name" autocomplete="off"
                                placeholder="Ingrese sus nombres" />
                        </div>

                        <div>
                            <x-label for="usuario" value="{{ __('Usuario') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-at mr-2 text-white"></i>
                                {{ __('Usuario') }}
                            </x-label>
                            <x-input id="usuario"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="usuario" required autofocus autocomplete="usuario"
                                autocomplete="off" placeholder="Nickname o usuario" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Este usuario ya existe
                            </div>
                        </div>

                        <div class="lg:col-span-2 sm:cols-span-1">
                            <x-label for="universidad" value="{{ __('Universidad') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-university mr-2 text-white"></i>
                                {{ __('Universidad') }}
                            </x-label>
                            <select
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 rounded-xl text-white placeholder-gray-400 backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                name="universidad" id="universidad" required autocomplete="universidad">
                                <option value="" disabled selected>Seleccionar universidad</option>
                            </select>
                        </div>

                        <div>
                            <x-label for="paterno" value="{{ __('Apellido paterno') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-id-card mr-2 text-white"></i>
                                {{ __('Apellido paterno') }}
                            </x-label>
                            <x-input id="paterno"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="paterno" required autofocus autocomplete="paterno"
                                autocomplete="off" placeholder="Apellido paterno" />
                        </div>

                        <div>
                            <x-label for="materno" value="{{ __('Apellido materno') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-id-card-alt mr-2 text-white"></i>
                                {{ __('Apellido materno') }}
                            </x-label>
                            <x-input id="materno"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="materno" required autofocus autocomplete="materno"
                                autocomplete="off" placeholder="Apellido materno" />
                        </div>

                        <div>
                            <x-label for="dni" value="{{ __('DNI') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-fingerprint mr-2 text-white"></i>
                                {{ __('DNI') }}
                            </x-label>
                            <x-input id="dni"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="dni" required autocomplete="dni" autocomplete="off"
                                placeholder="Ingrese el número de su DNI" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                DNI inválido o registrado
                            </div>
                        </div>

                        <div>
                            <x-label for="fecnac" value="{{ __('Fecha de nacimiento') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-white"></i>
                                {{ __('Fecha de nacimiento') }}
                            </x-label>
                            <x-input id="fecnac"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="date" name="fecnac" required autocomplete="fecnac" autocomplete="off"
                                placeholder="Ingrese su fecha de nacimiento" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Ingrese una fecha válida
                            </div>
                        </div>

                        <div>
                            <x-label for="celular" value="{{ __('Celular') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-mobile-alt mr-2 text-white"></i>
                                {{ __('Celular') }}
                            </x-label>
                            <x-input id="celular"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="text" name="celular" required autocomplete="celular" autocomplete="off"
                                placeholder="Ingrese su celular" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Ingrese un número válido
                            </div>
                        </div>

                        <div>
                            <x-label for="genero" value="{{ __('Género') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-venus-mars mr-2 text-white"></i>
                                {{ __('Género') }}
                            </x-label>
                            <select
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 rounded-xl text-white placeholder-gray-400 backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                name="genero" id="genero" required autocomplete="genero">
                                <option value="" disabled selected>Seleccionar género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Prefiero no decirlo</option>
                            </select>
                        </div>

                        <div class="lg:col-span-2 sm:cols-span-1">
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-envelope mr-2 text-white"></i>
                                {{ __('Email') }}
                            </x-label>
                            <x-input id="email"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="email" name="email" required autocomplete="email" autocomplete="off"
                                placeholder="Ingrese su email" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                El email ya está registrado o no es del formato @domain.edu.pe
                            </div>
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Contraseña') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-lock mr-2 text-white"></i>
                                {{ __('Contraseña') }}
                            </x-label>
                            <x-input id="password"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="password" name="password" required autocomplete="new-password"
                                placeholder="Contraseña" />
                            <div class="invalid-feedback text-red-400 hidden items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Formato incorrecto o contraseñas no coinciden
                            </div>
                        </div>

                        <div>
                            <x-label for="password_confirmation" value="{{ __('Repetir contraseña') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-key mr-2 text-white"></i>
                                {{ __('Repetir contraseña') }}
                            </x-label>
                            <x-input id="password_confirmation"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirmar contraseña" />
                        </div>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div
                            class="my-6 p-4 bg-gradient-to-r from-cyan-900/20 to-purple-900/20 border border-cyan-400/20 rounded-xl backdrop-blur-sm">
                            <x-label for="terms" class="text-white">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required
                                        class="border-cyan-400 text-white focus:ring-cyan-400/20" />

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
            <div
                class="absolute top-1/2 left-3/4 w-2.5 h-2.5 bg-blue-400 rounded-full opacity-25 animate-ping delay-1000">
            </div>
            <div
                class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-green-400 rounded-full opacity-35 animate-pulse delay-500">
            </div>
            <div
                class="absolute bottom-1/4 left-1/2 w-2 h-2 bg-yellow-400 rounded-full opacity-30 animate-ping delay-700">
            </div>
        </div>
    </div>

    <script>
        fetch(`/universidades`)
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('universidad');
                categorySelect.innerHTML = `<option value="" disabled selected>Seleccionar universidad</option>`;
                data.forEach(universidad => {
                    const option = document.createElement('option');
                    option.value = universidad.iduniversidad;
                    option.text = universidad.nomuniversidad;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las universidades', error));
        $(document).ready(function() {
            $('#register').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/register',
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.href = document.referrer || "{{ route('dashboard') }}";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            $('.invalid-feedback').addClass('hidden');
                            for (const field in errors) {
                                $(`#${field}`).next('.invalid-feedback').removeClass('hidden');
                            }
                        } else {
                            alert(
                                'Ocurrió un error inesperado. Por favor, intenta nuevamente: ' +
                                (xhr.responseJSON?.message || 'Error desconocido')
                            );
                        }
                    }
                });
            });
        });
    </script>
</x-guest-layout>

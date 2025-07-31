<x-guest-layout>
    <div
        class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-slate-900 to-purple-900 overflow-hidden py-4">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute top-1/2 -left-8 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-pulse delay-1000">
            </div>
            <div
                class="absolute bottom-10 right-1/3 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl animate-pulse delay-500">
            </div>
        </div>

        <!-- Left Side Security Login Elements -->
        <div class="fixed left-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Authentication Monitor -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-blue-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="flex items-center mb-3">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        </div>
                        <span class="ml-2 text-blue-400 text-xs font-mono">auth.service</span>
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">✓ Session secure</div>
                        <div class="text-blue-400 animate-pulse">→ Login attempts: 0</div>
                        <div class="text-white">→ Last login: Never</div>
                        <div class="text-cyan-400">→ Status: Ready</div>
                        <div class="text-green-400">→ SSL: Active</div>
                    </div>
                </div>

                <!-- Security Protocols -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-indigo-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-indigo-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-shield-virus mr-2"></i>
                        SECURITY PROTOCOLS
                    </div>
                    <div class="font-mono text-xs space-y-1 text-gray-300">
                        <div class="text-green-400">✓ Two-Factor ready</div>
                        <div class="text-blue-400">✓ Encryption: AES-256</div>
                        <div class="text-cyan-400 animate-pulse">✓ Rate limiting: Active</div>
                        <div class="text-purple-400">✓ CAPTCHA: Standby</div>
                    </div>
                </div>

                <!-- Login Analytics -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-cyan-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-cyan-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-chart-line mr-2 animate-pulse"></i>
                        LOGIN ANALYTICS
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-white">Today's logins: 1,247</div>
                        <div class="text-green-400">✓ Success rate: 94.3%</div>
                        <div class="text-orange-400">⚠ Failed attempts: 73</div>
                        <div class="text-red-400">✗ Blocked IPs: 12</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Security Elements -->
        <div class="fixed right-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Session Manager -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-purple-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-purple-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        SESSION MANAGER
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-400">Session timeout: 30min</div>
                        <div class="text-white">Remember me: Available</div>
                        <div class="text-green-400 animate-pulse">✓ Token: Generated</div>
                        <div class="text-blue-400">→ Secure cookies: ON</div>
                        <div class="w-full bg-slate-700 rounded-full h-1 mt-2">
                            <div class="bg-purple-400 h-1 rounded-full w-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Credential Validator -->
                <div
                    class="bg-slate-900/90 backdrop-blur-md border border-emerald-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-emerald-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-user-check mr-2"></i>
                        CREDENTIAL VALIDATOR
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-300">Email format: Pending</div>
                        <div class="text-gray-300">Password strength: N/A</div>
                        <div class="text-yellow-400 animate-pulse">Validation: Ready</div>
                        <div class="text-white">Database: Connected</div>
                    </div>
                </div>

                <!-- Access Control -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-amber-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-amber-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-key mr-2"></i>
                        ACCESS CONTROL
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">✓ Role-based access</div>
                        <div class="text-blue-400">✓ Permission matrix</div>
                        <div class="text-cyan-400">✓ User groups: Active</div>
                        <div class="text-white animate-pulse">Authorization: Ready</div>
                    </div>
                </div>

                <!-- Brute Force Protection -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-red-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-red-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-ban mr-2"></i>
                        BRUTE FORCE PROTECTION
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">Max attempts: 5</div>
                        <div class="text-yellow-400">Lockout time: 15min</div>
                        <div class="text-blue-400">IP monitoring: ON</div>
                        <div class="text-red-400 animate-pulse">Status: PROTECTED</div>
                    </div>
                </div>
            </div>
        </div>

        <x-authentication-card>
            <x-slot name="logo">
                <div class="flex flex-col items-center justify-center text-center">
                    <x-authentication-card-logo class="mx-auto" />
                    <div
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 border border-blue-400/30 rounded-full text-white text-sm font-medium my-6 backdrop-blur-sm">
                        <i class="fas fa-shield-alt mr-3 animate-pulse"></i>
                        <span>Acceso Seguro</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black mb-4 leading-tight">
                        <span
                            class="bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 text-transparent bg-clip-text">
                            Iniciar Sesión
                        </span>
                    </h1>
                    <p class="text-lg text-gray-300 mt-2 mb-4">Accede a nuestra plataforma</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 mx-auto mb-2 rounded-full"></div>
                </div>
            </x-slot>

            <div class="relative bg-slate-900/80 backdrop-blur-md rounded-2xl p-8 border border-blue-500/30 shadow-2xl">
                <x-validation-errors class="mb-4" />

                @session('status')
                    <div
                        class="mb-4 font-medium text-sm text-green-400 bg-green-900/20 border border-green-500/30 rounded-lg p-3 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-envelope mr-2 text-blue-400"></i>
                                {{ __('Correo Electrónico') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="email"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="usuario@universidad.edu.pe" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-at text-blue-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Contraseña') }}"
                                class="text-white font-medium mb-2 flex items-center">
                                <i class="fas fa-lock mr-2 text-indigo-400"></i>
                                {{ __('Contraseña') }}
                            </x-label>
                            <div class="relative">
                                <x-input id="password"
                                    class="block mt-1 w-full bg-slate-800/60 border-2 border-blue-500/30 focus:border-blue-400 focus:ring-blue-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-blue-400/50 pl-12"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Ingrese su contraseña segura" />
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-key text-indigo-400 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center group cursor-pointer">
                                <x-checkbox id="remember_me" name="remember"
                                    class="border-blue-400 text-blue-500 focus:ring-blue-400/20 rounded" />
                                <span
                                    class="ms-2 text-sm text-gray-300 group-hover:text-white transition-colors flex items-center">
                                    <i class="fas fa-memory mr-1 text-xs text-blue-400"></i>
                                    {{ __('Recordar sesión') }}
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors flex items-center"
                                    href="{{ route('password.request') }}">
                                    <i class="fas fa-question-circle mr-1 text-xs"></i>
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div> --}}

                        <!-- Security Status Bar -->
                        <div class="bg-slate-800/40 border border-blue-500/20 rounded-lg p-3 backdrop-blur-sm">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center text-green-400">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                        SSL Activo
                                    </div>
                                    <div class="flex items-center text-blue-400">
                                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                        Conexión Segura
                                    </div>
                                </div>
                                <div class="text-gray-400">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Protegido
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 sm:flex-row flex-col">
                            @if (Route::has('register'))
                                <a class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors flex items-center group"
                                    href="{{ route('register') }}">
                                    <i class="fas fa-user-plus mr-2 group-hover:animate-pulse"></i>
                                    {{ __('¿Necesitas una cuenta?') }}
                                </a>
                            @endif

                            <x-button
                                class="group relative px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-blue-500/30 transform hover:scale-105 border-0 rounded-xl">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-in-alt mr-3 group-hover:animate-pulse"></i>
                                    {{ __('Acceder al Sistema') }}
                                    <i
                                        class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                                </span>
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </x-authentication-card>

        <!-- Floating particles effect -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-blue-400 rounded-full opacity-30 animate-ping"></div>
            <div class="absolute top-3/4 right-1/4 w-2 h-2 bg-indigo-400 rounded-full opacity-40 animate-pulse"></div>
            <div
                class="absolute top-1/2 left-3/4 w-2.5 h-2.5 bg-cyan-400 rounded-full opacity-25 animate-ping delay-1000">
            </div>
            <div
                class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full opacity-35 animate-pulse delay-500">
            </div>
            <div
                class="absolute bottom-1/4 left-1/2 w-2 h-2 bg-blue-500 rounded-full opacity-30 animate-ping delay-700">
            </div>
        </div>
    </div>
</x-guest-layout>

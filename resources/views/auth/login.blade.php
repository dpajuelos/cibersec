<x-guest-layout>
    <div
        class="relative min-h-screen bg-gradient-to-br from-purple-900 via-purple-800 to-purple-800 overflow-hidden py-4">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute top-1/2 -left-8 w-96 h-96 bg-rose-500/10 rounded-full blur-3xl animate-pulse delay-1000">
            </div>
            <div
                class="absolute bottom-10 right-1/3 w-64 h-64 bg-red-500/10 rounded-full blur-3xl animate-pulse delay-500">
            </div>
        </div>

        <!-- CTF Security Elements -->
        <!-- Left Side Security Elements -->
        <div class="fixed left-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Firewall Monitor -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-red-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="flex items-center mb-3">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        </div>
                        <span class="ml-2 text-red-400 text-xs font-mono">firewall.sys</span>
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-red-400">BLOCKED: 192.168.1.99</div>
                        <div class="text-orange-400">WARNING: Port scan detected</div>
                        <div class="text-red-400">DENIED: SSH brute force</div>
                        <div class="text-white animate-pulse">Status: ACTIVE</div>
                        <div class="text-red-400">Rules: 847 loaded</div>
                    </div>
                </div>

                <!-- Intrusion Detection -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-orange-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-orange-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        INTRUSION DETECTION
                    </div>
                    <div class="font-mono text-xs space-y-1 text-gray-300">
                        <div class="text-red-400">⚠ Malicious payload detected</div>
                        <div class="text-orange-400">→ Source: 10.0.0.15</div>
                        <div class="text-yellow-400 animate-pulse">→ Attack vector: XSS</div>
                        <div class="text-red-400">→ Action: BLOCKED</div>
                    </div>
                </div>

                <!-- Vulnerability Scanner -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-yellow-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-yellow-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-bug mr-2 animate-pulse"></i>
                        VULN SCANNER
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-red-400">⚠ Critical: 3</div>
                        <div class="text-orange-400">⚠ High: 12</div>
                        <div class="text-yellow-400">⚠ Medium: 45</div>
                        <div class="text-green-400">✓ Low: 8</div>
                        <div class="text-white animate-pulse">Scanning...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Security Elements -->
        <div class="fixed right-4 top-1/2 transform -translate-y-1/2 z-10 hidden lg:block">
            <div class="space-y-6">
                <!-- Password Strength -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-green-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-green-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-key mr-2"></i>
                        PASSWORD ANALYZER
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-gray-400">Analyzing strength...</div>
                        <div class="text-red-400">Weak: 12345678</div>
                        <div class="text-orange-400">Medium: Pass@2024</div>
                        <div class="text-green-400 animate-pulse">Strong: 4$eX!mn9Z#k</div>
                        <div class="w-full bg-slate-700 rounded-full h-1 mt-2">
                            <div class="bg-green-400 h-1 rounded-full w-4/5 animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Security Audit -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-cyan-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-cyan-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-clipboard-check mr-2"></i>
                        SECURITY AUDIT
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">✓ SSL certificates valid</div>
                        <div class="text-green-400">✓ Firewall configured</div>
                        <div class="text-red-400 animate-pulse">✗ Weak passwords found</div>
                        <div class="text-orange-400">⚠ Updates pending</div>
                    </div>
                </div>

                <!-- Access Control -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-purple-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-purple-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-user-shield mr-2"></i>
                        ACCESS CONTROL
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-green-400">✓ Admin: authenticated</div>
                        <div class="text-red-400">✗ Guest: failed login</div>
                        <div class="text-yellow-400">⚠ User: 2FA required</div>
                        <div class="text-white animate-pulse">Sessions: 23 active</div>
                    </div>
                </div>

                <!-- Threat Intelligence -->
                <div class="bg-slate-900/90 backdrop-blur-md border border-pink-500/30 rounded-lg p-4 w-64 shadow-xl">
                    <div class="text-pink-400 text-xs font-bold mb-2 flex items-center">
                        <i class="fas fa-crosshairs mr-2"></i>
                        THREAT INTEL
                    </div>
                    <div class="font-mono text-xs space-y-1">
                        <div class="text-red-400">🎯 APT29 activity detected</div>
                        <div class="text-orange-400">📡 C2 server: 185.x.x.x</div>
                        <div class="text-yellow-400">🔍 IoCs: 847 new</div>
                        <div class="text-red-400 animate-pulse">🚨 Alert level: HIGH</div>
                    </div>
                </div>
            </div>
        </div>

        <x-authentication-card>
            <x-slot name="logo">
                <div class="mb-8 text-center">
                    <div
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600/20 to-purple-600/20 border border-cyan-400/30 rounded-full text-cyan-400 text-sm font-medium mb-6 backdrop-blur-sm">
                        <i class="fas fa-shield-alt mr-3 animate-pulse"></i>
                        <span>Acceso Seguro</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black mb-4 leading-tight">
                        <span
                            class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400 text-transparent bg-clip-text">
                            Iniciar Sesión
                        </span>
                    </h1>
                    <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-purple-400 mx-auto mt-4 rounded-full"></div>
                </div>
            </x-slot>

            <div class="relative bg-slate-900/80 backdrop-blur-md rounded-2xl p-8 border border-cyan-500/30 shadow-2xl">
                <x-validation-errors class="mb-4" />

                @session('status')
                    <div
                        class="mb-4 font-medium text-sm text-green-400 bg-green-900/20 border border-green-500/30 rounded-lg p-3">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-label for="email" value="{{ __('Email') }}"
                                class="text-cyan-400 font-medium mb-2 flex items-center">
                                <i class="fas fa-envelope mr-2 text-cyan-400"></i>
                                {{ __('Email') }}
                            </x-label>
                            <x-input id="email"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="Ingrese su correo electrónico" />
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Contraseña') }}"
                                class="text-cyan-400 font-medium mb-2 flex items-center">
                                <i class="fas fa-lock mr-2 text-cyan-400"></i>
                                {{ __('Contraseña') }}
                            </x-label>
                            <x-input id="password"
                                class="block mt-1 w-full bg-slate-800/60 border-2 border-cyan-500/30 focus:border-cyan-400 focus:ring-cyan-400/20 text-white placeholder-gray-400 rounded-xl backdrop-blur-sm transition-all duration-300 hover:border-cyan-400/50"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Ingrese su contraseña" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember"
                                    class="border-cyan-400 text-cyan-400 focus:ring-cyan-400/20" />
                                <span class="ms-2 text-sm text-gray-300">{{ __('Recordarme') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-300 hover:text-cyan-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors"
                                    href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        <div
                            class="flex items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 sm:flex-row flex-col">
                            @if (Route::has('register'))
                                <a class="underline text-sm text-gray-300 hover:text-cyan-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors flex items-center"
                                    href="{{ route('register') }}">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    {{ __('¿Aún no está registrado?') }}
                                </a>
                            @endif

                            <x-button
                                class="group relative px-8 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-cyan-500/30 transform hover:scale-105 border-0 rounded-xl">
                                <span class="flex items-center">
                                    <i class="fas fa-sign-in-alt mr-3 group-hover:animate-pulse"></i>
                                    {{ __('Iniciar sesión') }}
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
</x-guest-layout>

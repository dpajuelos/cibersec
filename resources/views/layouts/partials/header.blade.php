@if (isset($header))
    <div class="bg-black">
        <nav x-data="{ open: false }" class="bg-black border-b border-red-600 shadow-red-600 shadow-md h-24 w-full fixed z-50">
            <div class="px-4 sm:px-6 lg:px-8 pt-2">
                <div class="flex py-4 justify-around">
                    <div class=" shrink-0 flex items-center">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="CIBERSEC Logo"
                                class="h-16 w-16 transform hover:scale-110 transition-transform duration-300">
                            <h1
                                class="text-2xl font-bold ml-2 bg-gradient-to-r from-red-600 to-blue-600 text-transparent bg-clip-text">
                                CIBERSEC-UNASAM
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden sm:-my-px sm:ms-10 sm:flex items-center space-x-24">
                        <x-nav-link href="/usuario" :active="request()->routeIs('/usuario')"
                            class="text-white hover:text-red-500 transition-colors">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                        <x-nav-link href="/ranking" :active="request()->routeIs('/ranking')"
                            class="text-white hover:text-red-500 transition-colors">
                            {{ __('Ranking') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                            class="text-white hover:text-blue-500 transition-colors">
                            {{ __('Retos') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            @if (@Auth::user())
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}" alt="" />
                                            <p class="text-white m-auto ml-3">
                                                {{ Auth::user()->name }}
                                            </p>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Administrar cuenta') }}
                                        </div>

                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Perfil') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Configuración') }}
                                        </x-dropdown-link>

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf

                                            <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @else
                                <div class="flex items-center space-x-5">
                                    <a href="{{ route('register') }}"
                                        class="flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition-colors">
                                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                                    </a>
                                    <a href="{{ route('login') }}"
                                        class="flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500  focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-slate-50 fixed z-30 w-screen top-24">
                <!-- Responsive Settings Options -->
                <div class="flex-1 items-center px-4">
                    @if (Auth::user())
                        <div class="pt-4 pb-1">
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url}}" alt="{{ Auth::user()->name }}" />
                            </div>
                            <div>
                                <div class="font-medium text-base text-black">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-black">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')"
                                class="text-black">
                                {{ __('Usuarios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                class="text-black">
                                {{ __('Ranking') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                                class="text-black">
                                {{ __('Retos') }}
                            </x-responsive-nav-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a href="#" @click.prevent="$el.closest('form').submit();"
                                    class="text-black block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-ou">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                            </form>
                        </div>
                    @else
                        <div class="pt-4 pb-1">
                            <div class="shrink-0">
                                <img class="h-14 w-14 rounded-full object-cover m-auto"
                                    src="{{ asset('images/pato.png') }}" />
                            </div>
                            <div>
                                <div class="font-bold text-base text-center text-black">Pato</div>
                                <div class="font-medium text-sm text-center text-black">Invitado</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <!-- Account Management -->
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('dashboard')"
                                class="text-black">
                                {{ __('Registrarse') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                class="text-black">
                                {{ __('Ranking') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('retos') }}" :active="request()->routeIs('retos')"
                                class="text-black">
                                {{ __('Retos') }}
                            </x-responsive-nav-link>
                        </div>
                    @endif
                </div>
            </div>
    </div>

    </nav>
    </div>
@endif
<main>
    {{ $slot }}
</main>

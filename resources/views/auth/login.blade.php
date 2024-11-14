<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-white" />
                <x-input id="email"
                    class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Ingrese sus correo electrónico"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-white" />
                <x-input id="password"
                    class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                    type="password" name="password" required autocomplete="current-password" placeholder="Ingrese sus contraseña"/>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-white">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-300 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Olvidó su contraseña?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Iniciar sesión') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

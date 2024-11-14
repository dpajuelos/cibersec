<x-guest-layout>

    <div class="relative">
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
            
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-label for="name" value="{{ __('Nombres') }}" class="text-white" />
                    <x-input id="name"
                        class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Ingrese sus nombres" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-white" />
                    <x-input id="email"
                        class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Ingrese su email" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Contraseña') }}" class="text-white" />
                    <x-input id="password"
                        class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                        type="password" name="password" required autocomplete="new-password" placeholder="Contraseña" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Repetir contraseña') }}" class="text-white" />
                    <x-input id="password_confirmation"
                        class="block mt-1 w-full bg-black border-2 border-blue-500 text-white placeholder-gray-400"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirmar contraseña" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms" class="text-white">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2 text-white">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-blue-500 hover:text-blue-300">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-blue-500 hover:text-blue-300">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-300 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Ya está registrado?') }}
                    </a>

                    <x-button class="ms-4 bg-blue-500 hover:bg-blue-600">
                        {{ __('Registrarse') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>

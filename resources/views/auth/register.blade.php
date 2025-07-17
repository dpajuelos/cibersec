<x-guest-layout>
    <div class="relative">
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <form method="POST" action="{{ route('register') }}" id="register" name="register">
                @csrf
                <div class="grid lg:grid-cols-2 sm:grid-cols-1 gap-6">
                    <div class="">
                        <x-label for="name" value="{{ __('Nombres') }}" class="text-white" />
                        <x-input id="name"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="name" required autofocus autocomplete="name" autocomplete="off"
                            placeholder="Ingrese sus nombres" />
                    </div>

                    <div>
                        <x-label for="usuario" value="{{ __('Usuario') }}" class="text-white" />
                        <x-input id="usuario"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="usuario" required autofocus autocomplete="usuario" autocomplete="off"
                            placeholder="Nickname o usuario" />
                        <div class="invalid-feedback text-red-600 hidden">Este usuario ya existe</div>
                    </div>

                    <div class="lg:col-span-2 sm:cols-span-1">
                        <x-label for="universidad" value="{{ __('Universidad') }}" class="text-white" />
                        <select
                            class="block mt-1 w-full bg-black border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white placeholder-gray-400"
                            name="universidad" id="universidad" required autocomplete="universidad">
                            <option value="" disabled selected>Seleccionar universidad</option>
                        </select>
                    </div>

                    <div>
                        <x-label for="paterno" value="{{ __('Apellido paterno') }}" class="text-white" />
                        <x-input id="paterno"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="paterno" required autofocus autocomplete="paterno" autocomplete="off"
                            placeholder="Apellido paterno" />
                    </div>

                    <div>
                        <x-label for="materno" value="{{ __('Apellido materno') }}" class="text-white" />
                        <x-input id="materno"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="materno" required autofocus autocomplete="materno" autocomplete="off"
                            placeholder="Apellido materno" />
                    </div>

                    <div>
                        <x-label for="dni" value="{{ __('DNI') }}" class="text-white" />
                        <x-input id="dni"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="dni" required autocomplete="dni" autocomplete="off"
                            placeholder="Ingrese el número de su DNI" />
                        <div class="invalid-feedback text-red-600 hidden">DNI inválido o registrado</div>
                    </div>

                    <div>
                        <x-label for="fecnac" value="{{ __('Fecha de nacimiento') }}" class="text-white" />
                        <x-input id="fecnac"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="date"
                            name="fecnac" required autocomplete="fecnac" autocomplete="off"
                            placeholder="Ingrese su fecha de nacimiento" />
                        <div class="invalid-feedback text-red-600 hidden">Ingrese una fecha válida</div>
                    </div>

                    <div>
                        <x-label for="celular" value="{{ __('Celular') }}" class="text-white" />
                        <x-input id="celular"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400" type="text"
                            name="celular" required autocomplete="celular" autocomplete="off"
                            placeholder="Ingrese su celular" />
                        <div class="invalid-feedback text-red-600 hidden">Ingrese un número válido</div>
                    </div>

                    <div>
                        <x-label for="genero" value="{{ __('Género') }}" class="text-white" />
                        <select
                            class="block mt-1 w-full bg-black border-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-white placeholder-gray-400"
                            name="genero" id="genero" required autocomplete="genero">
                            <option value="" disabled selected>Seleccionar género</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Prefiero no decirlo</option>
                        </select>
                    </div>


                    <div class="lg:col-span-2 sm:cols-span-1">
                        <x-label for="email" value="{{ __('Email') }}" class="text-white" />
                        <x-input id="email"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400"
                            type="email" name="email" required autocomplete="email" autocomplete="off"
                            placeholder="Ingrese su email" />
                        <div class="invalid-feedback text-red-600 hidden">El email ya está registrado o no es del
                            formato @domain.edu.pe</div>
                    </div>

                    <div>
                        <x-label for="password" value="{{ __('Contraseña') }}" class="text-white" />
                        <x-input id="password"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="Contraseña" />
                        <div class="invalid-feedback text-red-600 hidden">Formato incorrecto o contraseñas no coinciden
                        </div>
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="{{ __('Repetir contraseña') }}"
                            class="text-white" />
                        <x-input id="password_confirmation"
                            class="block mt-1 w-full bg-black border-2  text-white placeholder-gray-400"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirmar contraseña" />

                    </div>
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="my-6">
                        <x-label for="terms" class="text-white">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2 text-white">
                                    {!! __('Estoy de acuerdo con los :terms_of_service y :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-blue-500 hover:text-blue-300">' .
                                            __('términos de servicio') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-blue-500 hover:text-blue-300">' .
                                            __('políticas de privacidad') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif


                <div class="flex items-center justify-center mt-4 shrink-1">
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

<x-app-layout>
    @php
        $coloresPorCategoria = [
            'Web Exploitation' => ['border' => 'border-red-400', 'shadow' => 'shadow-red-900'],
            'Cryptography' => ['border' => 'border-blue-400', 'shadow' => 'shadow-blue-900'],
            'Binary Exploitation' => ['border' => 'border-yellow-400', 'shadow' => 'shadow-yellow-900'],
            'Reverse Engineering' => ['border' => 'border-purple-400', 'shadow' => 'shadow-purple-900'],
            'Forensics' => ['border' => 'border-pink-400', 'shadow' => 'shadow-pink-900'],
            'Network Security' => ['border' => 'border-green-400', 'shadow' => 'shadow-green-900'],
            'Steganography' => ['border' => 'border-teal-400', 'shadow' => 'shadow-teal-900'],
            'OSINT' => ['border' => 'border-indigo-400', 'shadow' => 'shadow-indigo-900'],
            'Mobile Security' => ['border' => 'border-gray-400', 'shadow' => 'shadow-gray-900'],
            'IoT Security' => ['border' => 'border-orange-400', 'shadow' => 'shadow-orange-900'],
            'Cloud Security' => ['border' => 'border-blue-500', 'shadow' => 'shadow-blue-700'],
            'Blockchain Security' => ['border' => 'border-lime-400', 'shadow' => 'shadow-lime-900'],
            'AI Security' => ['border' => 'border-rose-400', 'shadow' => 'shadow-rose-900'],
            'Hardware Hacking' => ['border' => 'border-slate-400', 'shadow' => 'shadow-slate-900'],
            'Program' => ['border-cyan-400', 'shadow-cyan-900'],
        ];
    @endphp
    @section('title', 'Retos-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="lg:bg-cover md:bg-left-bottom mt-24 py-12"
        style="background-image: url('{{ asset('images/circuito.svg') }}');">
        
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        
        <h1 class="text-center text-3xl font-bold mb-6 p-4 text-white">Retos</h1>
        <div class="grid gap-10 lg:grid-cols-2 sm:grid-cols-1">
            @foreach ($retosPorCategoria as $categoria => $retos)
                @php
                    $colores = $coloresPorCategoria[$categoria] ?? [
                        'border' => 'border-gray-400',
                        'shadow' => 'shadow-gray-900',
                    ];
                @endphp
                <div class="p-5 border {{ $colores['border'] }}">
                    <h2 class="text-lg font-semibold mb-2 text-white text-center">{{ $categoria }}</h2>
                    <div class="rounded-lg p-4 grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-12">
                        @foreach ($retos as $reto)
                            <div class="cursor-pointer border {{ $colores['border'] }} {{ $colores['shadow'] }} shadow-md hover:shadow-2xl rounded-lg p-3 h-24 
                                text-center bg-black transition duration-200 ease-in-out transform hover:scale-105 content-center"
                                onclick="openModal({{ $reto->idretos }})">
                                <p class="text-white sm:">{{ $reto->nomreto }}</p>
                                <p class="text-white">{{ $reto->puntos }} puntos</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal :) --}}
    <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-black rounded-lg shadow-lg p-6 max-w-3xl w-full h-auto overflow-auto">
            <div class="grid grid-cols-2 gap-6 border-b-2 border-white py-6">
                <button class="bg-teal-500 text-white font-semibold h-8 hover:bg-teal-600"
                    onclick="showReto()">Reto</button>
                <button id="btn-resuelto"
                    class="border border-teal-500 bg-inherit font-semibold text-white hover:bg-gray-100 hover:text-teal-500"
                    onclick="showResueltos()">Resuelto por: <span id="resuelto-count">0</span></button>
            </div>
            <div class="container my-4">
                <p class="hidden" id="idreto"></p>
                <h2 id="modal-title" class="text-2xl font-bold mb-4 text-gray-50 text-center"></h2>
                <p id="modal-points" class="mb-4 text-gray-100 text-center"></p>
                <p id="modal-description" class="mb-4 text-gray-100"></p>

                <div id="pistas-container"></div>
                <div class="flex justify-end">
                    <button onclick="closeModal()"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var isLoggedIn = @auth true
        @else
            false
        @endauth ;

        function showReto() {
            const idreto = document.getElementById('idreto').innerText;

            fetch(`/detalles/${idreto}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-title').innerText = data.nomreto;
                    document.getElementById('modal-description').innerText = data.descripcion || 'Sin descripción';
                    document.getElementById('modal-points').innerText = data.puntos + ' puntos';
                    document.getElementById('pistas-container').innerHTML = '';
                    obtenerPistas(idreto);
                })
                .catch(error => console.error('Error fetching reto data:', error));
        }

        function showResueltos() {
            const idreto = document.getElementById('idreto').innerText;

            fetch(`/resueltos/${idreto}`)
                .then(response => response.json())
                .then(data => {
                    const resueltoCount = data.length;
                    document.getElementById('resuelto-count').innerText = resueltoCount;
                    if (resueltoCount === 0) {
                        document.getElementById('modal-title').innerText = '';
                        document.getElementById('modal-points').innerText = '';
                        document.getElementById('modal-description').innerText = '';
                        document.getElementById('pistas-container').innerHTML = `
                    <p class="text-white text-center">Aún nadie lo ha resuelto, suerte :)</p>`;
                        return;
                    }

                    let tableHtml = `
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nickname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="bg-black divide-y divide-gray-200">`;

                    data.forEach(row => {
                        tableHtml += `
                    <tr class="text-green-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm">${row.nickname}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">${row.nombre}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">${row.tiempo_formateado}</td>
                    </tr>`;
                    });

                    tableHtml += `
                    </tbody>
                </table>
                </div>`;
                    document.getElementById('modal-title').innerText = '';
                    document.getElementById('modal-description').innerText = '';
                    document.getElementById('pistas-container').innerHTML = tableHtml;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function closeModal() {

            document.getElementById('modal').style.display = 'none';

            document.getElementById('modal-title').innerText = '';
            document.getElementById('modal-description').innerText = '';
            document.getElementById('pistas-container').innerHTML = '';
            document.getElementById('resuelto-count').innerText = '0';
        }

        function openModal(idreto) {
            if (isLoggedIn) {
                document.getElementById('idreto').innerText = idreto;
                showReto();
                getResueltoCount();
                document.getElementById('modal').style.display = 'flex';
            } else {
                showOverlayPanel();
            }
        }

        function getResueltoCount() {
            const idreto = document.getElementById('idreto').innerText;
            fetch(`/resueltos/${idreto}`)
                .then(response => response.json())
                .then(data => {
                    const resueltoCount = data.length;
                    document.getElementById('resuelto-count').innerText =
                        resueltoCount;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        closeModal();

        function showOverlayPanel() {
            const overlay = document.createElement('div');
            overlay.id = 'overlay';
            overlay.className =
                'fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50';

            const messageBox = document.createElement('div');
            messageBox.className = 'w-full max-w-md bg-white p-6 rounded-lg shadow-lg relative';

            const title = document.createElement('h2');
            title.innerText = 'Mensaje';
            title.className = 'text-lg font-bold mb-4 text-gray-800 text-center';

            const message = document.createElement('p');
            message.innerText = 'Para acceder a los retos necesita iniciar sesión.';
            message.className = 'mb-4 text-gray-700 text-center';

            // Botón de cerrar
            const closeButton = document.createElement('button');
            closeButton.innerText = '✖';
            closeButton.className = 'absolute top-2 right-2 text-gray-600 hover:text-gray-800';
            closeButton.onclick = () => {
                document.body.removeChild(overlay);
            };

            const buttonContainer = document.createElement('div');
            buttonContainer.className = 'flex justify-center space-x-2 mt-4';

            // Botón de iniciar sesión
            const loginButton = document.createElement('button');
            loginButton.innerText = 'Iniciar sesión';
            loginButton.className = 'bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600';
            loginButton.onclick = () => {
                window.location.href = '/login';
            };

            // Botón de registrarse
            const registerButton = document.createElement('button');
            registerButton.innerText = 'Registrarse';
            registerButton.className = 'bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600';
            registerButton.onclick = () => {
                window.location.href = '/register';
            };

            // Agregar botones al contenedor
            buttonContainer.appendChild(loginButton);
            buttonContainer.appendChild(registerButton);

            // Agregar elementos al cuadro de mensaje
            messageBox.appendChild(closeButton);
            messageBox.appendChild(title);
            messageBox.appendChild(message);
            messageBox.appendChild(buttonContainer);
            overlay.appendChild(messageBox);
            document.body.appendChild(overlay);
        }

        async function obtenerPistas(idretos) {
            try {
                const response = await fetch(`/retos/${idretos}/pistas`);
                if (!response.ok) {
                    throw new Error('Error al obtener las pistas');
                }
                const pistas = await response.json();
                mostrarPistas(pistas, idretos);
            } catch (error) {
                console.error(error);
            }
        }

        function mostrarPistas(pistas, idreto) {
            const pistasContainer = document.getElementById('pistas-container');
            pistasContainer.innerHTML = '';
            if (pistas.length === 0) {
                return;
            }

            pistasContainer.innerHTML = '<h3 class="mb-4 text-gray-50 text-center font-semibold">Pista</h3>';

            pistas.forEach((pista, index) => {
                const pistaElement = document.createElement('div');
                pistaElement.className = 'flex items-center space-x-12 mb-8 justify-center';
                pistaElement.setAttribute('data-id', pista.idpistas);

                pistaElement.innerHTML =
                    `
                <p class="text-gray-50 pista-contenido">Pista: ${index + 1} (Descuento: ${pista.valor} puntos)</p>
                <button class='bg-indigo-500 hover:bg-indigo-700 text-gray-50 font-bold py-2 px-4 rounded button-pista' onclick="desbloquearPista('${pista.contenido}', '${pista.idpistas}', '${idreto}')">Desbloquear</button>`;
                pistasContainer.appendChild(pistaElement);
            });
        }

        function desbloquearPista(contenido, idPista, idretos) {
            const pistaElement = document.querySelector(`[data-id='${idPista}']`);

            if (pistaElement) {
                const button = pistaElement.querySelector('.button-pista');
                if (button) {
                    button.remove();
                }

                const contenidoRojo = document.createElement('p');
                contenidoRojo.className = 'text-red-500 font-bold';
                contenidoRojo.textContent = `Pista desbloqueada: ${contenido}`;

                pistaElement.appendChild(contenidoRojo);

                const todasLasPistas = document.querySelectorAll('[data-id]');

                todasLasPistas.forEach(pista => {
                    const btn = pista.querySelector('.button-pista');
                    const pistaContenido = pista.querySelector('.pista-contenido');

                    if (pista !== pistaElement) {
                        if (btn) {
                            btn.remove();
                        }
                        if (pistaContenido) {
                            pistaContenido.remove();
                        }
                    }
                });
                registrarPista(idretos, idPista);
            }
        }

        function registrarPista(idretos, idPista) {
            const data = {
                idreto: idretos,
                idpista: idPista
            };

            console.log('Datos a enviar:', JSON.stringify(data));

            fetch('/RegistroPistas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message) {
                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error al registrar la pista:', error);
                });
        }
    </script>
</x-app-layout>

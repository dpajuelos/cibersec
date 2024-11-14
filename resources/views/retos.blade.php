<x-app-layout>
    @php
        // Definir colores para cada categoría
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
    <reto-modal></reto-modal>
    <div class="lg:bg-cover md:bg-left-bottom mt-24 py-12"
        style="background-image: url('{{ asset('images/circuito.svg') }}');">
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
        <div class="bg-black rounded-lg shadow-lg p-6 lg:w-1/3 md:w-1/2 border border-cyan-200">
            <div class="grid grid-cols-2 gap-6 border-b-2 border-white py-6">
                <button class="bg-teal-500 text-white font-semibold h-8 hover:bg-teal-600" onclick="">Reto</button>
                <button
                    class="border border-teal-500 bg-inherit font-semibold text-white hover:bg-gray-100 hover:text-teal-500"
                    onclick="">Resuelto
                    por: </button>
            </div>
            <div class="container my-4">
                <h2 id="modal-title" class="text-2xl font-bold mb-4 text-white text-center"></h2>
                <p id="modal-points" class="mb-4 text-center text-gray-100"></p>
                <p id="modal-description" class="mb-4 text-gray-100"></p>
                <p class="mb-4 text-gray-50 text-center font-semibold">Pista</p>
                <div id="pistas-container"></div>
                <!-- <div class="flex items-center space-x-12 mb-8 justify-center">
                    <button onclick=""
                        class="bg-indigo-500 hover:bg-indigo-700 text-gray-50 font-bold py-2 px-4 rounded">
                        Desbloquear
                    </button>
                    <p id="modal-rest" class="text-gray-100">-25 puntos</p>
                </div>
                <div class="flex items-center space-x-12 mt-5">
                    <p id="modal-rest" class="mb-0 text-gray-100">Flag:</p>
                    <input type="text" class="border border-red-500 bg-gray-100 rounded-sm">
                </div> -->
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
        function openModal(id) {
            fetch(`/detalles/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('modal-title').innerText = data.nomreto || 'Nombre no disponible';
                    document.getElementById('modal-description').innerText = data.descripcion ||
                        'Descripción no disponible';
                    document.getElementById('modal-points').innerText = data.puntos + " puntos" || 0;
                    document.getElementById('modal').classList.remove('hidden');
                    obtenerPistas(data.idretos);
                })
                .catch(error => console.error('Error al cargar los detalles del reto:', error));
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
        closeModal();

        async function obtenerPistas(idretos) {
            try {
                const response = await fetch(`/retos/${idretos}/pistas`);
                if (!response.ok) {
                    throw new Error('Error al obtener las pistas');
                }
                const pistas = await response.json();
                mostrarPistas(pistas);
            } catch (error) {
                console.error(error);
            }
        }

        function mostrarPistas(pistas) {
            const pistasContainer = document.getElementById('pistas-container');
            pistasContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevas pistas

            pistas.forEach(pista => {
                const pistaElement = document.createElement('div');
                pistaElement.className = 'pista'; // Puedes aplicar estilos aquí
                pistaElement.innerHTML = `
                <p>${pista.contenido} (Descuento: ${pista.valor} puntos)</p>
                <button onclick="desbloquearPista('${pista.contenido}', ${pista.valor})">Desbloquear</button>
            `;
                pistasContainer.appendChild(pistaElement);
            });
        }

        function desbloquearPista(contenido, valor) {
            alert(`Pista desbloqueada: ${contenido}`);
        }
    </script>
</x-app-layout>

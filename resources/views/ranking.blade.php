<x-app-layout>
    @section('title', 'Ranking-CibersecUnasam')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="mx-auto px-4 py-8 max-w-6xl mt-28">
        <header class="mb-10">
            <h1 class="text-4xl font-bold text-center text-gray-300 mb-3">RANKING</h1>
            <p class="text-center text-gray-400">Top 5</p>
        </header>

        <div class="bg-gray-800 rounded-lg shadow-lg mb-8">
            <!-- Gráfico de Barras -->
            <canvas id="rankingChart"></canvas>
        </div>
        
        <div class="bg-gray-800 rounded-lg shadow-lg">
            <!-- Tablita -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700 shadow-lg rounded-lg overflow-hidden">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="w-16 px-6 py-3 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider border-b border-gray-700">
                                Puesto
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider border-b border-gray-700">
                                Nickname
                            </th>
                            <th scope="col"
                                class="w-20 px-6 py-3 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider border-b border-gray-700">
                                Puntos
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 divide-y divide-gray-700">
                        @foreach ($rankings as $ranking)
                            <tr class="hover:bg-gray-700 transition duration-200 ease-in-out transform hover:scale-105">
                                <td class="w-16 px-6 py-4 whitespace-nowrap">
                                    <a class="flex items-center text-gray-400 hover:text-gray-300">
                                        {{ $ranking->puesto }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm font-mono text-gray-400 cursor-pointer hover:text-gray-200"
                                        onclick="openModal('{{ $ranking->usuario }}', '{{ $ranking->nickname }}')">
                                        {{ $ranking->nickname }}
                                    </div>
                                </td>
                                <td class="w-20 px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1 inline-flex text-sm font-semibold text-gray-100 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full shadow-lg border-2 border-yellow-500">
                                        {{ $ranking->total_puntos }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const ctx1 = document.getElementById('rankingChart').getContext('2d');
        const rankingChart = new Chart(ctx1, {
            type: 'bar', // Tipo de gráfico de barras
            data: {
                labels: [], // Nombres de los usuarios
                datasets: [{
                    label: 'Puntos',
                    data: [], // Puntos de cada usuario
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 2,
                    barThickness: 35,
                    borderRadius: 15,
                    hoverBackgroundColor: 'rgba(0, 0, 0, 0.2)',
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' puntos';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            font: {
                                size: 14,
                                weight: 'bold',
                            },
                            color: '#fff',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 14,
                                weight: 'bold',
                            },
                            color: '#fff',
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce',
                },
            }
        });
        // Función para actualizar los datos de la tabla y el gráfico
        function updateRanking() {
            fetch('/rankings/top5')
                .then(response => response.json())
                .then(data => {
                    // Extraer los nombres y puntos de los usuarios
                    const labels = data.map(ranking => ranking.nickname);
                    const points = data.map(ranking => ranking.total_puntos);
                    // Actualizar los datos del gráfico
                    rankingChart.data.labels = labels;
                    rankingChart.data.datasets[0].data = points;
                    // Actualizar el gráfico
                    rankingChart.update();
                    // Actualizar la tabla con los nuevos datos (opcional)
                    let tbody = document.querySelector('tbody');
                    tbody.innerHTML = ''; // Limpiar tabla
                    data.forEach((ranking, index) => {
                        tbody.innerHTML += `
                    <tr class="hover:bg-gray-700 transition duration-200 ease-in-out transform hover:scale-105">
                        <td class="w-16 px-6 py-4 whitespace-nowrap">
                            <a class="flex items-center text-gray-400 hover:text-gray-300">${ranking.puesto}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-mono text-gray-400 cursor-pointer hover:text-gray-200" onclick="openModal('${ranking.usuario}', '${ranking.nickname}')">
                                ${ranking.nickname}
                            </div>
                        </td>
                        <td class="w-20 px-6 py-4 whitespace-nowrap">
                            <span class="px-4 py-1 inline-flex text-sm font-semibold text-gray-100 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full shadow-lg border-2 border-yellow-500">
                                ${ranking.total_puntos}
                            </span>
                        </td>
                    </tr>
                `;
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los datos del ranking:', error);
                });
        }
        // Actualizar datos cada 10 segundos (10000 ms)
        setInterval(updateRanking, 10000);
        // Llamada inicial para cargar los datos al cargar la página
        updateRanking();
    </script>
</x-app-layout>

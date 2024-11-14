<div id="userModal" class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50 z-50">
    <div class="bg-gray-700 rounded-lg shadow-lg w-11/12 md:w-1/3 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 id="modalUserName" class="text-xl font-bold text-white">{{ $userName ?? 'Nombre de Usuario' }}</h2>
            <p id="modalUserDetails" class="text-gray-400">{{ $userDetails ?? 'Aquí puedes mostrar más detalles del usuario.' }}</p>
            <button onclick="closeModal()" class="text-gray-100 hover:text-gray-700">&times;</button>
        </div>
        <div class="flex justify-center items-center space-x-4 mb-4">
            <span id="puntos" class="text-xl text-white rounded-lg px-3 py-1 bg-blue-600 shadow-md">Cargando puntos gaa</span>
            <span id="puesto" class="text-xl text-white rounded-lg px-3 py-1 bg-yellow-400 shadow-md">:3</span>
        </div>
        <div class="flex items-center space-x-4 mb-4">
            <span class="text-x2 font-medium text-gray-300">PROBLEMAS RESUELTOS</span>
        </div>
        <table id="modalUserTable" class="min-w-full border-collapse border border-gray-700 mb-4">
            <thead>
                <tr class="bg-gray-800">
                    <th class="border border-gray-600 p-2 text-left text-gray-300 font-semibold">Retos</th>
                    <th class="border border-gray-600 p-2 text-center text-gray-300 font-semibold">Categorias</th>
                    <th class="border border-gray-600 p-2 text-center text-gray-300 font-semibold">Puntaje</th>
                    <th class="border border-gray-600 p-2 text-center text-gray-300 font-semibold">Hora</th>
                    <th class="border border-gray-600 p-2 text-center text-gray-300 font-semibold">Resultado</th>
                </tr>
            </thead>
            <tbody id="modalUserTableBody">
            </tbody>
        </table>
        <div class="flex items-center justify-between my-4">
            <span class="text-xl font-bold text-gray-300">PORCENTAJE DE ACIERTOS</span>
            <select id = 'categoriaselect' class="bg-gray-700 text-gray-300 border border-gray-500 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-green-600" onchange='actualizarProgreso()'>
                <option value="" disabled selected>Seleccionar</option>
            </select>
        </div>
        <!-- Progreso de la categoría -->
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-600">
            <div id= 'barrita' class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 0%"></div>
        </div>
        <div class="bg-gray-700 rounded-lg p-6 mt-4">
            <h2 class="text-xl font-semibold text-gray-300 mb-4 text-center">Scar Over Time</h2>
            <div class="relative w-full" style="padding-top: 56.25%">
                <div class="absolute top-0 left-0 w-full h-full">
                    <canvas id="scoreChart"></canvas>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-center text-sm text-gray-400">
                <span class="inline-block w-3 h-3 bg-emerald-400 opacity-30 rounded mr-2"></span>
                <span>Área de puntuación</span>
                <span class="inline-block w-3 h-0.5 bg-emerald-400 mx-2 ml-4"></span>
                <span>Línea de tendencia</span>
            </div>
        </div>
    </div>
</div>
<script>
      function openModal(userName, userDetails) {
        document.getElementById('modalUserName').innerText = userName;
        document.getElementById('modalUserDetails').innerText = userDetails;
        document.getElementById('userModal').classList.remove('hidden');
        fetch(`/categorias`)
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('categoriaselect');
                categorySelect.innerHTML = `<option value="" disabled selected>Seleccionar</option>`;
                
                data.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.nomcategoria;
                    option.text = categoria.nomcategoria;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las categorías', error));
        fetch(`/usuarios/puesto_puntos?userDetails=${encodeURIComponent(userDetails)}`)
            .then(response => response.json())
            .then(data => {
                
                if (data.message) {
                    document.getElementById('puntos').innerText = `participa mrd :v`;
                    document.getElementById('puesto').innerText = `jilow`;
                } else {
                    document.getElementById('puntos').innerText = `${data.total_puntos} puntos`;
                    document.getElementById('puesto').innerText = `${data.puesto}° puesto`;
                }
            })
            .catch(error => console.error('Error al cargar datos', error));
        // Llama al método `detalle` para obtener los datos del usuario
        fetch(`/usuarios/detalle?userName=${encodeURIComponent(userName)}`)
            .then(response => response.json())
            .then(data => {
                // Limpia el contenido actual de la tabla
                const tableBody = document.getElementById('modalUserTableBody');
                tableBody.innerHTML = '';
                if (data.message) {
                    // Si se encuentra el mensaje de error
                    tableBody.innerHTML = `<tr><td colspan="5" class="text-center text-gray-100">${data.message}</td></tr>`;
                } else {
                    // Si se encuentran resultados
                    data.results.forEach(result => {
                        // Define la clase CSS condicionalmente según el valor de resultado
                        let resultadoClass = 'text-gray-300 text-xs'; // Clase por defecto
                        if (result.resultado === 'Flag Encontrada') {
                            resultadoClass = 'text-green-500 font-bold text-xs'; // Verde para un buen resultado
                        } else if (result.resultado === 'Tiempo agotado') {
                            resultadoClass = 'text-yellow-500 text-xs'; // Amarillo para un resultado medio
                        } else {
                            resultadoClass = 'text-red-500 text-xs'; // Rojo para un resultado bajo
                        }
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="border border-gray-600 p-1 text-left text-gray-300 text-xs">${result.nomreto}</td>
                            <td class="border border-gray-600 p-1 text-center text-gray-300 text-xs">${result.nomcategoria}</td>
                            <td class="border border-gray-600 p-1 text-center text-gray-300 text-xs">${result.puntos}</td>
                            <td class="border border-gray-600 p-1 text-center text-gray-300 text-xs">${result.tiempo}</td>
                            <td class="border border-gray-600 p-1 text-center ${resultadoClass}">${result.resultado}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            })
            .catch(error => console.error('Error al cargar los detalles del usuario:', error));
    }
    function closeModal() {
        document.getElementById('userModal').classList.add('hidden');
        // Volver a la URL original sin recargar la página
        history.replaceState(null, '', window.location.pathname);
        // Limpiar los valores del combo box y la barra de progreso
        const categoriaSelect = document.getElementById('categoriaselect');
        const barraProgreso = document.getElementById('barrita');
        if (categoriaSelect) {
            categoriaSelect.selectedIndex = 0; 
        }
        if (barraProgreso) {
            barraProgreso.style.display = 'none';
        }
        document.getElementById('puntos').textContent = 'Cargando puntos gaa';
        document.getElementById('puesto').textContent = ':3';
        scoreChart.data.labels = [];
        scoreChart.data.datasets[0].data = [];
        scoreChart.update();
    }
    
    // Cerrar el modal al retroceder en el historial de navegación
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.modalOpen) {
            openModal();
        } else {
            closeModal();
        }
    });
 
    function actualizarProgreso() {
        const categoria = document.getElementById('categoriaselect').value;
        const userName = document.getElementById('modalUserName').innerText; // Usa el nombre de usuario actual
        
        // Realiza una solicitud al nuevo método del controlador para obtener el porcentaje de aciertos
        fetch(`/usuarios/porcentaje-acierto`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ userName, categoria })
        })
        .then(response => response.json())
        .then(data => {
            const barraProgreso = document.getElementById('barrita');
            if (data.porcentaje !== undefined && data.porcentaje !== null) {
                barraProgreso.style.width = `${data.porcentaje}%`;
                barraProgreso.textContent = `${data.porcentaje}%`;
                barraProgreso.style.display = 'block';
                
            } else {
                barraProgreso.style.display = 'none';
                alert(data.message || 'No se encontraron datos para esta categoria');
                
            }
        })
        .catch(error => console.error('Error:', error));
        // Actualizar el gráfico de puntuación
        fetch(`/usuarios/puntos-por-fecha`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ userName, categoria })
        })
        .then(response => response.json())
        .then(data => {
            if (data.puntos) {
                const fechas = data.puntos.map(p => p.fecha);
                const puntos = data.puntos.map(p => p.puntos);
                
                // Actualizar datos del gráfico
                scoreChart.data.labels = fechas;
                scoreChart.data.datasets[0].data = puntos;
                scoreChart.update();
            } else {
                // alert(data.message || 'Error al obtener los datos de puntos.');
                scoreChart.data.labels = [];
                scoreChart.data.datasets[0].data = [];
                scoreChart.update();
            }
        })
        .catch(error => console.error('Error al actualizar el gráfico:', error));
    }
   
const ctx = document.getElementById('scoreChart').getContext('2d');
        
const scoreChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Puntuación',
                    data: [],
                    fill: true,
                    borderColor: 'rgb(52, 211, 153)', // emerald-400
                    backgroundColor: 'rgba(52, 211, 153, 0.2)',
                    tension: 0.4,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 16/9,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 800,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#9ca3af', // gray-400
                            font: {
                                family: 'Inter, sans-serif'
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#9ca3af', // gray-400
                            font: {
                                family: 'Inter, sans-serif'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.8)', // gray-900 con opacidad
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        bodyFont: {
                            family: 'Inter, sans-serif'
                        },
                        bodySpacing: 4,
                        boxPadding: 4
                    }
                }
            }
        });
        closeModal();
</script>
<div id="modal"
    class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-[10000] bg-black/80 backdrop-blur-sm hidden">
    <div
        class="bg-slate-900/95 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-700/50 p-8 max-w-4xl w-full h-auto max-h-[90vh] overflow-auto mx-4">
        <!-- Modal content mantener el existente -->
        <div class="grid grid-cols-2 gap-6 border-b border-slate-700/50 py-6 mb-6">
            <button
                class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-800 hover:to-indigo-800 transition-all duration-300"
                onclick="volverAVistaReto()">Reto</button>

            <button id="btn-resuelto" onclick="showResueltos()"
                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl hover:from-indigo-800 hover:to-purple-800 transition-all duration-300">
                Resuelto por: <span id="resuelto-count"></span>
            </button>
        </div>
        <!-- Contenedor de Resueltos separado -->
        <div id="resueltos-view" class="hidden">
            <h3 class="text-2xl font-bold text-green-400 text-center mb-4">Resuelto por</h3>

            <div id="resueltos-tabla-container" class="bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                <!-- Aquí va la tabla dinámica -->
            </div>
        </div>

        <div class="container">
            <p class="hidden" id="idreto"></p>
            <h2 id="modal-title" class="text-3xl font-bold mb-4 text-gray-50 text-center"></h2>
            <p id="modal-points" class="mb-6 text-gray-100 text-center text-lg"></p>
            <p id="modal-description" class="mb-6 text-gray-100 leading-relaxed"></p>


            <div id="pistas-container" class="hidden bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                <h3 class="text-xl font-semibold text-yellow-400 mb-2">Pistas</h3>
                <!-- Las pistas se insertan aquí -->
            </div>

            <div id="enlace-container" class="hidden bg-slate-800/60 p-4 rounded-lg text-gray-100 mb-6 space-y-2">
                <h3 class="text-xl font-semibold text-yellow-400 mb-2">Enlace de descarga</h3>
                <!-- Las enlaces de descarga se insertan aquí -->
            </div>


            <!-- Campo para ingresar la flag -->
            <div class="flex flex-col sm:flex-row items-center gap-4 justify-center mb-6">
                <input type="text" id="flag-input" placeholder="CSU{flag}"
                    class="w-full sm:max-w-2xl px-4 py-3 rounded-lg bg-slate-800 text-white border border-slate-600 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-slate-400" />

                <button onclick="enviarFlag()"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 shadow-md">
                    Enviar
                </button>
            </div>

            <!-- Mensajes -->
            <div id="message-container" class="my-6">
                <p id="message" class="text-red-300 text-center font-medium"></p>
                <p id="result" class="text-green-300 text-center font-medium"></p>
            </div>
            <div class="flex justify-center mt-8">
                <button onclick="closeModal()"
                    class="bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-gray-50 font-bold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-emerald-500/25">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

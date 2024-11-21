<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="bg-gray-900 bg-cover bg-center py-24 w-11/12 mx-auto mt-32"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/CibersecUnasam.jpg') }}');">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold my-20 text-white">¡Sé uno de los que pueden ser el héroe de la cibernética de
                Huaraz 2077!</h1>
            <p class="text-lg mb-12 text-white">Únete a nuestra misión de ciberseguridad y demuestra tus habilidades en
                una serie de desafiantes retos que pondrán a prueba tus conocimientos.</p>
            <div class="flex justify-center">
                <button class="bg-green-400 hover:bg-green-700 text-white font-bold py-2 px-4 mr-4 rounded-sm">Aceptar el
                    Desafío</button>
            </div>
        </div>
    </div>

    <div class="bg-white pt-10 mb-6">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">¿Estás listo para el desafío?</h2>
            <p class="text-center text-gray-700 mb-8">Participa en nuestra serie de eventos y mejora tus habilidades en
                ciberseguridad.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">

                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Criptografía</h3>
                    <p class="text-gray-600">Los retos de criptografía desafían a los jugadores a descifrar mensajes,
                        romper algoritmos mal implementados o analizar esquemas de cifrado inseguros. Los participantes
                        suelen enfrentarse a problemas que involucran cifrados clásicos como César o Vigenère, y otros
                        modernos como RSA o AES, a menudo presentando errores deliberados en la implementación para ser
                        explotados.
                    </p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Esteganografía</h3>
                    <p class="text-gray-600">La esteganografía consiste en encontrar información oculta en archivos que
                        parecen normales, como imágenes, audios, videos o documentos. Estos retos requieren técnicas
                        como extraer datos de metadatos, alterar canales de color, analizar bits menos significativos o
                        descubrir patrones en el contenido aparentemente inofensivo.
                    </p>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg shadow-md lg:col-span-2 md:col-span-1">
                    <h3 class="text-xl font-bold mb-4">Web Explotación</h3>
                    <p class="text-gray-600">Aquí, los participantes deben identificar y explotar vulnerabilidades en
                        aplicaciones web. Los retos pueden incluir desde ataques básicos como inyecciones SQL y
                        Cross-Site Scripting (XSS) hasta técnicas más avanzadas como bypass de autenticación o
                        explotación de malas configuraciones en servidores. Este tipo de desafíos requiere un profundo
                        entendimiento de cómo funcionan las tecnologías web y sus posibles fallas.
                    </p>
                </div>
                
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">OSINT</h3>
                    <p class="text-gray-600">En esta categoría, los participantes deben usar inteligencia de fuentes
                        abiertas para recopilar y analizar información pública disponible en Internet. Esto puede
                        incluir rastrear perfiles en redes sociales, encontrar datos ocultos en sitios web o descubrir
                        patrones en conjuntos de datos públicos. La clave está en usar habilidades de investigación
                        creativa y minuciosa para conectar piezas de información.
                    </p>
                </div>

                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Trivias</h3>
                    <p class="text-gray-600">Las trivias son retos de preguntas rápidas que evalúan conocimientos
                        teóricos, históricos o prácticos sobre ciberseguridad. Pueden incluir curiosidades sobre
                        herramientas, protocolos, eventos importantes o técnicas específicas, desafiando la capacidad de
                        los participantes para investigar y recordar información útil.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

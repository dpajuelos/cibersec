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
                <button
                    class="bg-yellow-400/[.9] hover:bg-yellow-700/[.9] text-white font-bold py-2 px-4 rounded-sm">Unirse
                    a la Comunidad</button>
            </div>
        </div>
    </div>

    <div class="bg-white pt-10">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">¿Estás listo para el desafío?</h2>
            <p class="text-center text-gray-700 mb-8">Participa en nuestra serie de eventos y mejora tus habilidades en
                ciberseguridad.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Criptografía</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam obcaecati
                        inventore atque necessitatibus dicta laborum cupiditate at nihil ratione dolorum dignissimos
                        recusandae cumque vel, quasi, cum reiciendis! Modi, optio laboriosam?</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Steganografía</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci
                        reprehenderit voluptatum debitis animi cum doloribus, vitae similique laboriosam asperiores
                        assumenda voluptas molestias sequi ipsam.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Osint</h3>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat odit eius
                        saepe vel, officia consectetur porro ut.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Web</h3>
                    <p class="text-gray-600">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae
                        inventore nostrum beatae totam delectus.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

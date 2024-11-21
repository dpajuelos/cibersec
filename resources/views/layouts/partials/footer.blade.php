<footer class="bg-black border-t border-red-600">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">Contacto</h3>
                <ul class="space-y-2">
                    <li class="text-gray-400">
                        <i class="fas fa-envelope mr-2"></i>
                        cibersec@unasam.edu.pe
                    </li>
                    <li class="text-gray-400">
                        <i class="fas fa-phone mr-2"></i>
                        +51 999 888 777
                    </li>
                    <li class="text-gray-400">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Huaraz, Ancash, Perú
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold text-white mb-4">Enlaces Rápidos</h3>
                <ul class="space-y-2">
                    <li><a target="_blank" href="{{ route('terms.show') }}"
                            class="text-gray-400 hover:text-red-500">Términos y Condiciones</a></li>
                    <li><a target="_blank" href="{{ route('policy.show') }}"
                            class="text-gray-400 hover:text-blue-500">Política de Privacidad</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold text-white mb-4">Síguenos</h3>
                <div class="flex justify-center space-x-4">
                    <a target="_blank" href="https://www.facebook.com/cibersecunasam" class="text-gray-400 hover:text-blue-500 transition-colors">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                    <a target="_blank" href="https://www.linkedin.com/company/cibersec-unasam/posts/?feedView=all" class="text-gray-400 hover:text-blue-400 transition-colors">
                        <i class="fa-brands fa-linkedin text-2xl"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/cibersecunasam/" class="text-gray-400 hover:text-pink-500 transition-colors">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} CIBERSEC-UNASAM. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>

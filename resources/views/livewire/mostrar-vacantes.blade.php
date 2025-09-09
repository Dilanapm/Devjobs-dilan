<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    @forelse ($vacantes as $vacante)
        <div
            class="p-6 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 md:flex md:items-center md:justify-between">
            <div>
                <a href="#">
                    <h2 class="text-2xl font-bold mb-2">{{ $vacante->titulo }}</h2>
                </a>
                <p>
                    <span class="font-bold">Empresa:</span> {{ $vacante->empresa }}
                </p>
                <p>
                    <span class="font-bold">Ultimo día para postularse:</span>
                    {{ $vacante->ultimo_dia->format('d/m/Y') }}
                </p>
            </div>

            <div class="flex gap-3 flex-col mt-4 md:mt-0 items-stretch md:flex-row">
                <a href="#"
                    class="bg-black text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition-colors uppercase font-bold text-center">
                    Candidatos
                </a>
                <a href="{{ route('vacantes.edit', $vacante) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors uppercase font-bold text-center">
                    Editar
                </a>
                <a
                    href="#"class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition-colors uppercase font-bold text-center">
                    Eliminar
                </a>
            </div>
        </div>
    @empty
        <div class="p-6 text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700">
            <p class="text-center">No hay vacantes disponibles</p>
        </div>
    @endforelse
    <div class="mt-6">
        {{ $vacantes->links() }}
    </div>








</div>

<style>
    .hover-bg-green:hover {
        background-color: #34D399; /* Verde para la primer card */
    }

    .hover-bg-yellow:hover {
        background-color: #FBBF24; /* Amarillo para la segunda card */
    }

    .hover-bg-red:hover {
        background-color: #F87171; /* Rojo para la tercer card */
    }
</style>

<div class="p-10 flex grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 justify-center">
    @livewireScripts
    @foreach($pasadas as $index => $pasada)
    @php
        $competidor = $this->getCompetidorObject($pasada->id_competidor);
    @endphp
    <div class="{{ $index < 3 ? 'border-blue-500' : 'border-gray-200' }} card flex justify-center items-center p-5 rounded-lg shadow hover:bg-gray-100 hover:shadow-md transition duration-300 ease-in-out
        @if ($index === 0) hover-bg-green
        @elseif ($index === 1) hover-bg-yellow
        @elseif ($index === 2) hover-bg-red
        @endif
        ">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                {{ $competidor->name }} {{ $competidor->apellido }}
            </h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"></p>
            <ul class="my-4 space-y-3">
                <li>
                    <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Pasada número: {{ $pasada->ronda }}</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">{{ $poomsae->nombre }}</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Calificación: {{ $pasada->calificacion }}</span>
                        <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">Promedio de pasada</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Competencia: {{ $competencia->titulo }}</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                        <span class="flex-1 ml-3 whitespace-nowrap">Cantidad de jueces: {{ $competencia->cant_jueces }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
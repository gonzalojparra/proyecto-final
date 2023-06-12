<div class="info-competencia mt-6 mb-8">
    <div>
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400 ">{{ $data['titulo'] }}</h1>
    </div>
    <div class="datos-competencia gap-x-2 flex flex-row justify-center mt-6">
        <div class="flyer max-w-sm mr-4">
        <img class="rounded-t-lg w-auto" src="{{ $data['flyer'] }}" alt="flyer" />
        </div>
        @livewire('competencias.formulario-inscripcion')
        <div class="flex flex-col">
            <div class="data dark:text-gray-400 mb-2" style="height: 80%;">
                <ul>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2">
                        <h1 class="text-lg font-semibold">Descripción</h1>
                        {{ $data['descripcion'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Dia de inicio</h1>
                        {{ $data['fecha_inicio'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Dia de finalización</h1>
                        {{ $data['fecha_fin'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Cantidad de jueces</h1>
                        {{ $data['cant_jueces'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Invitación</h1>
                        
                        {{ $data['flyer'] }}
                    </li>
                </ul>
                <img src="storage/app/public/{{$data['flyer']}}" alt="">
            </div>
            <div class="flex flex-row justify-center items-end mt-8 text-gray-500 ml-5" style="height: 20%;">
                <div grid justify-items-center>

                    <!-- <button id="openModal"  type="button" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Inscripción
                                </span>
                            </button>
                             -->
                    <button id="openModal" wire:click="mostrarInscripcion({{$data['id']}})" type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Inscribirme
                    </button>
                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Bases y condiciones
                        </span>
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>


<div class="resultados-competencia" style="margin-top: 5rem;">
    <div class="">
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400">Resultados</h1>
    </div>
    @livewire('competidores.competencia-competidor', ['competenciaId' => $data['id']] )
</div>


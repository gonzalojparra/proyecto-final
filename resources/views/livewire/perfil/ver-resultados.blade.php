<div>
    @if ($vista == 2)
    <x-modal wire:model='open' class="lg:max-w-lg bg-white">
        @if (count($inscripciones) > 0)
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3 hidden">
                    id
                </th>
                <th class="px-6 py-3">
                    Competencia
                </th>
                <th class="px-6 py-3">
                    estado inscripcion
                </th>
                <th class="px-6 py-3 sm:visible hidden">
                    fecha de inscripcion
                </th>
                <th class="px-6 py-3 sm:visible  hidden">
                    fecha inicio
                </th>
            </thead>
            <tbody>
                @foreach ($inscripciones as $inscripcion )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 hidden">
                        {{$inscripcion->idCompentecia}}
                    </td>
                    <td class="px-6 py-4 ">
                        {{$inscripcion->nombreCompetencia }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($inscripcion->estado)
                        Aprobado
                        @else
                        En Proceso
                        @endif
                    </td>
                    <td class="px-6 py-4 sm:visible  hidden">
                        <?php $inscripcion->fecha_inscripcion = date('d/m/Y', strtotime($inscripcion->fecha_inscripcion)) ?>
                        {{$inscripcion->fecha_inscripcion}}
                    </td>
                    <td class="px-6 py-4 sm:visible  hidden">
                        <?php $inscripcion->fecha_inicio = date('d/m/Y', strtotime($inscripcion->fecha_inicio)) ?>
                        {{$inscripcion->fecha_inicio}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-white">
            <h3>
                No hay ninguna solicitud por el momento.
            </h3>
        </div>
        @endif
    </x-modal>
    @else
    <x-modal wire:model='open'>
        @if (count($inscripciones) > 0)

        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    puesto
                </th>
                <th class="px-6 py-3 hidden">
                    id
                </th>
                <th class="px-6 py-3">
                    Competencia
                </th>
                @role('Competidor')
                <th class="px-6 py-3">
                    fecha de finalizacion
                </th>
                <th class="px-6 py-3">
                    categoria / graduacion
                </th>

                @endrole


                <th class="px-6 py-4 uppercase">
                    @role('Juez') Ver Competidores @endrole
                    @role('Competidor') Ver Detalle @endrole
                </th>

            </thead>
            <tbody>
                @foreach ($inscripciones as $inscripcion )

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-4 py-4 uppercase text-2xl">
                        {{$inscripcion['posicion']}}°
                    </td>
                    <td class="px-4 py-4 hidden">
                        {{$inscripcion['idCompetencia']}}
                    </td>
                    <td class="px-4 py-4 uppercase">
                        {{$inscripcion['nombreCompetencia'] }}
                    </td>
                    @role('Competidor')
                    <td class="px-4 py-4 uppercase">
                        <?php $inscripcion['fecha_inscripcion'] = date('d/m/Y', strtotime($inscripcion['fecha_inscripcion'])) ?>
                        {{$inscripcion['fecha_inscripcion']}}
                    </td>
                    <td class="px-4 py-4 uppercase">
                        {{$inscripcion['nombreCategoria']}} <b>/</b> {{$inscripcion['graduacion']}}
                    </td>
                    <td class="px-4 py-4 uppercase">
                        <button class="relative inline-flex items-center justify-center p-0.5 mb-2 ml-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-green-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800 mt-2" wire:click='detallesCompetenciaCompetidor({{$inscripcion["idCompentecia"]}})'>
                            <span @popper(Detalle) class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                            </span>
                        </button>
                    </td>

                    @endrole

                    @role('Juez')
                    <td class="px-4 py-4 uppercase">
                        <button class="relative inline-flex items-center justify-center p-0.5 mb-2 ml-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-green-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800 mt-2" wire:click='mostrarCompetidoresPuntuados({{$inscripcion["idCompentecia"]}})'>
                            <span @popper(Ver Competidores) class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </button>
                    </td>
                    @endrole

                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-white">
            <h3>
                No hay ningun historial por el momento.
            </h3>
        </div>
        @endif
    </x-modal>
    @endif



    @if ($openCompetidores)
    <x-modal wire:model='openCompetidores'>
        @if (!empty($competidores))
        @role('Juez')
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3 ">
                    Competidor
                </th>
                <th class="px-6 py-3 sm:visible">
                    Ptos Exactitud
                </th>
                <th class="px-6 py-3 sm:visible">
                    Ptos Presentacion
                </th>
                <th>
                    Pto Total
                </th>
            </thead>
            <tbody>
                @foreach ($competidores as $competidor )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 ">
                        {{$competidor->nombre}}
                    </td>
                    <td class="px-6 py-4 uppercase sm:visible">
                        {{$competidor->exactitud }}
                    </td>
                    <td class="px-6 py-4 uppercase sm:visible">
                        {{$competidor->presentacion}}
                    </td>
                    <td class="px-6 py-4 uppercase">
                        {{$competidor->exactitud + $competidor->presentacion}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endrole
        @role('Competidor')
        <div>
            <div class="text-white text-center text-md">
                <h3 class="px-6 py-3 ">
                    Ronda {{$ronda}} - Poomsae {{$competidores[0]->nombrePoom}}
                </h3>
            </div>
            <div class="flex justify-between">
                @if ($competidores[0]->ronda == 2)
                <button class="bg-pink-100 w-6 flex items-center" wire:click="pasarRonda({{$competidores[0]->idCompetencia}})">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                </button>
                @endif



                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th class="px-6 py-3 uppercase ">
                            Jueces
                        </th>
                        <th class="px-6 py-3 sm:visible uppercase">
                            Ptos Exactitud
                        </th>
                        <th class="px-6 py-3 sm:visible uppercase">
                            Ptos Presentacion
                        </th>
                        <th class="px-6 py-3 sm:visible uppercase">
                            Pto Parcial
                        </th>
                    </thead>
                    <tbody>

                        @foreach ($competidores as $competidor )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-2 py-2 ">
                                {{$competidor->nombreJuez}}
                            </td>
                            <td class="px-2 py-2 uppercase sm:visible">
                                {{$competidor->exactitud }}
                            </td>
                            <td class="px-2 py-2 uppercase sm:visible">
                                {{$competidor->presentacion}}
                            </td>
                            <td class="px-2 py-2 uppercase">
                                {{$competidor->exactitud + $competidor->presentacion}}
                            </td>

                        </tr>

                        @endforeach

                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mt">
                            <td class="px-2 py-2 uppercase">
                                Puntos Promediados
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-2 py-2 uppercase text-xl">
                                {{$competidor->calificacion}}
                            </td>
                        </tr>


                    </tbody>
                </table>
                @if ($competidores[0]->ronda == 1)
                <button class="bg-pink-100 w-6 flex items-center" wire:click="pasarRonda({{$competidores[0]->idCompetencia}})">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                </button>
                @endif
            </div>
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead>
                    <th class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 mt">
                    <td class="px-2 py-2 uppercase">
                        <h4>Puntos Total Concurso</h4>  <span class="text-2xl">{{$competidor->total}}</span>
                    </td>

                    </th>
                </thead>
            </table>

        </div>
        @endrole
        @else
        <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-white">
            <h3>
                No hay ningun competidor puntuado por el momento.
            </h3>
        </div>
        @endif

    </x-modal>
    @endif


</div>
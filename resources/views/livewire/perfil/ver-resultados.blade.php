<div>
    @if ($vista == 2)
    <x-model-x-l wire:model='open' class="lg:max-w-lg bg-white">
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    id
                </th>
                <th class="px-6 py-3">
                    Competencia
                </th>
                <th class="px-6 py-3">
                    estado inscripcion
                </th>
                <th class="px-6 py-3">
                    fecha de inscripcion
                </th>
                <th class="px-6 py-3">
                    fecha inicio
                </th>
            </thead>
            <tbody>
                @foreach ($inscripciones as $inscripcione )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{$inscripcione->idCompentecia}}
                    </td>
                    <td class="px-6 py-4">
                        {{$inscripcione->nombreCompetencia }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($inscripcione->estado)
                        Aprobado
                        @else
                        En Proceso
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <?php $inscripcione->fecha_inscripcion = date('d/m/Y', strtotime($inscripcione->fecha_inscripcion)) ?>
                        {{$inscripcione->fecha_inscripcion}}
                    </td>
                    <td class="px-6 py-4">
                        {{$inscripcione->fecha_inicio}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-model-x-l>
    @else
    <x-modal wire:model='open'>
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    id
                </th>
                <th class="px-6 py-3">
                    Competencia
                </th>
                <th class="px-6 py-3">
                    fecha de finalizacion
                </th>
                <th class="px-6 py-3">
                    ver resultado
                </th>
            </thead>
            <tbody>
                @foreach ($inscripciones as $inscripcion )
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{$inscripcion->idCompentecia}}
                    </td>
                    <td class="px-6 py-4">
                        {{$inscripcion->nombreCompetencia }}
                    </td>
                    <td class="px-6 py-4">
                        <?php $inscripcion->fecha_inscripcion = date('d/m/Y', strtotime($inscripcion->fecha_inscripcion)) ?>
                        {{$inscripcion->fecha_inscripcion}}
                    </td>
                    <td>
                        <button class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-violet-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white" wire:click='traerResultado({{$inscripcion->idCompentecia}})'>
                            <span class="flex justify-between items-center relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" />
                                    </g>
                                </svg>
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </x-modal>
    @if ($openResul == true)
    <x-modal wire:model="openResul" style="display: flex; align-items:center;">
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    Podio
                </th>
                <th class="px-6 py-3">
                    Competidor
                </th>
                <th class="px-6 py-3">
                    Puntos
                </th>
                <th class="px-6 py-3">
                    Escuela
                </th>
            </thead>
            <tbody>
            
                @for ($i = 0; $i < count($resultados); $i++ )
                <?php $eresTu = ($user == $resultados[$i]->id)?"dark:bg-white bg-gray-200 text-black" : "bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" ?> 
                <tr class="{{$eresTu}}">
                    <td>
                        @switch($i)
                        @case(0)
                        <kbd class="px-3 py-2 mx-2 text-sm font-semibold text-white bg-blue-300 border border-gray-200 rounded-lg dark:bg-blue-600 dark:text-gray-100 dark:border-gray-500">1°</kbd>
                        @break
                        @case(1)
                        <kbd class="px-3 py-2 mx-2 text-sm font-semibold text-white bg-red-300 border border-gray-200 rounded-lg dark:bg-red-600 dark:text-gray-100 dark:border-gray-500">2°</kbd>
                        @break
                        @case(3)
                        <kbd class="px-3 py-2 mx-2 text-sm font-semibold text-white bg-yellow-300 border border-gray-200 rounded-lg dark:bg-yellow-600 dark:text-gray-100 dark:border-gray-500">3°</kbd>
                        @break
                        @endswitch
                    </td>
                    <td class="px-6 py-4">
                        {{$resultados[$i]->nombre}}
                    </td>
                    <td class="px-6 py-4">
                        {{$resultados[$i]->puntos }}
                    </td>
                    <td> 
                        {{$resultados[$i]->escuela}}
                    </td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </x-modal>

    @endif
</div>
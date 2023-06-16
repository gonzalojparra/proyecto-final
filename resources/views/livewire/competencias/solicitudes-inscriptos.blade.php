<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrar Inscriptos') }}
        </h2>
    </x-slot>

    <div class='max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8'>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (count($inscriptosPendientes) > 0)
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">

                <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Nombre y Apellido
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Escuela
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Graduacion
                            </span>
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">-</span>
                        </th>
                    </tr>
                </thead>
                @livewire('competencias.modal-solicitud')
                <tbody>

                    @foreach ($inscriptosPendientes as $inscripto )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white hidden">
                            {{$inscripto['idCompetidor']}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$inscripto['nombreCompetidor']}}
                        </th>
                        <td class="px-6 py-4">
                            {{$inscripto['escuela']}}
                        </td>
                        <td class="px-6 py-4">
                            {{$inscripto['graduacion']}}
                        </td>
                        <td class="px-6 py-4">
                            @if ($inscripto['tieneSolicitud'])
                            <x-button wire:click='mostrarSolicitud({{$inscripto["idCompetidor"]}})'>
                                <svg fill="none" width='25' stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"></path>
                                </svg>
                            </x-button>
                            @endif

                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            @else
            <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-dark">
                <h3>
                    No se encuentran solicitudes
                </h3>
            </div>

            @endif
        </div>
    </div>
</div>
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
                <tbody>
                    @foreach ($inscriptosPendientes as $inscripto )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$inscripto->id_competidor}}
                        </th>
                        <td class="px-6 py-4">
                            {{$inscripto->id_competencia}}
                        </td>
                        <td class="px-6 py-4">
                            {{$inscripto->id_competidor}}
                        </td>
                        <td class="px-6 py-4">
                            -
                        </td>

                        {{-- <td class="px-6 py-4">
                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800" wire:click="mostrarCompetidor({{$usuario->id}})">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Ver Perfil
                                </span>
                            </button>
                            <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="mostrarCompetidor({{$usuario->id}})">Ver Perfil</a> -->
                        </td> --}}
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
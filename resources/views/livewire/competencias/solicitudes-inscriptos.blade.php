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
                            <span class="cursor-pointer">
                                Rol
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
                        <td class="px-6 py-4">
                            {{$inscripto->user->name}} {{$inscripto->user->apellido}}
                        </td>
                        <td class="px-6 py-4">
                            @if (isset($inscripto->modificacion))
                            {{$inscripto->actualizacion->team->name}}
                            @else
                            {{$inscripto->user->team->name}}       
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{$inscripto->user->graduacion}}
                        </td>
                        <td class="px-6 py-4">
                            {{$inscripto->rol}}
                        </td>

                        <td class="px-6 py-4">
                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800" wire:click="aceptar('{{ $inscripto->rol }}', {{ $inscripto->id }})">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Aceptar
                                </span>
                            </button>
                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 ml-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-orange-500 to-red-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800 mt-2" wire:click="rechazar('{{ $inscripto->rol }}', {{ $inscripto->id }})">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Rechazar
                                </span>
                            </button>
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
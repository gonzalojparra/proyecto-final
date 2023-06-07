<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ver Competidores') }}
            </h2>
        </x-slot>

        <div class='max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8'>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="py-3 flex justify-between">
                    <x-input class="w-25 mr-1" wire:model='filtro' type='text' placeholder='Buscar...' />
                    <select id="escuelas" class="mx-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="ninguna" selected>Elija una escuela</option>
                        @foreach($escuelas as $escuela)
                        <option>{{ $escuela->name }}</option>
                        @endforeach
                    </select>
                    <select id="categorias" class="mx-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="ninguna" selected>Elija una categoría</option>
                        @foreach($categorias as $categoria)
                        <option>{{ $categoria }}</option>
                        @endforeach
                    </select>
                    <select id="graduaciones" class="mx-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="ninguna" selected>Elija una graduación</option>
                        @foreach($graduaciones as $graduacion)
                        <option>{{ $graduacion }}</option>
                        @endforeach
                    </select>


                </div>
                @if (count($competidoresVerificados) > 0)
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">

                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    ID
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Nombre
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Apellido
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Genero
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Graduación
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Categoría
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Gal
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="cursor-pointer">
                                    Clasificación
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($competidoresVerificados as $usuario )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$usuario->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$usuario->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->apellido}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->genero}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->graduacion}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->categoria}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->gal}}
                            </td>
                            <td class="px-6 py-4">
                                {{$usuario->clasificacion}}
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
</div>
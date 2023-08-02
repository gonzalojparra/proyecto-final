<div class="p-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-5">
            <x-resultados />
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la categoría</label>
            <select wire:model="categoriaSeleccionada" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($categorias as $categoria)
                <option>{{$categoria['nombre']}}</option>
                @endforeach
            </select>
            <!-- titulo -->
            <h1 class="mb-4  mt-4 text-4xl font-extrabold text-center leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-dark">Categorias</h1>
            <hr>
            <br>
            
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Graduación</label>
            <select wire:model="graduacionSeleccionada" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>todas</option>
                @foreach($graduaciones as $graduacion)
                <option>{{$graduacion['nombre']}}</option>
                @endforeach
            </select>
            <h3 class="mb-4 mt-4 text-2xl font-extrabold text-center leading-none tracking-tight text-gray-900 dark:text-dark">Ranking general</h3>

            <div class="contenedor flex max-w-auto p-6 bg-white border border-gray-100 rounded shadow dark:border-gray-200">

                <!-- Puestos -->
                @if(isset($podio[0]))
                <a href="#" class="elemento block m-2 p-3 max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">1°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">{{$podio[0]->name}} {{$podio[0]->apellido}}</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>{{$podio[0]->clasificacion}} Pts</li>
                        <li>{{$podio[0]->team->name}}</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded" style="width: 100%"></div>
                    </div>
                </a>
                @else
                <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">2°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">-</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded" style="width: 100%"></div>
                    </div>
                </a>
                @endif

                @if(isset($podio[1]))
                <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">2°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">{{$podio[1]->name}} {{$podio[1]->apellido}}</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>{{$podio[1]->clasificacion}} Pts</li>
                        <li>{{$podio[1]->team->name}}</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded " style="width: 100%"></div>
                    </div>
                </a>
                @else
                <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">2°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">-</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded" style="width: 100%"></div>
                    </div>
                </a>
                @endif

                @if(isset($podio[2]))
                <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">3°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">{{$podio[2]->name}} {{$podio[2]->apellido}}</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>{{$podio[2]->clasificacion}} Pts</li>
                        <li>{{$podio[2]->team->name}}</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded" style="width: 100%"></div>
                    </div>
                </a>
                @else <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">3°</span>
                    </div>
                    <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">-</h5>
                    <ul class="style-none text-center font-bold text-md">
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                    </ul>
                    <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                        <div class="h-6 bg-amber-500 rounded " style="width: 100%"></div>
                    </div>
                </a>
                @endif
            </div>


            <br>
            <!-- tabla con resultados (5) -->
            <div class="relative overflow-x-auto rounded">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-200 rounded shadow">
                    <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                TOP
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre y Apellido
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Genero
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Escuela Federada
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Graduacion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Clasificacion
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach ($compGraduacion as $unCompetidor)
                        <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                {{$i}}
                            </th>
                            <th class="px-6 py-4">
                                {{$unCompetidor->name}} {{$unCompetidor->apellido}}
                            </th>
                            <td class="px-6 py-4">
                                {{$unCompetidor->genero}}
                            </td>
                            <td class="px-6 py-4">
                                {{$unCompetidor->team->name}}
                            </td>
                            <td class="px-6 py-4">
                                {{$unCompetidor->graduacion->nombre}}
                            </td>
                            <td class="px-6 py-4">
                                {{$unCompetidor->clasificacion}}
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="p-12 ranking-container">
    <link rel="stylesheet" href="{{ asset('css/estilosRanking.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="side-menu">
        <input type="checkbox" id="abrir-menu">
        <div class="container-menu">
            <div class="cont-menu">
                <label for="abrir-menu" class="cerrar-menu text-white">X</label>
                <h2 class="titulo-filtros text-white">Filtros</h2>
                <div class="filtros">
                    <div class="filtro-ranking">
                        <label for="countries" class="block mb-2 text-sm font-medium  text-white">Ranking</label>
                        <select wire:model="rankingSeleccionado" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>General (anual)</option>
                            @foreach($competenciasEnCurso as $competenciaCurso)
                            <option value="{{$competenciaCurso['id']}}">{{$competenciaCurso['titulo']}} (en curso)</option>
                            @endforeach
                            @foreach($competenciasFinalizadas as $competenciaFin)
                            <option  value="{{$competenciaFin['id']}}">{{$competenciaFin['titulo']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filtro-categoria">
                        <label for="countries" class="block mb-2 text-sm font-medium text-white">Categoría</label>
                        <select wire:model="categoriaSeleccionada" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($categorias as $categoria)
                            <option>{{$categoria['nombre']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filtro-graduacion">
                        <label for="countries" class="block mb-2 text-sm font-medium text-white">Graduación</label>
                        <select wire:model="graduacionSeleccionada" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($graduaciones as $graduacion)
                            <option>{{$graduacion['nombre']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ranking-in">

        <div class="bg-white shadow-xl sm:rounded-lg p-5">
            <!-- titulo -->
            <div class="abrir-menu">
                <label for="abrir-menu" class="icon-menu"><span class="material-symbols-outlined">
                        menu
                    </span>
                </label>
            </div>
            <h1 class="mb-4  mt-4 text-4xl font-extrabold text-center leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-dark">Ranking [tipo de ranking]</h1>
            <hr>
            <x-resultados />

            <h3 class="mb-4 mt-4 text-2xl font-extrabold text-center leading-none tracking-tight text-gray-900 dark:text-dark">{{$categoriaSeleccionada}}, {{$graduacionSeleccionada}}</h3>

            <div class="contenedor-podio contenedor flex max-w-auto p-6 bg-white border border-gray-100 rounded shadow dark:border-gray-200">

                <!-- Puestos -->
                @if(isset($podio[1]))
                <div class=" segundo-lugar elemento block m-2  max-w-sm bg-white shadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 podio-nombre inline-flex">{{$podio[1]->name}} {{$podio[1]->apellido}}</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>{{$podio[1]->clasificacion}} Pts</li>
                            <li>{{$podio[1]->team->name}}</li>
                        </ul>
                    </div>

                    <div class="medalla medalla-segundo segundo">
                        <span class="position-number">2</span>
                    </div>
                </div>
                @else
                <div class="  segundo-lugar elemento block m-2  max-w-sm bg-white shadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 mt-5 ml-auto text-xl font-bold tracking-tight podio-nombre text-gray-600 inline-flex">No hay segundo lugar</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>

                    <div class="medalla medalla-segundo segundo">
                        <span class="position-number">2</span>
                    </div>
                </div>
                @endif

                @if(isset($podio[0]))
                <div class="primer-lugar elemento block m-2  max-w-sm bg-whiteshadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 ml-auto text-xl font-bold tracking-tight text-gray-900 podio-nombre">{{$podio[0]->name}} {{$podio[0]->apellido}}</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>{{$podio[0]->clasificacion}} Pts</li>
                            <li>{{$podio[0]->team->name}}</li>
                        </ul>
                    </div>

                    <div class="medalla medalla-primero primero">
                        <span class="position-number">1</span>
                    </div>
                </div>
                @else
                <div class="primer-lugar elemento block m-2 max-w-sm bg-white shadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 mt-5 ml-auto text-xl font-bold tracking-tight podio-nombre text-gray-600 inline-flexx">No hay primer lugar</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                    <div class="medalla medalla-primero primero">
                        <span class="position-number">1</span>
                    </div>
                </div>
                @endif

                @if(isset($podio[2]))
                <div class="tercer-lugar elemento block m-2  max-w-sm bg-white shadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 ml-auto text-xl font-bold tracking-tight podio-nombre text-gray-900 inline-flex">{{$podio[2]->name}} {{$podio[2]->apellido}}</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>{{$podio[2]->clasificacion}} Pts</li>
                            <li>{{$podio[2]->team->name}}</li>
                        </ul>
                    </div>
                    <div class="medalla medalla-tercero tercero">
                        <span>3</span>
                    </div>


                </div>
                @else <div class="tercer-lugar elemento block m-2  max-w-sm bg-white shadow ">
                    <div class="flex justify-center flex-col">
                        <h5 class="mb-2 mt-5 ml-auto text-xl font-bold tracking-tight podio-nombre text-gray-600 inline-flex">No hay tercer lugar</h5>
                        <ul class="style-none text-center font-bold text-md">
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>

                    <div class="medalla medalla-tercero tercero">
                        <span class="position-number">3</span>
                    </div>
                </div>
                @endif
            </div>


            <br>
            <!-- tabla con resultados (5) -->
            <div class="relative overflow-x-auto rounded  tabla-rankings">
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
                        <?php $i = 1 ?>
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
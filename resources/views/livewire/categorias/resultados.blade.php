<div class="p-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-5">
            <x-resultados/>
                <div class="carousel relative container mx-auto" style="max-width:1600px;">

                    <div class="carousel-inner relative overflow-hidden w-full">
                        <!--Slides-->
                        <?php $cant = 1?>
                        @foreach ($categorias as $categoria)
                            <input class="carousel-open" type="radio" id="carousel-{{$cant}}" name="carousel" aria-hidden="true" hidden="" checked="checked">
                            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://plus.unsplash.com/premium_photo-1667941272807-692a4f06844d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');">
                
                                    <div class="container mx-auto">
                                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                                            <p class="text-white text-2xl my-4">{{$categoria->nombre}}</p>
                                            <p class="text-xl inline-block no-underline border-b border-gray-600  text-white leading-relaxed hover:text-white hover:border-black">{{$categoria->genero}}</p>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                            <label for="carousel-{{$cant-1}}" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                            <label for="carousel-{{$cant+1}}" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>  
                        @endforeach
            
                        <!-- Add additional indicators for each slide-->
                        <ol class="carousel-indicators">
                            <li class="inline-block mr-3">
                                <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                            </li>
                            <li class="inline-block mr-3">
                                <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                            </li>
                            <li class="inline-block mr-3">
                                <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                            </li>
                        </ol>
            
                    </div>
                </div>
            
                 <!-- titulo -->
                 <h1 class="mb-4  mt-4 text-4xl font-extrabold text-center leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-dark">Categorias</h1>
                 <hr>
                 <br>
                 <h3 class="mb-4 text-2xl font-extrabold text-center leading-none tracking-tight text-gray-900 dark:text-dark">Ranking general</h3>
            
                 <div class="contenedor flex max-w-auto p-6 bg-white border border-gray-100 rounded shadow dark:border-gray-200">
                @for ($i = 0; $i < 3; $i++)
                        <!-- Puestos -->
                        <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
                            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <span class="font-medium text-gray-600 dark:text-gray-300">{{$i+1}}°</span>
                            </div>
                            <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">{{$competidores[$i]->name}} {{$competidores[0]->apellido}}</h5>
                            <ul class="style-none text-center font-bold text-md">
                                    <li>{{$competidores[$i]->clasificacion}} Pts</li>
                                    <li>{{$competidores[$i]->team->name}}</li>
                            </ul>
                            <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                                <div class="h-6 bg-yellow-400 rounded dark:text-yellow-500" style="width: 100%"></div>
                            </div>
                        </a>      
                        @endfor
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
                            @for ($i = 0; $i < count($competidores); $i++)
                            <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{$i+1}}
                                </th>
                                <th class="px-6 py-4">
                                    {{$competidores[$i]->name}} {{$competidores[$i]->apellido}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$competidores[$i]->genero}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$competidores[$i]->team->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $compGraduacion[$i][0]['nombre'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$competidores[$i]->clasificacion}}
                                </td>
                            </tr> 
                            @endfor
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
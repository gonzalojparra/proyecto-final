<div>
     <!-- responsive -->
     <style>
        .contenedor {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-between; */
        }


        .elemento {
            width: 100%;
            max-width: 1536px;
            margin-bottom: 20px;
            min-width: 31%;
           
        }

        

        @media (min-width: 768px) {
            .elemento {
                width: calc(33.33% - 20px);
                min-width: none;
            }
        }


        @media (min-width: 1024px) {
            .elemento {
                width: calc(25% - 20px);
                min-width: none;
            }
        } 

       
        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }
        
        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }
        
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }
        
        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }
        
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
    </style>

   <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	
    <!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet"> -->



    <div class="carousel relative container mx-auto" style="max-width:1600px;">

        <div class="carousel-inner relative overflow-hidden w-full">
            <!--Slide 1-->
            <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://plus.unsplash.com/premium_photo-1667941272807-692a4f06844d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');">

                    <div class="container mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-white text-2xl my-4">Categoria</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600  text-white leading-relaxed hover:text-white hover:border-black" href="#">Ver Categoria</a>
                        </div>
                    </div>

                </div>
            </div>
            <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 2-->
            <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://plus.unsplash.com/premium_photo-1667942140945-e4fa1b6d16a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80ttps://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjM0MTM2fQ&auto=format&fit=crop&w=1600&q=80');">

                    <div class="container mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-white text-2xl my-4">Categoria</p>
                            <a class="text-xl text-white inline-block underline-no border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Ver Categoria</a>
                        </div>
                    </div>

                </div>
            </div>
            <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 3-->
            <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-bottom" style="background-image: url('https://images.unsplash.com/photo-1603210185603-57fc717c4456?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80https://images.unsplash.com/photo-1616447285364-f1461103ee36?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80https://images.unsplash.com/photo-1519327232521-1ea2c736d34d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

                    <div class="container mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-black text-2xl my-4">Categoria</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Ver Categoria</a>
                        </div>
                    </div>

                </div>
            </div>
            <label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

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
     <h1 class="mb-4  mt-4 text-4xl font-extrabold text-center leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-dark">Categoria</h1>
    <h3 class="mb-4 text-2xl font-extrabold text-center leading-none tracking-tight text-gray-900 dark:text-dark">Ganadores</h3>
    <hr>
    <br>


    <div class="contenedor flex max-w-auto p-6 bg-white border border-gray-100 rounded shadow dark:border-gray-200">
        <!-- primer puesto -->
        <a href="#" class="elemento block m-2 p-6  max-w-sm bg-white border border-gray-200 rounded shadow dark:border-gray-400 ">
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">1°</span>
            </div>
            <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">Primer Puesto</h5>
            <ul class="style-none text-center font-bold text-md">
                    <li>Pais</li>
                    <li>Escuela</li>
            </ul>
            <div class="w-full h-6 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                <div class="h-6 bg-yellow-400 rounded dark:text-yellow-500" style="width: 100%"></div>
            </div>
        </a>

  
        <!-- segundo puesto -->
        <a href="#" class="elemento block m-2 max-w-sm p-6 bg-white items-center border border-gray-200 rounded shadow dark:border-gray-400  ">
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">2°</span>
            </div>
            <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">Segundo Puesto</h5>
            <ul class="style-none text-center font-bold text-md">
                    <li>Pais</li>
                    <li>Escuela</li>
            </ul>
            <div class="w-full h-4 mb-4 bg-gray-200 rounded dark:bg-gray-700 mt-2">
                <div class="h-4 bg-gray-600 rounded dark:bg-gray-300" style="width: 100%"></div>
            </div>
        </a>


        <!-- tercer puesto -->
        <a href="#" class="elemento block m-2 max-w-sm p-6 bg-white items-center border border-gray-200 rounded shadow dark:border-gray-400">
            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                <span class="font-medium text-gray-600 dark:text-gray-300">3°</span>
            </div>
            <h5 class="mb-2 ml-auto text-2xl font-bold tracking-tight text-gray-900 inline-flex">Tercer Puesto</h5>
            <ul class="style-none text-center font-bold text-md">
                    <li>Pais</li>
                    <li>Escuela</li>
            </ul>
            <div class="w-full bg-gray-200 rounded h-2.5 mb-4 dark:bg-gray-700 mt-2">
                <div class="bg-yellow-500 h-2.5 rounded dark:bg-yellow-600" style="width: 100%"></div>
            </div>
        </a>


    </div>


    <br>
    <!-- tabla con resultados (5) -->
    <div class="relative overflow-x-auto rounded">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-200 rounded shadow">
            <thead class="text-xs text-gray-900 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pais
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Escuela Federada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Clasificacion
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                        Ana Maria Rincon
                    </th>
                    <td class="px-6 py-4">
                       Argentina
                    </td>
                    <td class="px-6 py-4">
                       TKW N°1
                    </td>
                    <td class="px-6 py-4">
                        
                    </td>
                </tr>
                <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                        Gregoria Gamero
                    </th>
                    <td class="px-6 py-4">
                       Argentina
                    </td>
                    <td class="px-6 py-4">
                    TKW N°1
                    </td>
                    <td class="px-6 py-4">
    
                    </td>
                </tr>
                <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                        Maria Asuncion Castro
                    </th>
                    <td class="px-6 py-4">
                        Argentina
                    </td>
                    <td class="px-6 py-4">
                      TKW N°1  
                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                        Martina Perez
                    </th>
                    <td class="px-6 py-4">
    Argentina
                    </td>
                    <td class="px-6 py-4">
                    TKW N°1
                    </td>
                    <td class="px-6 py-4">
    
                    </td>
                </tr>
                <tr class="hover:bg-gray-300 dark:bg-gray-100 dark:border-gray-700 ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                       Maria Lopez
                    </th>
                    <td class="px-6 py-4">
    Argentina
                    </td>
                    <td class="px-6 py-4">
                    TKW N°1
                    </td>
                    <td class="px-6 py-4">
    
                    </td>
                </tr>




            </tbody>
        </table>
    </div>

    
</div>
<div class="info-competencia mt-6 mb-8">

@if('{{$mensaje}}')
<div id="alert-border-3" class="flex p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
    <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <div class="ml-3 text-sm font-medium">
     Inscripción realizada correctamente
    </div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
</div>
@else
<div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
    <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <div class="ml-3 text-sm font-medium">
     Algo salio mal
    </div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
</div>
@endif
    <div>
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400 ">{{ $data['titulo'] }}</h1>
    </div>
    <div class="datos-competencia gap-x-2 flex flex-row justify-center mt-6">
        <div class="flyer max-w-sm mr-4">
            <img src="https://img.pikbest.com/backgrounds/20190415/taekwondo-competition-background-image_1811499.jpg!w700wp">
        </div>
        <div class="flex flex-col">
            <div class="data dark:text-gray-400 mb-2" style="height: 80%;">
                <ul>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2">
                        <h1 class="text-lg font-semibold">Lugar</h1>
                        {{ $data['titulo'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Fecha apertura</h1>
                        23/06/2023
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Fecha cierre</h1>
                        26/06/2023
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Horario</h1>
                        08:00 - 16:30
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Descripción</h1>
                        Ta complicadísima wacho, no se anoten D:
                    </li>
                </ul>
            </div>
            <div class="flex flex-row justify-center items-end mt-8 text-gray-500 ml-5" style="height: 20%;">
                <div grid justify-items-center>

                    <!-- <button id="openModal"  type="button" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Inscripción
                                </span>
                            </button>
                             -->
                    <button wire:click="mostrarInscripcion({{$data['id']}})" type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Inscribirme
                    </button>
                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Bases y condiciones
                        </span>
                    </button>

                </div>
            </div>
        </div>
    </div>

</div>

@livewire('competencias.formulario-inscripcion')

<div class="resultados-competencia" style="margin-top: 5rem;">
    <div class="">
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400">Resultados</h1>
    </div>
    @livewire('competidores.tabla-competidores')
</div>




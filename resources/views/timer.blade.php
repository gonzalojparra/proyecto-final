<x-app-layout>
    @section('title', 'Temporizador')
    @livewireScripts()

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Temporizador') }}
        </h2>
    </x-slot>

    <style>
        #pasadaCerrada {
            @apply bg-green-200 text-green-800 p-4 rounded-lg mt-4;
        }
    </style>

    <div class="p-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-5">
                <div>

                    <div class="timer-container">
                        <div class="timer">
                            <span id="countdown">90</span>
                        </div>
                    </div>

                    <div class="mb-7 mt-2flex justify-center">

                        <select id="select-categoria" onchange="cargarPasadas()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Elegi la categoría</option>
                            @foreach ($categorias as $categoria)
                            <option class="categoria" value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }} | {{ $categoria['edad_desde'] }} - {{ $categoria['edad_hasta'] }} años</option>
                            @endforeach
                        </select>

                        <select id="select-pasada" class="mt-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option class="pasada" selected disabled>Elegi la pasada</option>
                        </select>

                    </div>

                    <div class="text-center">
                        <!-- boton inicio -->
                        <button id="btnIniciar" class="py-4 px-7 rounded bg-green-500 hover:bg-green-600 text-white border-green-700">
                            <svg fill="none" class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path>
                            </svg>
                        </button>

                        <button id="btnDetener" class="py-4 px-7 rounded bg-gray-500 text-white border-red-700" disabled>
                            <svg fill="none" class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5"></path>
                            </svg>
                        </button>
                        <!-- boton reinicio -->
                        <button id="btnReiniciar" class="py-4 px-7 rounded bg-gray-500 text-white border-yellow-700" disabled>
                            <svg fill="none" class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Tiempo dado  -->
                    <div>
                        <p id="contador" class="text-4xl mt-3 p-auto text-center">&nbsp;</p>
                    </div>

                    <div class="mb-7 mt-2 flex justify-center" id="dynamic-table-container">
                        <!-- Acá se generará la tabla dinamica -->
                    </div>

                    <div id="pasadaCerrada" class="hidden bg-green-200 text-green-800 p-4 rounded-lg mt-4">
                        Pasada cerrada
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/timer.js') }}"></script>

</x-app-layout>
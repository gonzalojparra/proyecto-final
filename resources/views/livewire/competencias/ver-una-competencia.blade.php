<div class="info-competencia mt-6 mb-8">
    <div>
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400 ">{{ $data['titulo'] }}</h1>
    </div>
    <div class="datos-competencia gap-x-2 flex flex-row justify-center mt-6">
        <div class="flyer max-w-sm mr-4">
            <img src="https://img.pikbest.com/backgrounds/20190415/taekwondo-competition-background-image_1811499.jpg!w700wp">
        </div>
        @livewire('competencias.formulario-inscripcion')
        <div class="flex flex-col">
            <div class="data dark:text-gray-400 mb-2" style="height: 80%;">
                <ul>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2">
                        <h1 class="text-lg font-semibold">Descripción</h1>
                        {{ $data['descripcion'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Dia de inicio</h1>
                        {{ $data['fecha_inicio'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Dia de finalización</h1>
                        {{ $data['fecha_fin'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Cantidad de jueces</h1>
                        {{ $data['cant_jueces'] }}
                    </li>
                    <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                        <h1 class="text-lg font-semibold">Invitación</h1>
                        
                        {{ $data['flyer'] }}
                    </li>
                </ul>
                <img src="storage/app/public/{{$data['flyer']}}" alt="">
            </div>
            <div class="flex flex-row justify-center items-end mt-8 text-gray-500 ml-5" style="height: 20%;">
                <div grid justify-items-center>

                    <!-- <button id="openModal"  type="button" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Inscripción
                                </span>
                            </button>
                             -->
                    <button id="openModal" wire:click="mostrarInscripcion({{$data['id']}})" type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
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


<div class="resultados-competencia" style="margin-top: 5rem;">
    <div class="">
        <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400">Resultados</h1>
    </div>
    @livewire('competidores.competencia-competidor', ['competenciaId' => $data['id']] )
</div>

<form id="inscripcion" wire:model='open' class="bg-white dark:bg-gray-900" method="POST">
    @csrf
    <!-- Modal con los datos del competidor/juez -->
    <div id="myModal" class="fixed inset-0 hidden items-center rounded-lg justify-center z-50 m-5 border-1">
        <div class="bg-white dark:bg-gray-900 rounded-lg">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                @role('Competidor')
                <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                <div class="mb-4">
                    <label for="nameTeam" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                    <input id="nameTeam" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="nombreEscuela" readonly>
                    <button id="actualizarEscuelaBtn" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Pedir Actualizacion
                    </button>
                </div>
                <div class="mb-4">
                    <label for="graduacion" class="block text-gray-700 dark:text-gray-300">Graduacion:</label>
                    <input id="graduacion" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="graduacion" readonly>
                    <button id="actualizarGraduacionBtn" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Pedir Actualizacion
                    </button>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                    <input id="email" type="email" class="w-full border-gray-300 rounded-md p-2" wire:model="email" readonly>
                </div>
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 dark:text-gray-300">Nombre:</label>
                    <input id="nombre" type="Nombre" class="w-full border-gray-300 rounded-md p-2" wire:model="nombre" readonly>
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 dark:text-gray-300">Apellido:</label>
                    <input id="apellido" type="Apellido" class="w-full border-gray-300 rounded-md p-2" wire:model="apellido" readonly>
                </div>
                <div class="mb-4">
                    <label for="dni" class="block text-gray-700 dark:text-gray-300">DNI:</label>
                    <input id="dni" type="email" class="w-full border-gray-300 rounded-md p-2" wire:model="du" readonly>
                </div>
                @endrole
                @role('Juez')
                <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                <div class="mb-4">
                    <label for="nameTeam" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                    <input id="nameTeam" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="nombreEscuela" readonly>
                    <button id="actualizarEscuela" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Pedir Actualizacion
                    </button>
                </div>
                <div class="mb-4 w-md">
                    <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                    <input id="email" type="email" class="w-full border-gray-300 rounded-md p-2" wire:model="email" readonly>
                </div>
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 dark:text-gray-300">Nombre:</label>
                    <input id="nombre" type="Nombre" class="w-full border-gray-300 rounded-md p-2" wire:model="nombre" readonly>
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 dark:text-gray-300">Apellido:</label>
                    <input id="apellido" type="Apellido" class="w-full border-gray-300 rounded-md p-2" wire:model="apellido" readonly>
                </div>
                @endrole
                <div class="flex justify-end">
                    <button id="closeModal" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Cerrar
                    </button>
                    <button id="confirmModal" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Cambiar escuela-->
<form id="actualizarEscuela" action="{{route('competidores.actualizarEscuela')}}" method="POST">
    @csrf
    <div id="modalEscuela" class="fixed inset-0 flex hidden items-center justify-center z-60 m-5 border-1 ">
        <div class=" dark:bg-gray-700 bg-gray-700 rounded-lg">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                <div class="mb-4">
                    <label for="actualEscuela" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                    <input id="actualEscuela" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="nombreEscuela" readonly>
                </div>
                <div class="mb-4">
                    <label for="nuevaEscuela" class="block text-gray-700 dark:text-gray-300">Cambio a:</label>
                    <select name="nuevaEscuela" id="escuela" class="form-select">

                    </select>
                </div>
                <div class="flex justify-end">
                    <button id="closeModalEscuela" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Cerrar
                    </button>
                    <button id="confirmModalEscuela" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@role('Competidor')
<form id="actualizarGraduacion" action="{{route('competidores.actualizarGraduacion')}}" method="POST">
    @csrf
    <div id="modalGraduacion" class="fixed inset-0 flex hidden items-center justify-center z-60 m-5 border-1">
        <div class="bg-white dark:bg-gray-900">
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                <div class="mb-4">
                    <label for="actualGraduacion" class="block text-gray-700 dark:text-gray-300">Graduacion: </label>
                    <input id="actualGraduacion" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="{{ $categoria->graduacion }}" readonly>
                </div>
                <div class="mb-4">
                    <label for="nuevaGraduacion" class="block text-gray-700 dark:text-gray-300">Cambio a:</label>
                    <select name="nuevaGraduacion" id="graduacionNueva" class="form-select">
                        @foreach($todasCategorias as $categorias)
                        <option wire:model="{{ $categorias->id }}">{{ $categorias->graduacion }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="flex justify-end">
                    <button id="closeModalGraduacion" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        Cerrar
                    </button>
                    <button id="confirmModalGraduacion" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                        Confirmar
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>
@endrole
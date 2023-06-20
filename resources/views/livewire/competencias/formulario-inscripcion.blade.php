<x-modal wire:model='open' >
    <!-- Mostrar mensaje de éxito -->
    <div wire:offline.remove>
        @if (session()->has('mensaje'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('mensaje') }}
        </div>
        @endif
    </div>

    <!-- Mostrar mensaje de error -->
    <div wire:offline.remove>
        @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <form  wire:submit.prevent='create'>
        @csrf
        <!-- Modal con los datos del competidor/juez -->
        <div class="inset-0 items-center z-50 m-5 p-6">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>

                    <!-- inputs no editables -->
                    <p class="mb-3 text-gray-500 dark:text-gray-400 text-lg">Nombre: <strong class="font-semibold text-gray-900 dark:text-white" >{{ $nombre }}</strong></p>
                    <p class="mb-3 text-gray-500 dark:text-gray-400 text-lg">Apellido: <strong class="font-semibold text-gray-900 dark:text-white" >{{ $apellido }}</strong></p> 
                    @role('Competidor')
                    <p class="mb-3 text-gray-500 dark:text-gray-400 text-lg">DU: <strong class="font-semibold text-gray-900 dark:text-white" >{{ $du }}</strong></p>
                    <p class="mb-3 text-gray-500 dark:text-gray-400 text-lg">Fecha Nacimiento: <strong class="font-semibold text-gray-900 dark:text-white" >{{date('d-m-Y', strtotime($fechaNac))}}</strong></p>
                    @endrole
                    <p class="mb-3 text-gray-500 dark:text-gray-400 text-lg">Email: <strong class="font-semibold text-gray-900 dark:text-white" >{{ $email }}</strong></p>

                    <!-- Inputs editables -->
                    <div class="mb-4">
                        <label for="nameTeam" class="block text-gray-700 dark:text-gray-300">Escuela (editable): </label>
                        <select id="nameTeam" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="escuela">
                            @foreach($escuelas as $unaEscuela)
                            <option>{{$unaEscuela['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    @role('Competidor')
                    <div class="mb-4">
                        <label for="graduacion" class="block text-gray-700 dark:text-gray-300">Graduacion (editable):</label>
                        <select id="graduacion" type="text" class="w-full border-gray-300 rounded-md p-2" wire:model="graduacion">
                            @foreach($graduacionesCompetidor as $unaGraduacion)
                            <option>{{$unaGraduacion}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($inputGal)
                    <div class="mb-4">
                        <label for="gal" class="block text-gray-700 dark:text-gray-300">GAL (si no tenes GAL registrado, ingresalo acá):</label>
                        <input id="gal" type="gal" class="w-full border-gray-300 rounded-md p-2" wire:model="gal" {{$editarGal}}>
                        <button wire:click="editar()" id="actualizarGralBtn" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{$botonGal}}
                        </button>
                    </div>
                    @endIf
                    @endrole
                    <div class="flex justify-end">
                        <button wire:click="$set('open',false)" id="closeModal" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Cerrar
                        </button>
                        <button wire:click='submit' id="confirmModal" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
                            Confirmar
                        </button>
                    </div>
                </div>
        </div>
  </form>
</x-modal>

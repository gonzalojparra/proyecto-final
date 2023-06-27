@section('title', 'Perfil')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="m-10 w-auto h-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-3" id="showDatos">
        <div class="flex justify-center">
            <img class=" w-38 h-38 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
        </div>
        <div class="tracking-wide text-center ">
            <div class="leading-tight whitespace-pre-line ">
                <div class="text-gray-100 text-2xl text-center uppercase">{{ $user->name }} {{$user->apellido}}</div>
                <hr class="mt-2 mb-2">
                <div class="text-gray-100 text-xl"><strong>Informacion Personal</strong></div>
                <div class="text-gray-100 text-lg mt-1">Email: {{ $user->email }}</div>
                @role('Juez')
                <div class="text-gray-100 text-lg">Escuela: {{$user->team->name}}</div>
                @endrole
                @role('Competidor')
                <div class="text-gray-100 text-lg">DU: {{ $user->du }}</div>
                <div class="text-gray-100  text-lg">Nacimiento: {{ $user->fecha_nac }}</div>
                <div class="text-gray-100 text-lg ">Genero: {{ $user->genero }}</div>
                <div class="text-gray-100 text-lg"> Graduacion: {{ $user->graduacion->nombre }}</div>
                <div class="text-gray-100 text-lg"> Escuela: {{$user->team->name}}</div>
                @if($user->gal != null)
                <div class="text-gray-100 text-lg uppercase">Gal: {{ $user->gal }}</div>
                @endif
                @endrole
            </div>
        </div>

        @if (isset($user) && isset($user->roles[0]) && $user->roles[0]->name != 'Admin')
        @livewire('perfil.ver-resultados')
        @endif

        <div class="flex justify-between mb-3">
            @if (isset($user) && isset($user->roles[0]) && $user->roles[0]->name != 'Admin')
            <div>
                <button id="botonInscripciones" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-yellow-500 to-violet-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-2 focus:outline-none focus:ring-green-200 dark:focus:ring-yellow-500">
                    <span class="flex justify-between items-center relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        <svg class="w-6 h-6 mr-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path fill="currentColor" d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-5 1v2H7V2h4Zm5 16H2V3h3v1a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2V3h3v15Z" />
                            <path fill="currentColor" d="M13 9H8a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2Zm0 4H8a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2Zm-8-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
                        </svg>
                        <span class="inline-block">Inscripciones</span>
                    </span>
                </button>
                <button id="botonHistorial" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-blue-500 to-green-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-blue-500">
                    <span class="flex justify-between items-center relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        <svg class="w-6 h-6 mr-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z" />
                        </svg>
                        <span class="inline-block">Historial</span>
                    </span>
                </button>
            </div>
            <button id="botonPerfil" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span class="relative px-5 py-2.5 inline transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                    </svg>
                    <span class="inline-block">Editar Perfil</span>
                </span>
            </button>
            @endif
        </div>
    </div>
    <div class="p-1"></div>



    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8" style="display:none;" id="formUpdate">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
            @endif
        </div>
    </div>

</x-app-layout>
<script src="{{ asset('js/updatePerfil.js') }}"></script>
<script src="{{ asset('js/funcionesPerfil.js') }}"></script>
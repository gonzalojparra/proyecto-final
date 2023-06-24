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
                <div class="text-gray-100 text-lg">Escuela: {{Auth::user()->currentTeam->name}}</div>
                @endrole
                @role('Competidor')
                <div class="text-gray-100 text-lg">DU: {{ $user->du }}</div>
                <div class="text-gray-100  text-lg">Nacimiento: {{ $user->fecha_nac }}</div>
                <div class="text-gray-100 text-lg ">Genero: {{ $user->genero }}</div>
                <div class="text-gray-100 text-lg"> Graduacion: {{ $user->graduacion->nombre }}</div>
                <div class="text-gray-100 text-lg"> Escuela: {{Auth::user()->currentTeam->name}}</div>
                @if($user->gal != null)
                <div class="text-gray-100 text-lg uppercase">Gal: {{ $user->gal }}</div>
                @endif
                @endrole
            </div>
        </div>
      
        <div class="flex justify-end mb-3">
            <button id="botonPerfil" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span class="relative px-5 py-2.5 inline transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                    </svg>
                    <span class="inline-block">Editar Perfil</span>
                </span>
            </button>
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
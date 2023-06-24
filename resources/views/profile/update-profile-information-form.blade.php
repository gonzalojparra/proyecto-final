<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <div class="mt-2 justify-center items-center">
            <div class="flex justify-center items-center">
                <img class="ml-3 w-3/4 h-3/4 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">
            </div>
            <x-section-border />
            <div id="tabs">
                <ul class="text-white p-3 ">
                    <li class="border-b-2 my-3 text-lg text-center hover:border-b-2 cursor-pointer" name="0">Ver Perfil</li>
                    <li class="my-3 text-lg hover:border-b-2 cursor-pointer" name="1">Inscripciones Pendientes</li>
                    <li class="my-3 text-lg hover:border-b-2 cursor-pointer" name="2">Inscripciones Finalizadas</li>
                </ul>
            </div>
        </div>
    </x-slot>

    <x-slot name="form">

        <div class="w-full">
            @livewire('perfil.datos-perfil')
        </div>

    </x-slot>

    <x-slot name="actions">

    </x-slot>
</x-form-section>
<script src="{{ asset('js/funcionesPerfil.js') }}"></script>
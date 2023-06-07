<x-modal wire:model='open'>

    <div class="w-3/4 m-auto py-5">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="nombre" value="{{ __('Nombre') }}" />
                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autocomplete="username" />
                <div for="Nombre" id="NombreFeedback" class="text-base">&nbsp;</div>
            </div>
            <div>
                <x-label for="descripcion" value="{{ __('Descripcion') }}" />
                <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion')" required autocomplete="username" />
                <div for="descripcion" id="emailFeedback" class="text-base">&nbsp;</div>
            </div>
            <div>
                <x-label for="fecha_inicio" value="{{ __('Fecha Inicio') }}" />
                <x-input id="fecha_inicio" class="block mt-1 w-full" type="date" name="fecha_inicio" :value="old('fecha_inicio')" required autocomplete="username" />
                <div for="fecha_inicio" id="emailFeedback" class="text-base">&nbsp;</div>
            </div>
            <div>
                <x-label for="fecha_fin" value="{{ __('Fecha Fin') }}" />
                <x-input id="fecha_fin" class="block mt-1 w-full" type="date" name="fecha_fin" :value="old('fecha_fin')" required autocomplete="username" />
                <div for="fecha_fin" id="emailFeedback" class="text-base">&nbsp;</div>
            </div>
            <div class="mt-4">
                <x-label for="invitacioin" value="{{ __('Invitacioin') }}" />
                <x-input id="invitacioin" class="block mt-1 w-full" type="file" name="invitacioin" required autocomplete="current-invitacioin" />
                <div for="pasword" id="contraseniaFeedback" class="text-base">&nbsp;</div>
            </div>
            <div class="mt-4">
                <x-label for="bases" value="{{ __('Bases y Condiciones') }}" />
                <x-input id="bases" class="block mt-1 w-full" type="file" name="bases" required autocomplete="current-bases" />
                <div for="pasword" id="contraseniaFeedback" class="text-base">&nbsp;</div>
            </div>
            <div class="mt-4">
                <x-label for="invitacioin" value="{{ __('Invitacioin') }}" />
                <x-input id="invitacioin" class="block mt-1 w-full" type="file" name="invitacioin" required autocomplete="current-invitacioin" />
                <div for="pasword" id="contraseniaFeedback" class="text-base">&nbsp;</div>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Guardar') }}
                </x-button>
                <x-button class="ml-4 bg-red-600">
                    {{ __('Cancelar') }}
                </x-button>
            </div>
        </form>

    </div>
</x-modal>
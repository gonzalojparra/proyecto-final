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

        <form wire:submit.prevent="create" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="titulo">Titulo</x-label>
                <x-input class="block mt-1 w-full" wire:model="titulo" type="text" id="titulo" />
                @error('titulo') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="descripcion">descripcion</x-label>
                <x-input class="block mt-1 w-full" wire:model="descripcion" type="text" id="descripcion" />
                @error('descripcion') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="fecha_inicio">fecha_inicio</x-label>
                <x-input class="block mt-1 w-full" wire:model="fecha_inicio" type="date" id="fecha_inicio" />
                @error('fecha_inicio') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="fecha_fin">fecha_fin</x-label>
                <x-input class="block mt-1 w-full" wire:model="fecha_fin" type="date" id="fecha_fin" />
                @error('fecha_fin') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-label for="bases">Bases</x-label>
                <x-input class="block mt-1 w-full" wire:model="bases" type="file" id="bases" />
                @error('bases') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-label for="flyer">flyer</x-label>
                <x-input class="block mt-1 w-full" wire:model="flyer" type="file" id="flyer" />
                @error('flyer') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-label for="invitacioin" value="{{ __('Invitacioin') }}" />
                <x-input id="invitacioin" class="block mt-1 w-full" type="file" name="invitacioin" required autocomplete="current-invitacioin" />
                <div for="pasword" id="contraseniaFeedback" class="text-base">&nbsp;</div>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button type='submit' class="ml-4">
                    {{ __('Guardar') }}
                </x-button>
                <x-button type='reset' class="ml-4 bg-red-600" wire:click="cerrarModal">
                    {{ __('Cancelar') }}
                </x-button>
            </div>
        </form>

    </div>
</x-modal>
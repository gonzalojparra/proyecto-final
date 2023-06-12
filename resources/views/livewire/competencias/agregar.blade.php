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

        <form wire:submit.prevent="{{$accionForm}}" enctype="multipart/form-data">
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
            @if($boton == 'agregar')
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
                <x-label for="flyer">Invitacion</x-label>
                <x-input class="block mt-1 w-full" wire:model="invitacion" type="file" id="flyer" />
                @error('flyer') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            @endif
            <div class="flex items-center justify-between mt-4">
                <div>
                    @if($boton != 'agregar')
                    <x-button type='submit' class="ml-4  bg-green-600" wire:click='cerrarConvocatoria({{$idCompetencia}})'>
                        {{ __('Cerrar Convocatoria') }}
                    </x-button>
                    @endif
                </div>
                <div>
                    <x-button type='submit' class="ml-4">
                        {{ __('Guardar') }}
                    </x-button>
                    <x-button type='reset' class="ml-4 bg-red-600" wire:click="cerrarModal">
                        {{ __('Cancelar') }}
                    </x-button>
                </div>
            </div>
        </form>

    </div>
</x-modal>
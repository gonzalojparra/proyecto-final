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

        @isset($graduacion)
    @dd($graduacion)
    @endisset

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

                @if (count($categorias) > 0)
                    <x-label class="mt-2">Categorias</x-label>
                    <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        {{$mismaCat = ""}}
                        @foreach ($categorias as $categoria)
                            @if ($mismaCat != $categoria->nombre)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="{{$categoria->id}}" wire:model="categoria" type="checkbox" value="{{$categoria->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="{{$categoria->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$categoria->nombre}}</label>
                                    </div>
                                </li>
                                <?php $mismaCat = $categoria->nombre ?>
                            @endif
                        @endforeach
                    </ul>
                @endif

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
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
            {{-- @if($boton == 'agregar') --}}
            <div>
                <x-label for="fecha_inicio">fecha inicio</x-label>
                <x-input class="block mt-1 w-full" wire:model="fecha_inicio" type="date" id="fecha_inicio" />
                @error('fecha_inicio') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-label for="fecha_fin">fecha fin</x-label>
                <x-input class="block mt-1 w-full" wire:model="fecha_fin" type="date" id="fecha_fin" />
                @error('fecha_fin') <span class="error">{{ $message }}</span> @enderror
            </div>
            @if ($boton == 'agregar')
                @if (count($categorias) > 0)
                    <x-label class="mt-2">Categorias</x-label>
                    <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($categorias as $categoria)
                            <?php $seleccionado = false?>
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                @foreach ($categoriasSeleccionadas as $categoriaSeleccionada)
                                    @if ($categoria->id == $categoriaSeleccionada->id_categoria)
                                        <?php $seleccionado = true?>
                                    @endif
                                @endforeach
                                <div class="flex items-center pl-3">
                                    <input id="{{$categoria->id}}" wire:model="categoria" type="checkbox" value="{{$categoria->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="{{$categoria->id}}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$categoria->nombre}}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
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
            
            {{-- @endif --}}
            <div class="flex items-center justify-between mt-4">
                <div>
                    @if (isset($competencia))
                        @if($boton != 'agregar' && $competencia->estado != 5)
                            @switch($competencia->estado)
                                @case(1)
                                    <x-button type='reset' class="ml-4  bg-green-600 disabled:opacity-25" wire:click='abrirInscripciones({{$competencia->id}})'>
                                        Abrir inscripciones
                                    </x-button>
                                    <x-button type='reset' class="ml-4  bg-red-600 disabled:opacity-25" wire:click='delete({{$competencia->id}})'>
                                        <svg fill="none" stroke="currentColor" class="w-5 m-auto" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="false">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </x-button>
                                    @break
                                @case(2)
                                    <x-button type='reset' class="ml-4  bg-green-600 disabled:opacity-25" wire:click='cerrarConvocatoria({{$competencia->id}})'>
                                        Cerrar Inscripciones
                                    </x-button>
                                    <x-button type='reset' class="ml-4  bg-red-600 disabled:opacity-25" wire:click='delete({{$competencia->id}})'>
                                        <svg fill="none" stroke="currentColor" class="w-5 m-auto" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="false">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </x-button>
                                    @break
                                @case(3)
                                    <x-button type='reset' class="ml-4  bg-green-600 disabled:opacity-25" wire:click='iniciarCompetencia({{$competencia->id}})'>
                                        Empezar competencia
                                    </x-button>
                                @break
                                @case(4)
                                    <x-button type='reset' class="ml-4  bg-green-600 disabled:opacity-25" wire:click='terminarCompetencia({{$competencia->id}})'>
                                        Finalizar competencia
                                    </x-button>
                                @break
                                @default
                                    
                            @endswitch
                        @endif
                    @endif
                </div>
                <div>
                    <x-button type='submit' class="ml-4 bg-green-600">
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
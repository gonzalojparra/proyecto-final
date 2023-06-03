<div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'>
            <div class="text-center ">
                <h2 class='text-3xl '>{{$nombre}} {{$apellido}}</h2>
            </div>
        </x-slot>
        <x-slot name='content'>
            <div class='flex flex-wrap justify-center'>

                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='nombre' />
                </div>
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='apellido' />
                </div>
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='email' />
                </div>
                @empty(!$fecha_nac)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='fecha_nac' />
                </div>
                @endempty
                @empty(!$gal)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='gal' />
                </div>
                @endempty
                @empty(!$du)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='du' />
                </div>
                @endempty
                @empty(!$clasificacion)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='clasificacion' />
                </div>
                @endempty
                @empty(!$graduacion)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='graduacion' />
                </div>
                @endempty
                @empty(!$genero)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='genero' />
                </div>
                @endempty
                @empty(!$verificado)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='verificado' />
                </div>
                @endempty
                @empty(!$escuela)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='escuela' />
                </div>
                @endempty
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div>
                <x-secondary-button wire:click="$set('open',false)">
                    Rechazar
                </x-secondary-button>
                <x-danger-button wire:click="aceptarSolicitud('{{$iduser}})'">
                    Aceptar
                </x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
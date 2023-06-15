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
                    <x-input type="text" class="w-80 text-center" wire:model='nombre' readonly />
                </div>
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='apellido' readonly />
                </div>
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='email' readonly />
                </div>
                @empty(!$fecha_nac)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='fecha_nac' readonly />
                </div>
                @endempty
                @empty(!$gal)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='gal' readonly />
                </div>
                @endempty
                @empty(!$du)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='du' readonly />
                </div>
                @endempty
                @empty(!$clasificacion)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='clasificacion' readonly />
                </div>
                @endempty
                @empty(!$graduacion)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='graduacion' readonly />
                </div>
                @endempty
                @empty(!$genero)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='genero' readonly />
                </div>
                @endempty
                @empty(!$verificado)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='verificado' readonly />
                </div>
                @endempty
                @empty(!$escuela)
                <div class="mb-4 flex align-center">
                    <x-input type="text" class="w-80 text-center" wire:model='escuela' readonly />
                </div>
                @endempty
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div>
                <x-secondary-button wire:click="rechazarSolicitud({{$iduser}})">
                    Rechazar
                </x-secondary-button>
                <x-danger-button wire:click="aceptarSolicitud({{$iduser}})">
                    Aceptar
                </x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
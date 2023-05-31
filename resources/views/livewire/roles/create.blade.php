<div>
    <x-dialog-modal wire:model='open'>
        <x-slot name='title'  >
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
            </div>
        </x-slot>
        <x-slot name='footer'>
            <div>
                <x-secondary-button wire:click="$set('open',false)">
                    Rechazar
                </x-secondary-button>
                <x-danger-button>
                    Aceptar
                </x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
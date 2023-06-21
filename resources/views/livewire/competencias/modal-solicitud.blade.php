<x-modal wire:model='open'>
    <div class="flex justify-center w-full p-8">
        @if ($escuela !== null)
        <x-label>Solicita Cambio de Escuela</x-label>
        <x-input class="w-3/4" type="text" wire:model='escuela'></x-input>
        @endif
        @if ($gal !== null)
        <x-label>Solicita Cambio de Gal</x-label>
        <x-input class="w-3/4" type="text" wire:model='gal'></x-input>
        @endif
        @if ($graduacion !== null)3
        <x-label>Solicita Cambio de Graduacion</x-label>
        <x-input class="w-3/4" type="text" wire:model='graduacion'></x-input>
        @endif
    </div>

    <div class="flex justify-end p-4">
        <button wire:click="rechazarCambio" id="closeModal" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
            Rechazar
        </button>
        <button wire:click='aceptarCambio' id="confirmModal" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
            Aceptar
        </button>
    </div>
</x-modal>
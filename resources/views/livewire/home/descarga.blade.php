<x-modal wire:model='open'>
    <embed src="storage/{{$archivo}}" width="100%" height="800px">

    @if ($archivo == 'flyerLiga.jpeg')
    <div class="absolute top-0 w-full h-full bg-transparent flex justify-center items-end  hover:bg-green-800 hover:text-black p-4 stroke-black" style="background-color:transparente !important">
        <button class="w-full bg-transparent h-full" wire:click="$emitUp('descagaNomas',{{3}})">
            <h3 class="text-2xl rounded-xl">Descargatelo!!!</h3>
        </button>
    </div>
    @endif


</x-modal>
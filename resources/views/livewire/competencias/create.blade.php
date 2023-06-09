<div class="bg-white">
    @if (session()->has('msj'))
        <div class="alert alert-success">{{ session('msj') }}</div>
    @endif

    <form wire:submit.prevent="create" enctype="multipart/form-data">
        <div>
            <label for="titulo">Titulo</label>
            <input wire:model="titulo" type="text" id="titulo">
            @error('titulo') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="descripcion">descripcion</label>
            <input wire:model="descripcion" type="text" id="descripcion">
            @error('descripcion') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="fecha_inicio">fecha_inicio</label>
            <input wire:model="fecha_inicio" type="date" id="fecha_inicio">
            @error('fecha_inicio') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="fecha_fin">fecha_fin</label>
            <input wire:model="fecha_fin" type="date" id="fecha_fin">
            @error('fecha_fin') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="bases">Bases</label>
            <input wire:model="bases" type="file" id="bases">
            @error('bases') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="flyer">flyer</label>
            <input wire:model="flyer" type="file" id="flyer">
            @error('flyer') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Crear Competencia</button>
    </form>
</div>
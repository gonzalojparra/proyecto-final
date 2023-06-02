<x-app-layout>
    <form id="inscripcion" action="{{route('competidores.inscripcion')}}" method="POST">
        @csrf


        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 bg-white m-3 p-3">
            <div class="w-full md:w-1/5">
                <label for="campo1" class="block text-sm font-medium text-gray-700">Titulo</label>
                <p id="campo1" class="form-text">{{$competencia->titulo}}</p>
            </div>

            <div class="w-full md:w-1/5">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Bases</label>
                <p id="campo2" class="form-text">{{$competencia->bases}}</p>
            </div>

            <div class="w-full md:w-1/5">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Descripción</label>
                <p id="campo2" class="form-text">{{$competencia->descripcion}}</p>
            </div>

            <div class="w-full md:w-1/5">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <p id="campo2" class="form-text">{{$competencia->fecha_inicio}}</p>
            </div>

            <div class="w-full md:w-1/5">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Fecha fin</label>
                <p id="campo2" class="form-text">{{$competencia->fecha_fin}}</p>
            </div>

            <div class="w-full md:w-1/5">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Categorias</label>
                @foreach ($categorias as $categoria)
                <p id="campo2" class="form-text">{{ $categoria->nombre }}</p>
                <p id="campo2" class="form-text">{{ $categoria->graduacion }}</p>

                @endforeach
            </div>
            <!-- Agrega los otros campos de información aquí -->

        </div>

        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
            Inscribirme
        </button>
    </form>
</x-app-layout>
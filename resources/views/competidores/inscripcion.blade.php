<x-app-layout>
        
    <form id="inscripcion" class="bg-white dark:bg-gray-900" action="{{route('competidores.inscripcion')}}" method="POST">
        @csrf
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Inscripción a competencias</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Explora las distintas competencias que se encuentran en nuestra región e inscríbete según tu categoría.</p>
            </div>
            @if(!isset($categorias) || !array_key_exists('id_categoria', $categorias))
            <div class="p-2 bg-red-200 text-red-800 p-4 text-sm rounded border border-red-300 my-3">
                Por el momento no se encuentran competencias disponibles para inscribirse. 
            </div>
            @else
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="w-full rounded-lg sm:rounded-none sm:rounded-l-lg" src="https://i.ebayimg.com/thumbs/images/g/dKkAAOSwHnFV5ZEV/s-l300.jpg" alt="Bonnie Avatar">
                    </a>
                    <div class="p-5">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">{{ $competencia->titulo }}</a>
                        </h3>
                        <span class="text-gray-500 dark:text-gray-400">{{ $competencia->fecha_inicio }} | {{ $competencia->fecha_fin }}</span>
                        <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400">{{ $competencia->descripcion }}</p>
                        @foreach ($categorias as $categoria)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $categoria->nombre }} - {{ $categoria->graduacion }}</p>
                        @endforeach
                        <button type="submit" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Inscribirme
                        </button>
                    </div>

                </div>
            </div>
            <!-- Agrega los otros campos de información aquí -->
            @endif
        </div>
    </form>

</x-app-layout>
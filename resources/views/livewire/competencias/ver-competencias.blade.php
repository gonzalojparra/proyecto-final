<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Competencias</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat illo, odit voluptatibus delectus doloremque recusandae!</p>
        </div>
        <div class="grid gap-8 lg:grid-cols-2">
        @foreach ( $competencias as $competencia )
        @role('Competidor') 
        @if($competencia->estado == 2 )
        <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-auto" src="{{ Storage::url($competencia->flyer) }}" alt="flyer" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $competencia->titulo }}</h5>
                </a>
                <div class="flex justify-start items-center mt-2 text-gray-500">
                    <span class="text-lg">Desde <b>{{date('d-m-Y', strtotime($competencia->fecha_inicio))}}</b> hasta <b>{{date('d-m-Y', strtotime($competencia->fecha_fin))}}</b></span>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    @switch($competencia->estado)
                    @case(1)
                        Inscripcion solo jueces
                        @break
                    @case(2)
                        Inscripciones abiertas.
                        @break
                    @case(3)
                        Inscripciones cerradas.
                    @break
                    @case(4)
                        Competencia en curso.
                    @break
                    @case(5)
                        Competencia finalizada.
                    @break
                    @default
                        Finalizada
                @endswitch
                </p>
                @auth
                <a href="{{ route('competencias.ver-una-competencia', ['competenciaId' => $competencia->id])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ver más
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ver más
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @endauth
            </div>
        </div>
        @endrole
        @else
        <div class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg w-auto" src="{{ Storage::url($competencia->flyer) }}" alt="flyer" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $competencia->titulo }}</h5>
                </a>
                <div class="flex justify-start items-center mt-2 text-gray-500">
                    <span class="text-lg">Desde <b>{{date('d-m-Y', strtotime($competencia->fecha_inicio))}}</b> hasta <b>{{date('d-m-Y', strtotime($competencia->fecha_fin))}}</b></span>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    @switch($competencia->estado)
                    @case(1)
                        Inscripcion solo jueces
                        @break
                    @case(2)
                        Inscripciones abiertas.
                        @break
                    @case(3)
                        Inscripciones cerradas.
                    @break
                    @case(4)
                        Competencia en curso.
                    @break
                    @case(5)
                        Competencia finalizada.
                    @break
                    @default
                        Finalizada
                @endswitch
                </p>
                @auth
                <a href="{{ route('competencias.ver-una-competencia', ['competenciaId' => $competencia->id])}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ver más
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Ver más
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @endauth
            </div>
        </div>
        @endif

        @endforeach
    </div>

    </div>
</section>
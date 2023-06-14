<x-app-layout>
    <div id="mensajes" class="p-4 bg-gray-800 text-white hidden">

    </div>
    <form id="inscripcion" class="bg-white dark:bg-gray-900" action="{{route('competidores.inscripcion')}}" method="POST">
        <!-- @csrf
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Inscripción a competencias</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Explora las distintas competencias que se encuentran en nuestra región e inscríbete según tu categoría.</p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                @if ($competencia)
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
                        @role('Competidor')
                        @foreach ($categorias as $categoria)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $categoria->nombre }} - {{ $categoria->graduacion }}</p>
                        @endforeach
                        @endrole
                        <button id="openModal" type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Inscribirme
                        </button>
                    </div>
                </div>
                @else
            </div>
            Si no hay competencias muestra este error -->
            <!-- <div class="bg-red-200 text-red-800 p-4 text-md rounded border border-red-300 my-3">
                No hay competencias disponibles en este momento. <br>
                Por favor, vuelve más tarde para ver nuevas competencias.
            </div>
            @endif
        </div> -->

        <button id="openModal" type="button" class="mt-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Inscribirme
                        </button>
        <!-- Modal con los datos del competidor/juez -->
        <div id="myModal" class="fixed inset-0 flex hidden items-center rounded-lg justify-center z-50 m-5 border-1">
            <div class="bg-white dark:bg-gray-900 rounded-lg">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    @role('Competidor')
                    <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                    <div class="mb-4">
                        <label for="nameTeam" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                        <input id="nameTeam" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $userTeam->name }}" readonly>
                        <button id="actualizarEscuelaBtn" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Pedir Actualizacion
                        </button>
                    </div>
                    <div class="mb-4">
                        <label for="graduacion" class="block text-gray-700 dark:text-gray-300">Graduacion:</label>
                        <input id="graduacion" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->graduacion }}" readonly>
                        <button id="actualizarGraduacionBtn" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Pedir Actualizacion
                        </button>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                        <input id="email" type="email" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 dark:text-gray-300">Nombre:</label>
                        <input id="nombre" type="Nombre" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="apellido" class="block text-gray-700 dark:text-gray-300">Apellido:</label>
                        <input id="apellido" type="Apellido" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->apellido }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 dark:text-gray-300">DNI:</label>
                        <input id="dni" type="email" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->du }}" readonly>
                    </div>
                    @endrole
                    @role('Juez')
                    <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                    <div class="mb-4">
                        <label for="nameTeam" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                        <input id="nameTeam" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $userTeam->name }}" readonly>
                        <button id="actualizarEscuela" type="button" class="inline-flex items-center mt-1 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Pedir Actualizacion
                        </button>
                    </div>
                    <div class="mb-4 w-md">
                        <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                        <input id="email" type="email" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 dark:text-gray-300">Nombre:</label>
                        <input id="nombre" type="Nombre" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="apellido" class="block text-gray-700 dark:text-gray-300">Apellido:</label>
                        <input id="apellido" type="Apellido" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->apellido }}" readonly>
                    </div>
                    @endrole
                    <div class="flex justify-end">
                        <button id="closeModal" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Cerrar
                        </button>
                        <button id="confirmModal" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                            Confirmar
                        </button>
                    </div>
                    <span id="mensajeSpan" class="ml-2 text-red-500 text-sm hidden">Aún tienes una actualizacion pendiente.</span>
                </div>
            </div>
        </div>
    </form>

    <!-- Cambiar escuela-->
    <form id="actualizarEscuela" action="{{route('competidores.actualizarEscuela')}}" method="POST">
        @csrf
        <div id="modalEscuela" class="fixed inset-0 flex hidden items-center justify-center z-60 m-5 border-1 ">
            <div class=" dark:bg-gray-700 bg-gray-700 rounded-lg">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                    <div class="mb-4">
                        <label for="actualEscuela" class="block text-gray-700 dark:text-gray-300">Escuela: </label>
                        <input id="actualEscuela" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $userTeam->name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nuevaEscuela" class="block text-gray-700 dark:text-gray-300">Cambio a:</label>
                        <select name="nuevaEscuela" id="escuela" class="form-select">
                            @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button id="closeModalEscuela" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Cerrar
                        </button>
                        <button id="confirmModalEscuela" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@role('Competidor')
    <form id="actualizarGraduacion" action="{{route('competidores.actualizarGraduacion')}}" method="POST">
        @csrf
        <div id="modalGraduacion" class="fixed inset-0 flex hidden items-center justify-center z-60 m-5 border-1">
            <div class="bg-white dark:bg-gray-900">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                    <div class="mb-4">
                        <label for="actualGraduacion" class="block text-gray-700 dark:text-gray-300">Graduacion: </label>
                        <input id="actualGraduacion" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $categoria->graduacion }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nuevaGraduacion" class="block text-gray-700 dark:text-gray-300">Cambio a:</label>
                        <select name="nuevaGraduacion" id="graduacionNueva" class="form-select">
                            @foreach($todasCategorias as $categorias)
                            <option value="{{ $categorias->id }}">{{ $categorias->graduacion }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="flex justify-end">
                        <button id="closeModalGraduacion" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Cerrar
                        </button>
                        <button id="confirmModalGraduacion" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                            Confirmar
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <form id="actualizarGraduacion" action="{{route('competidores.actualizarGraduacion')}}" method="POST">
        @csrf
        <div id="modalGraduacion" class="fixed inset-0 flex hidden items-center justify-center z-60 m-5 border-1">
            <div class="bg-white dark:bg-gray-900">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 text-white">Inscripción - Informacion sobre mi</h3>
                    <div class="mb-4">
                        <label for="actualGraduacion" class="block text-gray-700 dark:text-gray-300">Graduacion: </label>
                        <input id="actualGraduacion" type="text" class="w-full border-gray-300 rounded-md p-2" value="{{ $user->graduacion }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="nuevaGraduacion" class="block text-gray-700 dark:text-gray-300">Cambio a:</label>
                        <select name="nuevaGraduacion" id="graduacion" class="form-select">
                            @foreach($todasCategorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->graduacion }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="flex justify-end">
                        <button id="closeModalGraduacion" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            Cerrar
                        </button>
                        <button id="confirmModalGraduacion" type="button" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150">
                            Confirmar
                        </button>
                    </div>
                </div>

            </div>
        </div>
        @endrole
    </form>


    <!-- JavaScript para abrir y cerrar el modal -->
    <script>
        const btnDisabled = document.getElementById('btnDisabled');
        const mensajeSpan = document.getElementById('mensajeSpan');
        const mensajes = document.getElementById('mensajes');
        const modal = document.getElementById('myModal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modalEscuela = document.getElementById('modalEscuela');
        const actualizacionEscuelaButton = document.getElementById('actualizarEscuela');
        const confirmModalEscuelaButton = document.getElementById('confirmModalEscuela')
        const closeModalEscuelaButton = document.getElementById('closeModalEscuela');


        const actualizacionGraduacionButton = document.getElementById('actualizarGraduacion');
        const confirmModalGraduacionButton = document.getElementById('confirmModalGraduacion');
        const closeModalGraduacionButton = document.getElementById('closeModalGraduacion');
        const modalGraduacion = document.getElementById('modalGraduacion');

        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        if (btnDisabled) {
            btnDisabled.addEventListener('click', () => {

                mensajeSpan.classList.remove('hidden');
                setTimeout(function() {
                    // mensajeSpan.classList.add('hidden');
                    mensajeSpan.classList.add('hidden');
                }, 3000);
            })
        }

        actualizacionGraduacionButton.addEventListener('click', () => {
            modalGraduacion.classList.remove('hidden');
        })

        closeModalGraduacionButton.addEventListener('click', () => {
            modalGraduacion.classList.add('hidden');
        });


        actualizacionEscuelaButton.addEventListener('click', () => {
            modalEscuela.classList.remove('hidden');
        })

        closeModalEscuelaButton.addEventListener('click', () => {
            modalEscuela.classList.add('hidden');
        });

        confirmModalEscuelaButton.addEventListener('click', function(event) {
            const nuevaEscuela = document.getElementById('escuela');
            // Obtener los valores de los campos
            var informacionNueva = nuevaEscuela.options[nuevaEscuela.selectedIndex].value;

            // Crear objeto de datos
            var datos = {
                informacion_nueva: informacionNueva
            };

            console.log(datos);
            // Realizar la petición AJAX
            fetch('competidores/actualizar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(datos)
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json(); // Convertir la respuesta a JSON
                    } else {
                        throw new Error('Error en la petición');
                    }
                })
                .then(function(data) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = 'Pedido de actualizacion exitoso';

                    setTimeout(function() {
                        modalEscuela.classList.add('hidden');
                    }, 0500);
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .catch(function(error) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = 'Error en el pedido de actualizacion, puede que tenga una actualizacion pendiente';
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);
                });
        });

        confirmModalGraduacionButton.addEventListener('click', function(event) {
            const nuevaGraduacion = document.getElementById('graduacion');
            // Obtener los valores de los campos
            var informacionNueva = nuevaEscuela.options[nuevaEscuela.selectedIndex].value;

            // Crear objeto de datos
            var datos = {
                informacion_nueva: informacionNueva
            };

            // Realizar la petición AJAX
            fetch('competidores/actualizar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(datos)
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json(); // Convertir la respuesta a JSON
                    } else {
                        throw new Error('Error en la petición');
                    }
                })
                .then(function(data) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = 'Pedido de actualizacion exitoso';

                    setTimeout(function() {
                        modalEscuela.classList.add('hidden');
                    }, 0500);
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .catch(function(error) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = 'Error en el pedido de actualizacion, puede que tenga una actualizacion pendiente';
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);
                });
        });

        // Verificar si el elemento existe en el DOM
        const confirmModalButton = document.querySelector('#confirmModal');
        if (confirmModalButton) {
            // Agregar event listener solo si el elemento existe
            confirmModalButton.addEventListener('click', () => {
                document.getElementById('inscripcion').submit();
            });
        }
    </script>
    <!-- JavaScript para abrir, cerrar el modal y enviar los datos -->
    <script src="{{ asset('js/inscripcionCompetencias.js') }}"></script>

</x-app-layout>
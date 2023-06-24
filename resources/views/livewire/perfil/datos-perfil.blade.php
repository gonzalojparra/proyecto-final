<div>
    @switch($vista)
    @case(0)
    <h1 class="text-center text-2xl uppercase mb-5"> Tu Perfil </h1>
    <div class="text-center">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <div class="flex justify-between items-center">
                <x-label for="name" class="" value="{{ __('Nombre') }}" />
                <x-input id="name" type="text" class="mt-1 block w-3/4 border-none" value="{{$user->name}}" readonly />
            </div>
            <x-input-error for="name" class="mt-2" />
            <div id="nombreFeedback" class="input-feedback" for="name">&nbsp;</div>
        </div>

        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-4">
            <div class="flex justify-between items-center">
                <x-label for="apellido" class="" value="{{ __('Apellido') }}" />
                <x-input id="apellido" type="text" class="mt-1 block w-3/4" value="{{$user->apellido}}" require autocomplete="apellido" readonly />
            </div>
            <div id="apellidoFeedback" class="input-feedback" for="apellido">&nbsp;</div>
            <x-input-error for="apellido" class="mt-2" />
        </div>

        @if ($user->roles[0]->name =='Competidor' && $user->verificado == '1')
        <div class="col-span-6 sm:col-span-4">
            <div class="flex justify-between items-center">
                <x-label for="du" class="" value="{{ __('DU') }}" />
                <x-input id="du" type="text" class="mt-1 block w-3/4" min="1960-01-01" require autocomplete="du" readonly />
            </div>
            <div id="duFeedback" class="input-feedback" for="du">&nbsp;</div>
            <x-input-error for="du" class="mt-2" />
        </div>

        <!-- Nacimiento -->
        <div class="col-span-6 sm:col-span-4">
            <div class="flex justify-between items-center">
                <x-label for="fechaNacCompetidor" class="" value="{{ __('Fecha de nacimiento') }}" />
                <x-input id="fechaNacCompetidor" class="block mt-1 w-3/4" type="date" name="fechaNac" require autocomplete="fecha_nac" min="1960-01-01" readonly />
            </div>
            <div id="fechaNacFeedback" class="input-feedback" for="fechaNacCompetidor">&nbsp;</div>
            <x-input-error for="fechaNacCompetidor" class="mt-2" />
        </div>

        <!-- Genero -->
        <div class="col-span-6 sm:col-span-4">
            <div>Genero</div>
            <div class="checks flex justify-center" id="generoChecks" required>
                @if($user->genero === 'Femenino')
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino" checked>
                    <label class="form-check-label" for="femenino">
                        Femenino
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino" disabled>
                    <label class="form-check-label" for="masculino">
                        Masculino
                    </label>
                </div>
                @endif
                @if($user->genero === 'Masculino')
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino" disabled>
                    <label class="form-check-label" for="femenino">
                        Femenino
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino" checked>
                    <label class="form-check-label" for="masculino">
                        Masculino
                    </label>
                </div>
                @endif
                <div class="input-feedback" class="input-feedback" id="generoChecksFeedback" for="checks">&nbsp;</div>
                <x-input-error for="generoChecks" class="mt-2" />
            </div>
        </div>


        <!-- Graduacio -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="graduacion" class="" value="{{ __('Graduacion') }}" />
            <select disabled id="graduacion" class="block mt-1 w-full" type="text" name="graduacion" require  autocomplete="graduacion">
                <option>{{$this->user->graduacion}}</option>
                <option value="1 GUP, Rojo borde negro">1ro GUP</option>
                <option value="2 GUP, Rojo">2do GUP</option>
                <option value="3 GUP, Azul borde rojo">3ro GUP</option>
                <option value="4 GUP, Azul">4to GUP</option>
                <option value="5 GUP, Verde borde azul">5to GUP</option>
                <option value="6 GUP, Verde">6to GUP</option>
                <option value="7 GUP, Amarillo borde verde">7mo GUP</option>
                <option value="8 GUP, Amarillo">8vo GUP</option>
                <option value="9 GUP, Blanco borde amarillo">9no GUP</option>
                <option class="negro" value="10 GUP, Blanco">10mo GUP</option>
                <option class="negro" value="1 DAN, Negro">1er DAN</option>
                <option class="negro" value="2 DAN, Negro">2do DAN</option>
                <option class="negro" value="3 DAN, Negro">3er DAN</option>
                <option class="negro" value="4 DAN, Negro">4to DAN</option>
                <option class="negro" value="5 DAN, Negro">5to DAN</option>
                <option class="negro" value="6 DAN, Negro">6to DAN</option>
                <option class="negro" value="7 DAN, Negro">7mo DAN</option>
                <option class="negro" value="8 DAN, Negro">8vo DAN</option>
                <option class="negro" value="9 DAN, Negro">9no DAN</option>
            </select>
            <div id="graduacionFeedback" class="input-feedback" for="graduacionCompetidor">&nbsp;</div>
            <x-input-error for="graduacion" class="mt-2" />
        </div>



        <!-- GAL si es un cinturon negro -->
        @if($this->user->gal != null)
        <div id="cinturonNegro" class="col-span-6 sm:col-span-4">
            <x-label for="galCompetidor" class="" value="{{ __('GAL') }}" />
            <x-input id="galCompetidor" class="block mt-1 w-full" type="text" name="gal"  autocomplete="gal" require readonly />
            <div id="galFeedback" class="input-feedback" for="galCompetidor">&nbsp;</div>
            <x-input-error for="galCompetidor" class="mt-2" />
        </div>
        @endif

        @endif


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" class="" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" require autocomplete="email" readonly />
            <x-input-error for="email" class="mt-2" />
            <div id="emailFeedback" class="input-feedback" for="email">&nbsp;</div>
        </div>

        @if ($user->roles[0]->name == "Competidor")

        @endif


    </div>
    @break
    @case(1)
    <h1 class="text-center text-2xl uppercase mb-5"> Inscripciones a Competencias </h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if (count($incripciones) > 0)
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    ID
                </th>
                <th class="px-6 py-3">
                    Nombre
                </th>
                <th class="px-6 py-3">
                    Estado
                </th>
                <th class="px-6 py-3">
                    Fecha de Inscripcion
                </th>
            </thead>
            <tbody>
                @foreach ($incripciones as $inscripcion )
                <tr class="bg-white border-b p-4 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{$inscripcion->idCompentecia}}
                    </td>
                    <td class="px-6 py-4">
                        {{$inscripcion->nombreCompetencia}}
                    </td>
                    <td class="px-6 py-4">

                        @if ($inscripcion->estado === 0)
                        Solicitud en tramite
                        @else
                        Solicitud Aprobada
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{$inscripcion->fecha_inscripcion}}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-white">
        <h3>
            No se encuentran solicitudes
        </h3>
    </div>
    @endif
    @break
    @case(2)
    <h1 class="text-center text-2xl uppercase mb-5"> Competencia Finalizadas </h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if (count($competenciasFinalizadas) > 0)
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-6 py-3">
                    ID
                </th>
                <th class="px-6 py-3">
                    Nombre
                </th>
                <th class="px-6 py-3">
                    Estado
                </th>
                <th class="px-6 py-3">
                    Fecha de Inscripcion
                </th>
            </thead>
            <tbody>
                @foreach ($competenciasFinalizadas as $competencia )
                <tr class="bg-white border-b p-4 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{$competencia->idCompentecia}}
                    </td>
                    <td class="px-6 py-4">
                        {{$competencia->nombreCompetencia}}
                    </td>
                    <td class="px-6 py-4">

                        @if ($competencia->estado === 0)
                        Solicitud en tramite
                        @else
                        Solicitud Aprobada
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{$competencia->fecha_inscripcion}}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-white">
        <h3>
            No se encuentran solicitudes
        </h3>
    </div>
    @endif
    @break

    @default

    @endswitch

</div>
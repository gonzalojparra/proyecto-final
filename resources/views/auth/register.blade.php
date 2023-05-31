@section('title', 'Registro')

<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form id="formularioRegistro" method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="nombreUsuario" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <div id="nombreFeedback" class="input-feedback" for="nombreUsuario">&nbsp;</div>
            </div>

            <div>
                <x-label for="apellido" value="{{ __('Apellido') }}" />
                <x-input id="apellidoUsuario" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus autocomplete="apellido" />
                <div id="apellidoFeedback" class="input-feedback" for="apellidoUsuario">&nbsp;</div>
            </div>

            <div>
                <x-label for="escuela" value="{{ __('Escuela') }}" />
                <input id="escuelaUsuario" class="block mt-1 w-full" type="text" name="escuela" :value="old('escuela')" required autofocus autocomplete="escuela">
                <div id="escuelaFeedback" class="input-feedback" for="escuelaUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="emailUsuario" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <div id="emailFeedback" class="input-feedback" for="emailUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="contrasenia" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <div id="contraseniaFeedback" class="input-feedback" for="contrasenia">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirme su contraseña') }}" />
                <x-input id="contraseniaConfirmada" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <div id="contraseniaConfirmadaFeedback" class="input-feedback" for="contraseniaConfirmada">&nbsp;</div>
            </div>

            <div>
                <div>Tipo de cuenta requerida</div>
                <div class="checks" id="rolChecks" required>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="competidor" value="Competidor">
                        <label class="form-check-label" for="competidor">
                            Competidor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="juez" value="Juez">
                        <label class="form-check-label" for="juez">
                            Jurado
                        </label>
                    </div>
                </div>
                <div class="input-feedback" class="input-feedback" id="rolChecksFeedback" for="checks">&nbsp;</div>
            </div>

            <div id="formularioInscripcion">
                <div>
                    <x-label for="duCompetidor" value="{{ __('Documento') }}" />
                    <x-input id="duCompetidor" class="block mt-1 w-full" type="text" name="documento" :value="old('documento')" required autofocus autocomplete="documento" />
                    <div id="duFeedback" class="input-feedback" for="duCompetidor">&nbsp;</div>
                </div>

                <div>
                    <x-label for="fechaNacCompetidor" value="{{ __('Fecha de nacimiento') }}" />
                    <x-input id="fechaNacCompetidor" class="block mt-1 w-full" type="date" name="fechaNac" :value="old('fechaNac')" required autofocus autocomplete="fechaNac" />
                    <div id="fechaNacFeedback" class="input-feedback" for="fechaNacCompetidor">&nbsp;</div>
                </div>

                <div>
                    <div>Genero</div>
                    <div class="checks" id="generoChecks" required>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero" id="femenino" value="femenino">
                            <label class="form-check-label" for="femenino">
                                Femenino
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero" id="masculino" value="masculino">
                            <label class="form-check-label" for="masculino">
                                Masculino
                            </label>
                        </div>
                        <div class="input-feedback" class="input-feedback" id="generoChecksFeedback" for="checks">&nbsp;</div>
                    </div>

                </div>

                <div>
                    <x-label for="categoriaCompetidor" value="{{ __('Categoria') }}" />
                    <select id="categoriaCompetidor" class="block mt-1 w-full" type="text" name="categoria" :value="old('categoria')" required autofocus autocomplete="categoria">
                        <option value="">Seleccione una categoría</option>
                        <option value="Cadetes">Cadetes</option>
                        <option value="Juveniles">Juveniles</option>
                    </select>
                    <div id="categoriaFeedback" class="input-feedback" for="categoriaCompetidor">&nbsp;</div>

                </div>

                <div>
                    <x-label for="graduacionCompetidor" value="{{ __('Graduacion') }}" />
                    <select id="graduacionCompetidor" class="block mt-1 w-full" type="text" name="graduacion" :value="old('graduacion')" class="'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'" required autofocus autocomplete="graduacion">
                        <option value="">Seleccione una graduación</option>
                        <option value="1 GUP, Rojo borde negro">1ro GUP</option>
                        <option value="2 GUP, Rojo">2do GUP</option>
                        <option value="3 GUP, Azul borde rojo">3ro GUP</option>
                        <option value="4 GUP, Azul">4to GUP</option>
                        <option value="5 GUP, Verde borde azul">5to GUP</option>
                        <option value="6 GUP, Verde">6to GUP</option>
                        <option value="7 GUP, Amarillo borde verde">7mo GUP</option>
                        <option value="8 GUP, Amarillo">8vo GUP</option>
                        <option value="9 GUP, Blanco borde amarillo">9no GUP</option>
                        <option value="10 GUP, Blanco">10mo GUP</option>
                        <option value="1 DAN, Negro">1er DAN</option>
                        <option value="2 DAN, Negro">2do DAN</option>
                        <option value="3 DAN, Negro">3er DAN</option>
                        <option value="4 DAN, Negro">4to DAN</option>
                        <option value="5 DAN, Negro">5to DAN</option>
                        <option value="6 DAN, Negro">6to DAN</option>
                        <option value="7 DAN, Negro">7mo DAN</option>
                        <option value="8 DAN, Negro">8vo DAN</option>
                        <option value="9 DAN, Negro">9no DAN</option>
                    </select>
                    <div id="graduacionFeedback" class="input-feedback" for="graduacionCompetidor">&nbsp;</div>
                </div>

                <div id="cinturonNegro">
                    <x-label for="galCompetidor" value="{{ __('GAL') }}" />
                    <x-input id="galCompetidor" class="block mt-1 w-full" type="text" name="gal" :value="old('gal')" required autofocus autocomplete="gal" />
                    <div id="galFeedback" class="input-feedback" for="galCompetidor">&nbsp;</div>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <x-button class="ml-4" id="botonSubmit">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <script src="{{ asset('js/validacionesRegistro.js') }}"></script>

</x-app-layout>
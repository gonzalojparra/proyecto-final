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
                <div id="apellidoFeedback"  class="input-feedback"  for="apellidoUsuario">&nbsp;</div>
            </div>

            <div>
                <x-label for="escuela" value="{{ __('Escuela') }}" />
                <x-input id="escuelaUsuario" class="block mt-1 w-full" type="text" name="escuela" :value="old('escuela')" required autofocus autocomplete="escuela" />
                <div id="escuelaFeedback"  class="input-feedback"  for="escuelaUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="emailUsuario" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <div id="emailFeedback"  class="input-feedback"  for="emailUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="contrasenia" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <div id="contraseniaFeedback"  class="input-feedback"  for="contrasenia">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirme su contraseña') }}" />
                <x-input id="contraseniaConfirmada" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <div id="contraseniaConfirmadaFeedback"  class="input-feedback"  for="contraseniaConfirmada">&nbsp;</div>
            </div>

            <div>
                <div>Tipo de cuenta requerida</div>
                <div class="checks" id="checks" required>
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
                <div class="input-feedback"  class="input-feedback"  id="checksFeedback" for="checks">&nbsp;</div>
            </div>

            <div id="formularioInscripcion">
                <div>
                    <x-label for="duCompetidor" value="{{ __('Documento') }}" />
                    <x-input id="duCompetidor" class="block mt-1 w-full" type="text" name="documento" :value="old('documento')" required autofocus autocomplete="documento" />
                    <div id="duFeedback"  class="input-feedback"  for="duCompetidor">&nbsp;</div>
                </div>

                <div>
                    <x-label for="fechaNacCompetidor" value="{{ __('Fecha de nacimiento') }}" />
                    <x-input id="fechaNacCompetidor" class="block mt-1 w-full" type="date" name="fechaNac" :value="old('fechaNac')" required autofocus autocomplete="fechaNac" />
                    <div id="fechaNacFeedback"  class="input-feedback"  for="fechaNacCompetidor">&nbsp;</div>
                </div>

                <div>
                    <x-label for="categoriaCompetidor" value="{{ __('Categoria') }}" />
                    <select id="categoriaCompetidor" class="block mt-1 w-full" type="text" name="categoria" :value="old('categoria')" required autofocus autocomplete="categoria">
                        <option value="">Seleccione una categoría</option>
                        <option value="Cadetes">Cadetes</option>
                        <option value="Juveniles">Juveniles</option>
                    </select>
                    <div id="categoriaFeedback"  class="input-feedback"  for="categoriaCompetidor">&nbsp;</div>
                </div>

                <div >
                    <x-label for="graduacionCompetidor" value="{{ __('Graduacion') }}" />
                    <select id="graduacionCompetidor" class="block mt-1 w-full" type="text" name="graduacion" :value="old('graduacion')" class="'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'" required autofocus autocomplete="graduacion">
                        <option value="">Seleccione una graduación</option>
                        <option value="1ro GUP">1ro GUP</option>
                        <option value="2do GUP">2do GUP</option>
                        <option value="3ro GUP">3ro GUP</option>
                        <option value="4to GUP">4to GUP</option>
                        <option value="5to GUP">5to GUP</option>
                        <option value="6to GUP">6to GUP</option>
                        <option value="7mo GUP">7mo GUP</option>
                        <option value="8vo GUP">8vo GUP</option>
                        <option value="9no GUP">9no GUP</option>
                        <option value="10mo GUP">10mo GUP</option>
                        <option value="1er DAN">1er DAN</option>
                        <option value="2do DAN">2do DAN</option>
                        <option value="3er DAN">3er DAN</option>
                        <option value="4to DAN">4to DAN</option>
                        <option value="5to DAN">5to DAN</option>
                        <option value="6to DAN">6to DAN</option>
                        <option value="7mo DAN">7mo DAN</option>
                        <option value="8vo DAN">8vo DAN</option>
                        <option value="9no DAN">9no DAN</option>
                    </select>
                    <div id="graduacionFeedback"  class="input-feedback"  for="graduacionCompetidor">&nbsp;</div>
                </div>

                <div id="cinturonNegro">
                    <x-label for="galCompetidor" value="{{ __('GAL') }}" />
                    <x-input id="galCompetidor" class="block mt-1 w-full" type="text" name="gal" :value="old('gal')" required autofocus autocomplete="gal" />
                    <div id="galFeedback"  class="input-feedback"  for="galCompetidor">&nbsp;</div>
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" id="botonSubmit">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>

    <script src="{{ asset('js/validacionesRegistro.js') }}"></script>

</x-app-layout>
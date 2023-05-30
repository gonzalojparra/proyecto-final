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
                <div id="nombreFeedback" for="nombreUsuario">&nbsp;</div>
            </div>

            <div>
                <x-label for="apellido" value="{{ __('Apellido') }}" />
                <x-input id="apellidoUsuario" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autofocus autocomplete="apellido" />
                <div id="apellidoFeedback" for="apellidoUsuario">&nbsp;</div>
            </div>

            <div>
                <x-label for="escuela" value="{{ __('Escuela') }}" />
                <x-input id="escuelaUsuario" class="block mt-1 w-full" type="escuela" name="escuela" :value="old('escuela')" required autocomplete="escuela" />
                <div id="escuelaFeedback" for="escuelaUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="emailUsuario" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <div id="emailFeedback" for="emailUsuario">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="contrasenia" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <div id="contraseniaFeedback" for="contrasenia">&nbsp;</div>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirme su contraseña') }}" />
                <x-input id="contraseniaConfirmada" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <div id="contraseniaConfirmadaFeedback" for="contraseniaConfirmada">&nbsp;</div>
            </div>

            <div>
                <div>Tipo de cuenta requerida</div>
                <div class="input-feedback" id="checksFeedback" for="checks">&nbsp;</div>
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
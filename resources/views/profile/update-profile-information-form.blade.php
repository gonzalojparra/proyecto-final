<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <span class="text-slate-100 text-md">{{ __('Información del perfil') }}</span>
    </x-slot>

    <x-slot name="description" class="text-white">
        <span class="text-slate-200 text-md">{{ __('Actualiza la información de tu perfil') }}</span>
        <x-section-border />
        <!-- Perfil -->
        <div class="col-span-6">
            <x-label />
            <img class="ml-3 w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">
            <div class="flex items-center mt-2">
                
                <div class="ml-4 leading-tight">
                    <div class="text-gray-100 text-md">{{ $this->user->name }} {{$this->user->apellido}}</div>
                    <div class="text-gray-100 text-md">{{ $this->user->email }}</div>
                    @role('Competidor')
                    <div class="text-gray-100 text-md">{{ $this->user->du }}</div>
                    <div class="text-gray-100 text-md">{{ $this->user->fecha_nac }}</div>
                    <div class="text-gray-100 text-md">{{ $this->user->genero }}</div>
                    <div class="text-gray-100 text-md">{{ $this->user->graduacion }}</div>
                    @if($this->user->gal != null)
                    <div class="text-gray-100 text-md">{{ $this->user->gal }}</div>
                    @endif
                    @endrole
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="form">

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Nombre') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" require wire:model.defer="state.name" autocomplete="name" />
            <div id="nameFeedback" class="input-feedback" for="name">&nbsp;</div>
            <x-input-error for="name" class="mt-2" />

        </div>

        <!-- Apellido -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido" value="{{ __('Apellido') }}" />
            <x-input id="apellido" type="text" class="mt-1 block w-full" require wire:model.defer="state.apellido" autocomplete="apellido" />
            <div id="apellidoFeedback" class="input-feedback" for="apellido">&nbsp;</div>
            <x-input-error for="apellido" class="mt-2" />
        </div>

        @role('Juez')
        <!-- Escuelas -->
        <!-- Team Name SI PONIA EL FOREACH DEL REGISTRO ME SALTABA UN ERROR -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="escuela" value="{{ __('Escuela') }}" />
            <select id="escuelaUsuario" name="escuela" class="block mt-1 w-full" required autofocus autocomplete="escuela" wire:model.defer="state.escuela">
                <option value="escuela">{{$this->user->nombre}}</option>
            </select>
            <div id="escuelaFeedback" class="input-feedback" for="escuelaUsuario">&nbsp;</div>
            <x-input-error for="escuela" class="mt-2" />
        </div>
        @endrole

        @role('Competidor')
        <!-- Escuelas -->
        <!-- Team Name SI PONIA EL FOREACH DEL REGISTRO ME SALTABA UN ERROR-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="escuela" value="{{ __('Escuela') }}" />
            <select id="escuelaUsuario" name="escuela" class="block mt-1 w-full" required autofocus autocomplete="escuela" wire:model.defer="state.escuela">
                <option value="escuela"></option>
            </select>
            <div id="escuelaFeedback" class="input-feedback" for="escuelaUsuario">&nbsp;</div>
            <x-input-error for="escuela" class="mt-2" />
        </div>

        <!-- DU -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="du" value="{{ __('DU') }}" />
            <x-input id="du" type="text" class="mt-1 block w-full" require wire:model.defer="state.du" autocomplete="du" />
            <div id="du" class="input-feedback" for="du">&nbsp;</div>
            <x-input-error for="du" class="mt-2" />
        </div>

        <!-- Nacimiento -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="fechaNacCompetidor" value="{{ __('Fecha de nacimiento') }}" />
            <x-input id="fechaNacCompetidor" class="block mt-1 w-full" type="date" name="fechaNac" require :value="old('fecha_nac')" wire:model.defer="state.fecha_nac" autocomplete="fecha_nac" min="1960-01-01" />
            <div id="fechaNacFeedback" class="input-feedback" for="fechaNacCompetidor">&nbsp;</div>
            <x-input-error for="fechaNacCompetidor" class="mt-2" />
        </div>

        <!-- Genero -->
        <div class="col-span-6 sm:col-span-4">
            <div>Genero</div>
            <div class="checks" id="generoChecks" required>
                <div class="form-check">
                    @if($this->user->genero === 'Femenino')
                    <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino" checked>
                    <label class="form-check-label" for="femenino">
                        Femenino
                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino">
                        <label class="form-check-label" for="masculino">
                            Masculino
                        </label>
                    </div>
                    @endif
                </div>
                <div class="form-check">
                    @if($this->user->genero === 'Masculino')
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino">
                        <label class="form-check-label" for="femenino">
                            Femenino
                        </label>
                    </div>
                    <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino" checked>
                    <label class="form-check-label" for="masculino">
                        Masculino
                    </label>
                    @endif
                </div>
                <div class="input-feedback" class="input-feedback" id="generoChecksFeedback" for="checks">&nbsp;</div>
                <x-input-error for="generoChecks" class="mt-2" />
            </div>
        </div>


        <!-- Graduacio -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="graduacion" value="{{ __('Graduacion') }}" />
            <select id="graduacion" class="block mt-1 w-full" type="text" name="graduacion" wire:model.defer="state.graduacion" require :value="old('graduacion')" autocomplete="graduacion">
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
            <x-input-error for="graduacion" class="mt-2" />
        </div>

        <!-- GAL si es un cinturon negro -->
        @if($this->user->gal != null)
        <div id="cinturonNegro"  class="col-span-6 sm:col-span-4">
            <x-label for="galCompetidor" value="{{ __('GAL') }}" />
            <x-input id="galCompetidor" class="block mt-1 w-full" type="text" name="gal" :value="old('gal')" autocomplete="gal" wire:model.defer="state.gal" require />
            <div id="galFeedback" class="input-feedback" for="galCompetidor">&nbsp;</div>
            <x-input-error for="galCompetidor" class="mt-2" />
        </div>
        @endif

        @endrole

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" require wire:model.defer="state.email" autocomplete="email" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Tu dirección email no está verificada.') }}

                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                    {{ __('Clickea aquí para reenvíar la confirmación') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __('Un nuevo link de verificación se ha enviado a su correo!') }}
            </p>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="close cursor-pointer rounded flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" role="alert" on="saved">
            {{ __('Guardado.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-button>
    </x-slot>
</x-form-section>
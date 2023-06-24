<div>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/pantallaEspera.css') }}">
    <div class="contenedor">
        @if ($pasada == null || $esJuez == false)
        <div class="pulsador">
            <div class="titulo">
                <button class="traer-pasada" id="traer-pasada" wire:click="traerPasada" wire:after="traerBotones">Traer pasada</button>
            </div>
            @if ($alerta != null)
            <div class="mensaje-error">
                {{$alerta}}
            </div>
            @endif
        </div>
        @else
        <div class="pulsador">
            <!-- En titulo va la variable $tipoPresentacion o algo asi donde vaya el titulo correspondiente del pulsador (Exactitud o Presentacion) -->
            <div class="titulo">
                @if ($tipoPuntaje == 1)
                Exactitud
                @else
                Presentacion
                @endif
            </div>
            <div class="puntaje-pulsadores">
                <div class="boton-izquierdo">
                    <div class="toggle">
                        <input type="button" id="botonUno" class="button" wire:click="resto1()">
                        <span class="button"><span class="label">-0.1</span></span>
                    </div>
                </div>
                <div class="puntaje-boton">
                    <div class="puntaje">{{$puntaje}}</div>
                    <div class="boton-enviar">&nbsp;
                        {{-- <input id="botonEnviar" type="button" class="enviar" wire:click="enviar()"> --}}
                        <span class="label">
                            @if ($tipoPuntaje == 1)
                            <input id="botonEnviar" type="button" class="enviar" wire:click="enviar()" value='siguiente'>
                            @else
                            <input id="botonEnviar" type="button" class="enviar" wire:click="enviar()" value='enviar'>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="boton-derecho">
                    <div class="toggle">
                        <input type="button" id="botonTres" class="button" wire:click="resto3()">
                        <span class="button"> <span class="label">-0.3</span></span>
                    </div>
                </div>
            </div>
            <div class="info-ronda">
                <div class="nombre-competidor">{{$pasada->user->name}} {{$pasada->user->apellido}}</div>
                <div class="separa-info">|</div>
                <div class="numero-ronda">Pasada {{$pasada->ronda}}</div>
                <div class="separa-info">|</div>
                <div class="info-poomsae">{{$pasada->poomsae->nombre}}</div>

            </div>
        </div>
        @endif

        <div class="no-celular">
            <div class="titulo">ERROR</div>
            <div class="mensaje-error">
                Por favor, utilice un teléfono movil <br>
                de manera horizontal para acceder al pulsador
            </div>
        </div>
    </div>


    @if($mostrarModalEspera)
    <div>
        <div class="pantallaEspera">
            <div class="texto">
                <p>Esperando el resto de los votos...</p>
            </div>
            <input id="botonChequear" type="button" wire:click="algo()" value='Chequear'>
            <div class="no-celular">
                <h1>ERROR</h1>
                <h1>No disponible de forma vertical</h1>
            </div>
            <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
                <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
                <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
                <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
                <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
            </svg>

        </div>


    </div>
    @endif
</div>
<script src="{{ asset('js/puntuador.js') }}"></script>
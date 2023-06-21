<div>
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
    <!-- Ver de hacer alguna segunda confirmacion de que se va a saltar el competidor -->
</div>

<script src="{{ asset('js/puntuador.js') }}"></script>
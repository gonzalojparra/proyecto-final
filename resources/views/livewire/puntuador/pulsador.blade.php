<div>
    <div class="contenedor">
        @if ($pasada == null)
            <div class="pulsador">
                <div class="titulo"><button wire:click='traerPasada'>Traer pasada</button></div>
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
                        <input type="button" class="button" wire:click="resto1()">
                        <span class="button"><span class="label">-0.1</span></span>
                    </div>
                </div>
                <div class="puntaje-boton">
                    <div class="puntaje">{{$puntaje}}</div>
                    <div class="boton-enviar">&nbsp;
                        <button class="enviar" wire:click="enviar()">
                            @if ($tipoPuntaje == 1)
                            Siguiente
                            @else
                            Enviar
                            @endif
                        </button>
                    </div>
                </div>
                <div class="boton-derecho">
                    <div class="toggle">
                        <input type="button" class="button" wire:click="resto3()">
                        <span class="button"> <span class="label">-0.3</span></span>

                    </div>
                </div>
            </div>
            <div class="info-ronda">
                <div class="nombre-competidor">{{$pasada->user->name}} {{$pasada->user->apellido}}</div>
                <div class="separa-info">-</div>
                <div class="numero-ronda">RONDA {{$pasada->ronda}}</div>
                <div class="separa-info">-</div>
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
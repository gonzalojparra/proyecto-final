<div>
    <div class="contenedor">
        <div class="pulsador">
            <!-- En titulo va la variable $tipoPresentacion o algo asi donde vaya el titulo correspondiente del pulsador (Exactitud o Presentacion) -->
            <div class="titulo">Exactitud</div>
            <div class="puntaje-pulsadores">
                <div class="boton-izquierdo">
                    <div class="toggle">
                        <input type="button" class="button" wire:click="deducirUno">
                        <span class="button"><span class="label">-0.1</span></span>
                    </div>
                </div>
                <div class="puntaje-boton">
                    <div class="puntaje">{{$puntaje}}</div>
                    <div class="boton-enviar">&nbsp;
                        <!-- Este botón lleva una variable $botonEnviar que modifique el texto al que corresponda (saltar competidor o enviar) -->
                        <button class="enviar">
                            Saltar competidor
                        </button>
                    </div>
                </div>
                <div class="boton-derecho">
                    <div class="toggle">
                        <input type="button" class="button" wire:click="deducirTres">
                        <span class="button"> <span class="label">-0.3</span></span>

                    </div>
                </div>
            </div>
            <div class="info-ronda">
                <div class="nombre-competidor">Daniela Rodriguez</div>
                <div class="separa-info">-</div>
                <div class="numero-ronda">RONDA 1</div>
                <div class="separa-info">-</div>
                <div class="info-poomsae">TAEBECK</div>

            </div>
        </div>
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
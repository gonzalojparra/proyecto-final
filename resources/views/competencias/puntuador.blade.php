<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntuador</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="stylesheet" href="{{ asset('css/estilosPuntuador.css') }}">
</head>

<body class="puntuador-body">
    <div class="puntuador">
        <div class="botones">
            <div id="uno" class="boton-deduccion">
                <button type="button" class="boton-puntuador">
                    <span class="deduccion">-0.1</span>
                </button>
            </div>
            <div id="tres" class="boton-deduccion">
                <button type="button" class="boton-puntuador">
                    <span class="deduccion">-0.3</span>
                </button>
            </div>
        </div>

        <div class="div-puntaje">

            <div class="ver-puntaje">
                <h1 class="puntaje"></h1>
            </div>
        </div>
        <div class="acciones">
            <div class="enviar">
                <button type="button" class="boton-envio">
                    Enviar
                </button>
            </div>
        </div>
    </div>

    <div class="pantalla-grande">
        <div class="div-mensaje">
            <div class="mensaje">
                <h1>UTILICE SU TELEFONO PARA ESTA VISTA</h1>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/puntuador.js') }}"></script>

</html>
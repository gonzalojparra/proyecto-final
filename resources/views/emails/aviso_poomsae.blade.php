<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla de correo electrónico</title>
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.4;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: 30em;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        /* Estilos específicos para dispositivos móviles */
        @media (max-width: 480px) {
            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://www.shutterstock.com/image-vector/korean-traditional-martial-arts-taekwondo-260nw-1435199405.jpg" alt="Cabecera del correo electrónico">
        </div>
        <h1>Estimado/a {{$apellido}}, {{$nombre}}</h1>,

       <p>¡Es un placer comunicarte que los poomsaes que se te asignaron para la competencia <i>{{$nombreCompetencia}}</i> , ya estan visibles en la pagina de la competencia.</p>

       <p>No Cuelgues en fijarte</p>

       <p>Si necesitas más información o si tienes alguna pregunta adicional, no dudes en comunicarte con nosotros. Estamos disponibles para asistirte en todo momento.</p>

       <p>¡Bienvenido/a al equipo de <b>Zen Kicks</b>!</p>

       <p>Atentamente,</p>

       <p>Administración</p>

       <h3>Zen Kicks</h3>
    </div>
</body>

</html>
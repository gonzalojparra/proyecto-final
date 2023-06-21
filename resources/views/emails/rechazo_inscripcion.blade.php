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
        <h2> Estimado/a {{$apellido}}, {{$nombre}}, </h2>

        <img src="https://img.freepik.com/iconos-gratis/triste_318-145569.jpg?w=2000" style="width: 200px; float: right; margin: 1em;" alt="">
        <p>Esperamos que este mensaje te encuentre bien. Queremos informarte que hemos revisado tu solicitud de inscripción para la competencia {{$nombreCompetencia}}, y lamentablemente debemos informarte que tu solicitud ha sido rechazada.</p>

        <p>Entendemos que esto puede ser decepcionante para ti, y te aseguramos que hemos considerado cuidadosamente todas las solicitudes recibidas.</p>

        <p>Los motivos pueden ser:
        <ul>
            <li>
                <i>Nombre de Escuela Invalido. </i>
            </li>
            <li>
                <i>Graduaccion Invalida. </i>
            </li>
            <li>
                <i>No encontrarse en los padrones. </i>
            </li>
            <li>
                <i>Si solicito alguna modificacion y no fue aceptada. </i>
            </li>
        </ul>
        <p>Sin embargo, debido a, no podemos aceptar tu participación en esta ocasión.</p>

        <p>Queremos agradecerte por tu interés en la competencia y tu dedicación para presentar tu solicitud. Valoramos tu entusiasmo y esfuerzo, y esperamos que sigas participando en futuros eventos y competencias organizadas por nosotros.</p>

        <p>Si tienes alguna pregunta o necesitas más información sobre los motivos específicos del rechazo de tu solicitud, no dudes en ponerte en contacto con nuestro equipo de soporte. Estaremos encantados de brindarte más detalles y ayudarte en todo lo posible.</p>

        <p>Una vez más, lamentamos mucho que tu solicitud haya sido rechazada, y esperamos verte nuevamente en futuras oportunidades.</p>

        <p>De no ser asi, envie nuevamete la solicitud y/o comuniquese con su profesor</p>

        <p>Atentamente,</p>

        <h4>Zen Kicks</h4>
    </div>
</body>

</html>
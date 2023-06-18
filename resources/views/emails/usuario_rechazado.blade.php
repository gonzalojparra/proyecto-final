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

        <h1>Estimado/a {{$apellido}}, {{$nombre}}</h1>

        <p>Espero que este mensaje te encuentre bien. Queremos agradecerte sinceramente por habernos presentado tu solicitud @if (isset($rol)) para <big><b>{{$rol}}</b></big> @endif . Valoramos tu entusiasmo y dedicación por formar parte de este equipo.</p>

        <p>Lamentablemente, después de una cuidadosa evaluación de todas las solicitudes recibidas, hemos tomado la difícil decisión de no seleccionarte como participante en esta ocasión. Queremos que sepas que tu solicitud fue considerada minuciosamente y apreciamos el tiempo y esfuerzo que invertiste en presentarla.</p>

        <p>Entendemos que esta noticia puede resultar decepcionante, pero te animamos a seguir buscando nuevas oportunidades. Tu experiencia y habilidades son valiosas, y estamos seguros de que encontrarás el camino adecuado para lograr tus metas.</p>

        <p>Apreciamos tu pasión y dedicación por <b>Zen Kicks</b>. Te animamos a seguir trabajando en tu área de interés y a participar en futuras oportunidades que puedan surgir. Cada experiencia es una oportunidad para aprender y crecer, y estamos seguros de que encontrarás el camino adecuado para alcanzar tus metas.</p>

        <p>Nos gustaría agradecerte nuevamente por haber mostrado interés en nuestro sitio. Valoramos tu participación y te deseamos mucho éxito en tus futuros proyectos y en todas tus actividades relacionadas con <b>Poonsae</b>.</p>

        <p>Si tienes alguna pregunta o si necesitas más información, no dudes en contactarnos. Estamos aquí para apoyarte en lo que podamos.</p>

        <p>Gracias por tu comprensión y por ser parte de nuestra comunidad. Te deseamos lo mejor en tus futuras participaciones en competencias y eventos.</p>

        <p>Atentamente,</p>

        <p>Administracion</p>
        
        <h3>Zen Kicks</h3>
    </div>
</body>

</html>
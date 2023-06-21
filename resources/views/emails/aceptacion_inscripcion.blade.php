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
        <h1>Estimado/a {{$apellido}}, {{$nombre}}</h1>

       <p>¡Es un placer comunicarte que tu solicitud para la competencia <b>{{$nombreCompetencia}}</b> ha sido aceptada! Queremos felicitarte y darte la bienvenida a <b>Zen Kicks</b>.</p>

       </p>A continuación, compartimos algunos detalles importantes:</p>

       <p><i>Por este medio se te notificaran las novedades, tanto de tu perfil como de competencias</i></p>
       
       <p>Te pedimos que revises detenidamente toda la información y sigas las instrucciones proporcionadas. Si tienes alguna pregunta o necesitas aclaraciones, no dudes en contactarnos. Estamos aquí para ayudarte y brindarte el apoyo que necesites.</p>

       <p>Esperamos verte en <b>Zen Kicks</b> y deseamos que disfrutes de esta experiencia. No dudes en aprovechar al máximo esta oportunidad y compartir tus conocimientos con otros participantes. ¡Estamos seguros de que será una experiencia enriquecedora!</p>

       <p>Una vez más, felicitaciones por ser seleccionado/a. Nos entusiasma trabajar contigo y esperamos una colaboración fructífera.</p>

       <p>Si necesitas más información o si tienes alguna pregunta adicional, no dudes en comunicarte con nosotros. Estamos disponibles para asistirte en todo momento.</p>

       <p>¡Bienvenido/a al equipo de <b>Zen Kicks</b>!</p>

       <p>Atentamente,</p>

       <p>Administración</p>

       <h3>Zen Kicks</h3>
    </div>
</body>

</html>
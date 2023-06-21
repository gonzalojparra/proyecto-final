<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pantalla Espera</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@livewireStyles

	<link rel="stylesheet" href="{{ asset('css/pantallaEspera.css') }}">
</head>

<body>
	<div>

		<div class="pantallaEspera">
			<svg class="pl" width="240" height="240" viewBox="0 0 240 240">
				<circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
				<circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
				<circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
				<circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
			</svg>

		</div>
		<div class="texto">
			<p>Esperando el resto de los votos...</p>
		</div>
		<div class="no-celular">
			<h1>ERROR</h1>
			<h1>No disponible de forma vertical</h1>
		</div>

	</div>
	<script>
		// Esperar 5 segundos antes de redirigir
		setTimeout(function() {
			window.location.href = '/pulsador/1?tipoPuntaje={{ $tipoPuntaje }}'; // Reemplaza '/pulsador' con la URL de tu página de pulsador
		}, 5000);
	</script>

</body>

</html>
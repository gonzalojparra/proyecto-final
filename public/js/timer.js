// Obtenemos los elementos desde el HTML
let timerElement = document.getElementById("countdown");
let btnIniciar = document.getElementById("btnIniciar");
let btnDetener = document.getElementById("btnDetener");
let btnReiniciar = document.getElementById("btnReiniciar");
let contador = document.getElementById("contador");
let pasadas = document.querySelectorAll('.pasada');
let selectPasada = document.getElementById('select-pasada');

// Variables
let tiempo = 90;
let tiempoTotal = 0;
let temporizador;

// Métodos
function iniciar() {
  Array.from(pasadas).forEach((pasada) => {
    selectPasada.addEventListener('change', function (e) {
      const pasadaSeleccionada = e.target.value;
      //console.log('Pasada seleccionada: ', pasadaSeleccionada);
      seleccion(pasadaSeleccionada);
    });
  });
}

function seleccion(idPasada) {
  //console.log('Llamando API: seleccion. Id: ', idPasada);
  const url = `/api/seleccion/${idPasada}`;
  fetch(url)
    .then(response => response.text())
    .then(data => {
      //console.log('Respuestas de la API:', data);
    })
    .catch(error => {
      console.error('Error API:', error);
    });
}

function iniciarTimer(idPasada) {
  temporizador = setInterval(actualizarContador, 1000);
  const url = `/api/iniciarTimer/${idPasada}`;
  fetch(url, {
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    method: 'POST',
    body: JSON.stringify({ idPasada }),
  })
    .then(res => res.json())
    .then(json => {
      console.log(json);
      if (json == 1) {
        //console.log('Timer iniciado - ID Pasada:', idPasada);
        // Cambio estilos al boton iniciar
        btnIniciar.disabled = true;
        btnIniciar.classList.remove('bg-green-500', 'hover:bg-green-600');
        btnIniciar.classList.add('bg-gray-500');
        // Cambio estilos al boton detener
        btnDetener.disabled = false;
        btnDetener.classList.remove('bg-gray-500');
        btnDetener.classList.add('bg-red-500', 'hover:bg-red-600');

        contador.innerHTML = '&nbsp;';
      }
    })
    .catch(err => console.log(err));
}

const actualizarContador = () => {
  tiempo--;
  if (tiempo <= 0) {
    if (tiempo === 0) {
      // Overtime
      timerElement.style.color = 'red';
      timerElement.innerHTML = Math.abs(tiempo);
    } else {
      timerElement.innerHTML = Math.abs(tiempo);
    }
    // Tiempo normal
  } else {
    timerElement.innerHTML = tiempo;
  }
  tiempoTotal = 90 - tiempo;
};

function detenerTimer(idPasada) {
  const url = `/api/pararTimer/${idPasada}`;
  fetch(url)
    .then(response => response.json())
    .then(json => {
      //console.log(`Se paró el timer, bandera: ${json}`);
      clearInterval(temporizador);

      btnDetener.classList.remove('hover:bg-red-600');
      btnDetener.disabled = true;
      btnDetener.classList.remove('bg-red-500', 'hover:bg-red-600');
      btnDetener.classList.add('bg-gray-500');

      btnReiniciar.disabled = false;
      btnReiniciar.classList.remove('bg-gray-500');
      btnReiniciar.classList.add('bg-yellow-500', 'hover:bg-yellow-600');

      contador.style.display = 'block';
      contador.style.color = tiempoTotal > 90 ? 'red' : 'black';
      contador.innerHTML = `Tiempo guardado con: ${tiempoTotal} seg`;

      enviarDatos(idPasada);
    })
    .catch(err => console.error(err));
}

function enviarDatos(idPasada) {
  const url = `/api/enviarTiempo/${tiempoTotal}.${idPasada}`;
  fetch(url)
    .then(response => response.json())
    .then(json => {
      console.log(`Se envio el dato, bandera: ${json}`);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

// Eventos
btnIniciar.addEventListener('click', () => {
  const pasadaSeleccionada = document.querySelector('.pasada:checked');
  if (pasadaSeleccionada) {
    const idPasada = pasadaSeleccionada.value;
    iniciarTimer(idPasada);
  }
});

btnDetener.addEventListener('click', () => {
  const pasadaSeleccionada = document.querySelector('.pasada:checked');
  if (pasadaSeleccionada) {
    const idPasada = pasadaSeleccionada.value;
    detenerTimer(idPasada);
  }
});

btnReiniciar.addEventListener('click', () => {
  window.location.reload();
});

// Llamo al método después de definirlo
iniciar();
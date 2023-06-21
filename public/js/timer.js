// Obtenemos los elementos desde el HTML
let timerElement = document.getElementById("countdown");
let btnIniciar = document.getElementById("btnIniciar");
let btnDetener = document.getElementById("btnDetener");
let btnReiniciar = document.getElementById("btnReiniciar");
let contador = document.getElementById("contador");
let pasadas = document.querySelectorAll('.pasada');
let selectPasada = document.getElementById('select-pasada');

// Seteamos el timer con una duracion de 90 segundos
let tiempo = 90;
let tiempoTotal = 0;

document.addEventListener('DOMContentLoaded', function () {
  iniciar();
});

function iniciar() {
  Array.from(pasadas).forEach((pasada) => {
    clickear(selectPasada);
  })
};

function clickear(pasada) {
  pasada.addEventListener('change', function (e) {
    let pasadaSeleccionada = e.target.value;
    iniciarTimer(pasadaSeleccionada);
    detenerTimer(pasadaSeleccionada);
    seleccion(pasadaSeleccionada);
  })
};

function seleccion(idPasada) {
  let url = `/api/seleccion/${idPasada}`;
  fetch(url)
    .then(response => response.text())
    .then(json => console.log(json))
    .catch(error => console.error('Error:', error));
}

let temporizador;

function iniciarTimer(idPasada) {
  btnIniciar.addEventListener('click', async function () {
    if (temporizador) {
      console.log('Timer already running');
      return; // If a timer is already running, exit the function
    }
    let url = `/api/iniciarTimer/${idPasada}`;
    await fetch(url, {
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
          console.log('Timer iniciado - ID Pasada: ', idPasada);
          temporizador = setInterval(actualizarContador, 1000);
          // Cambiamos estilos a boton iniciar
          btnIniciar.setAttribute('disabled')
          btnIniciar.classList.remove('bg-green-500')
          btnIniciar.classList.remove('hover:bg-green-600')
          btnIniciar.classList.add('bg-gray-500')
          // Cambiamos estilos a boton detener
          btnDetener.removeAttribute('disabled')
          btnDetener.classList.remove('bg-gray-500')
          btnDetener.classList.add('bg-red-500')
          btnDetener.classList.add('hover:bg-red-600')

          contador.innerHTML = '&nbsp;'
        }
      })
      .catch(err => console.log(err));
  });
};

const actualizarContador = () => {
  tiempo--;
  if (tiempo <= 0) {
    if (tiempo === 0) {
      // overtime
      timerElement.style.color = 'red';
      timerElement.innerHTML = Math.abs(tiempo);
    } else {
      timerElement.innerHTML = Math.abs(tiempo);
    }
    // tiempo normal
  } else {
    timerElement.innerHTML = tiempo;
  }
  tiempoTotal = 90 - tiempo;
};

function detenerTimer(idPasada) {
  btnDetener.addEventListener('click', async () => {
    let url = `/api/pararTimer/${idPasada}`;
    try {
      const response = await fetch(url);
      const json = await response.json();
      console.log(json);
      clearInterval(temporizador);

      btnDetener.classList.remove('hover:bg-red-600');
      btnDetener.setAttribute('disabled', 'disabled'); // Set the disabled attribute
      btnDetener.classList.remove('bg-red-500');
      btnDetener.classList.remove('hover:bg-red-600');
      btnDetener.classList.add('bg-gray-500');

      btnReiniciar.removeAttribute('disabled'); // Remove the disabled attribute
      btnReiniciar.classList.remove('bg-gray-500');
      btnReiniciar.classList.add('bg-yellow-500');
      btnReiniciar.classList.add('hover:bg-yellow-600');

      contador.style.display = 'block';
      if (tiempoTotal > 90) {
        contador.style.color = 'red';
        contador.innerHTML = `Tiempo guardado con: ${tiempoTotal} seg`;
      } else {
        contador.style.color = 'black';
        contador.innerHTML = `Tiempo guardado con: ${tiempoTotal} seg`;
      }

      enviarDatos(idPasada);
    } catch (err) {
      console.error(err);
    }
  });
}

btnReiniciar.addEventListener('click', () => {
  window.location.reload()
});


function enviarDatos(idPasada) {
  let url = `/api/enviarTiempo/${tiempoTotal}.${idPasada}`;
  fetch(url)
    .then(response => response.json())
    .then(json => {
      console.log(json)
    })
    .catch(error => {
      console.error('Error:', error);
    });
};




/*// Temporizador en segundos
    var seconds = 90;

    // Función para actualizar el temporizador
    function updateCountdown() {
      var countdownElement = document.getElementById("countdown");
      countdownElement.textContent = seconds;

      if (seconds > 0) {
        seconds--;
        setTimeout(updateCountdown, 1000);
      }
    }

    // Iniciar el temporizador al cargar la página
    window.onload = function () {
      updateCountdown();
    };*/ 
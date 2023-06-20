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
let temporizador;
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
  })
};

function iniciarTimer(idPasada) {
  btnIniciar.addEventListener('click', async function () {
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
        if (json == 1) {
          console.log('Timer iniciado - ID Pasada: ', idPasada);
          temporizador = setInterval(actualizarContador, 1000);
          btnIniciar.setAttribute('disabled')
          btnIniciar.classList.remove('hover:bg-green-600')
          btnDetener.removeAttribute('disabled')
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
      timerElement.innerHTML = `${Math.abs(tiempo)} `;

    }
    else {
      timerElement.innerHTML = `${Math.abs(tiempo)} `;

    }
    // tiempo normal
  } else {
    timerElement.innerHTML = `${tiempo}`;


  }
  tiempoTotal = 90 - tiempo;

};

btnDetener.addEventListener('click', () => {
  clearInterval(temporizador);
  btnDetener.setAttribute('disabled')
  btnDetener.classList.remove('hover:bg-red-600')

  btnIniciar.removeAttribute('disabled')
  btnIniciar.classList.add('hover:bg-green-600')

  contador.style.display = 'block'

  if (tiempoTotal > 90) {
    contador.style.color = 'red'
    contador.innerHTML = `Tiempo Total: ${tiempoTotal} seg`;

  }
  else {
    contador.style.color = 'black'
    contador.innerHTML = `Tiempo Total: ${tiempoTotal} seg`;
  }

});

btnReiniciar.addEventListener('click', () => {
  window.location.reload()
});

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
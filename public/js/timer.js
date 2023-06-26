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
      seleccion(pasadaSeleccionada);
    });
  });
}

function seleccion(idPasada) {
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
      if (json == 1) {
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
      //console.log(`Se envio el dato, bandera: ${json}`);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

async function cargarPasadas() {
  const selectedCategoria = document.getElementById('select-categoria').value;
  const selectPasada = document.getElementById('select-pasada');
  selectPasada.innerHTML = '<option selected disabled>Cargando pasadas...</option>';

  if (selectedCategoria === 'Elegi la categoría') {
    selectPasada.innerHTML = '<option selected disabled>Elegi la pasada</option>';
    return;
  }

  try {
    const response = await fetch(`/api/get-pasadas/${selectedCategoria}`);
    if (!response.ok) {
      throw new Error('Error al buscar pasadas');
    }
    const pasadas = await response.json();
    let options = '<option selected disabled>Elegi la pasada</option>';

    for (let i = 0; i < pasadas.length; i++) {
      const competidorId = pasadas[i].id_competidor;
      let url = `/api/get-competidor/${competidorId}`
      const competidorResponse = await fetch(url);
      if (!competidorResponse.ok) {
        throw new Error('Error al buscar competidor');
      }
      const competidor = await competidorResponse.json();
      const competidorName = competidor ? competidor.name : '';

      options += `<option class="pasada" value="${pasadas[i].id}">${competidorName} | Pasada ${pasadas[i].ronda}</option>`;
    }

    selectPasada.innerHTML = options;
    iniciar();
  } catch (error) {
    console.error(error);
  }
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
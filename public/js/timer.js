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
const intervalIDs = [];

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
      intervalIDs.forEach(intervalID => clearInterval(intervalID));

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

  const idCompetencia = window.location.pathname.split('/').pop();

  try {
    const response = await fetch(`/api/get-pasadas/${idCompetencia}/${selectedCategoria}`);
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
      console.log(competidor);
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
    generateDynamicTable();
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
  intervalIDs.forEach((intervalID) => clearInterval(intervalID));
  window.location.reload();
});

window.livewire.on('mostrarResultados', (resultados, newTabUrl) => {
  window.open(newTabUrl, '_blank');
});


async function fetchAndUpdatePuntaje(rowData, idJuez, idPasada) {
  const url = `/api/get-puntajes/${idJuez}/${idPasada}`;
  const puntajeResponse = await fetch(url);
  if (!puntajeResponse.ok) {
    throw new Error('Error al buscar puntajes');
  }
  const puntajes = await puntajeResponse.json();
  console.log('puntajes:', puntajes);

  // Se actualiza solo si puntaje_exactitud y puntaje_presentacion están disponibles en la respuesta de la API
  if (puntajes.puntaje_exactitud !== undefined) {
    rowData.puntajeExactitud = puntajes.puntaje_exactitud;
  }

  if (puntajes.puntaje_presentacion !== undefined) {
    rowData.puntajePresentacion = puntajes.puntaje_presentacion;
  }

  const puntajeExactitudCell = document.querySelector(`#row-${idJuez} .puntaje-exactitud`);
  const puntajePresentacionCell = document.querySelector(`#row-${idJuez} .puntaje-presentacion`);

  if (puntajeExactitudCell) {
    puntajeExactitudCell.textContent = rowData.puntajeExactitud;
  }

  if (puntajePresentacionCell) {
    puntajePresentacionCell.textContent = rowData.puntajePresentacion;
  }
}

function createFetchAndUpdateClosure(rowData, idJuez, idPasada) {
  return async () => {
    await fetchAndUpdatePuntaje(rowData, idJuez, idPasada);
  };
}

async function generateDynamicTable() {
  // Se vacía la tabla antes de generarla
  document.getElementById('dynamic-table-container').innerHTML = '';

  const resultados = [];

  const pasadaSeleccionada = document.getElementById('select-pasada').value;
  if (pasadaSeleccionada === 'Elegi la pasada') {
    return;
  }

  const pasada = document.querySelector('.pasada:checked');
  if (pasada) {
    const idPasada = pasada.value;
    try {
      const url = `/api/get-pasadasjuez/${idPasada}`;
      const response = await fetch(url);
      const jueces = await response.json();

      const tableData = [];

      // Fetch y update de puntajes para cada juez
      for (const juez of jueces) {
        const idJuez = juez.id_juez;

        const url2 = `/api/get-juezdata/${idJuez}`;
        const juezData = await fetch(url2);
        if (!juezData.ok) {
          throw new Error('Error al buscar juez');
        }

        const juezDataEncontrado = await juezData.json();

        // Creo un objeto con los datos del juez
        const rowData = {
          id: idJuez,
          name: juezDataEncontrado.name,
          apellido: juezDataEncontrado.apellido,
          puntajeExactitud: 0,
          puntajePresentacion: 0,
        };

        // Agrego los datos de la fila al array de la tabla
        tableData.push(rowData);

        const fetchAndUpdateClosure = createFetchAndUpdateClosure(rowData, idJuez, idPasada);
        await fetchAndUpdateClosure();
      }

      // Creo la tabla dinámica
      console.log('tableData antes de crear la tabla:', tableData);
      const table = document.createElement('table');
      table.classList.add('border', 'border-gray-300', 'mt-4');

      const thead = document.createElement('thead');
      const headerRow = document.createElement('tr');
      const headers = ['ID', 'Nombre', 'Apellido', 'Puntaje Exactitud', 'Puntaje Presentacion'];

      headers.forEach((headerText) => {
        const th = document.createElement('th');
        th.classList.add('border', 'border-gray-300', 'py-2', 'px-4');
        th.textContent = headerText;
        headerRow.appendChild(th);
      });

      thead.appendChild(headerRow);
      table.appendChild(thead);

      const tbody = document.createElement('tbody');
      tableData.forEach((rowData) => {
        const row = document.createElement('tr');
        row.id = `row-${rowData.id}`;

        const idCell = document.createElement('td');
        idCell.classList.add('border', 'border-gray-300', 'py-2', 'px-4');
        idCell.textContent = rowData.id;
        row.appendChild(idCell);

        const nameCell = document.createElement('td');
        nameCell.classList.add('border', 'border-gray-300', 'py-2', 'px-4');
        nameCell.textContent = rowData.name;
        row.appendChild(nameCell);

        const apellidoCell = document.createElement('td');
        apellidoCell.classList.add('border', 'border-gray-300', 'py-2', 'px-4');
        apellidoCell.textContent = rowData.apellido;
        row.appendChild(apellidoCell);

        const puntajeExactitudCell = document.createElement('td');
        puntajeExactitudCell.classList.add('border', 'border-gray-300', 'py-2', 'px-4', 'puntaje-exactitud');
        puntajeExactitudCell.textContent = rowData.puntajeExactitud;
        row.appendChild(puntajeExactitudCell);

        const puntajePresentacionCell = document.createElement('td');
        puntajePresentacionCell.classList.add('border', 'border-gray-300', 'py-2', 'px-4', 'puntaje-presentacion');
        puntajePresentacionCell.textContent = rowData.puntajePresentacion;
        row.appendChild(puntajePresentacionCell);

        tbody.appendChild(row);
      });

      table.appendChild(tbody);

      document.getElementById('dynamic-table-container').appendChild(table);


      const interval = 6000;
      const completedJudges = new Set();
      let mostrarResultadosEmitted = false;

      async function fetchAndUpdatePuntajeAndUpdateState(rowData, idJuez, idPasada) {
        try {
          await fetchAndUpdatePuntaje(rowData, idJuez, idPasada);
          completedJudges.add(idJuez);

          let allJudgesCompleted = true;
          for (const juez of tableData) {
            if (juez.puntajeExactitud === 0 || juez.puntajePresentacion === 0) {
              allJudgesCompleted = false;
              break;
            }
          }

          if (allJudgesCompleted && !mostrarResultadosEmitted) {
            // Se setea la bandera a true para evitar multiples emisiones
            mostrarResultadosEmitted = true;

            // Ocultar resultados y mostrar "Pasada cerrada"
            document.getElementById('dynamic-table-container').style.display = 'none';
            document.getElementById('pasadaCerrada').style.display = 'block';

            console.log('Todos los jueces enviaron sus puntajes');
            const resultados = idPasada;
            const newTabUrl = `/vista-pantalla-grande/${idPasada}`;
            window.livewire.emit('mostrarResultados', resultados, newTabUrl);
          }
        } catch (error) {
          console.error(error);
        }
      }

      for (const rowData of tableData) {
        (async (rowData, idJuez, idPasada) => {
          await fetchAndUpdatePuntajeAndUpdateState(rowData, idJuez, idPasada);
          const intervalId = setInterval(async () => {
            await fetchAndUpdatePuntajeAndUpdateState(rowData, idJuez, idPasada);
          }, interval);
        })(rowData, rowData.id, idPasada);
      }

    } catch (error) {
      console.error(error);
    }
  }

}


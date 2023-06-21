const divPuntaje = document.querySelector('.puntaje')
// const botonReseteo = document.querySelector('.boton-reseteo')

const traerPasada = document.querySelector('#traer-pasada');

const puntaje = 10;
/* localStorage.setItem('puntaje', puntaje)
localStorage.setItem('puntajeActual', puntaje) */

/* window.addEventListener('load', function(){
    divPuntaje.innerHTML = 10
    console.log(puntaje)
}) */

/* botonUno.addEventListener('touchstart', function(){
    puntajeActual = localStorage.getItem('puntajeActual');
    if(puntajeActual>=0.1){
        puntajeActual = puntajeActual - 0.1
        localStorage.setItem('puntajeActual', puntajeActual)
        divPuntaje.innerHTML = puntajeActual.toFixed(2)
    }
}) */

/* botonTres.addEventListener('touchstart', function(){
    puntajeActual = localStorage.getItem('puntajeActual');
    if(puntajeActual>=0.3){
        puntajeActual = puntajeActual - 0.3
        localStorage.setItem('puntajeActual', puntajeActual)
        divPuntaje.innerHTML = puntajeActual.toFixed(2)
    }
}) */

traerPasada.addEventListener('click', () => {
    const botonEnviar = document.getElementById('boton-enviar');
    const botonUno = document.getElementById('boton-uno');
    const botonTres = document.getElementById('boton-tres');
    esperarJueces( getPasada(), botonUno, botonTres )
      .then( cantJueces => {
        esperarTimer(pasadaId.value).then( resp => {
            enviar(pasadaId.value);
        }).catch( err => {
            console.error(err);
        })
      });
});

const esperarJueces = (idPasada, botonUno, botonTres) => {
    deshabilitarBotones(botonUno, botonTres);
    return new Promise( (resolve, reject) => {
        let interval = setInterval( async function () {
            try {
                let response;
                let url = `/api/cantJuecesn/${idPasada}`;
                response = await fetch( url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ pasada }),
                });
                const json = await response.json();
                console.log(json);
                if( json >= 3 ){
                    clearInterval(interval);
                    resolve(json);
                }
            } catch {
                clearInterval(interval);
                reject(error);
            }
        }, 1000);
    });
}

const esperarTimer = (idPasada, botonUno, botonTres) => {
    deshabilitarBotones(botonUno, botonTres);
    return new Promise( (resolve, reject) => {
        let interval = setInterval( async function () {
            try {
                let url = `/api/esperarTimer/${idPasada}`;
                const response = await fetch( url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                if( json == 1 ){
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 1000);
    });
}

const enviar = (idPasada) => {
    return new Promise((resolve, reject) => {
        let interval = setInterval( async function () {
            try {
                let response;
                response = await fetch('/api/enviar', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                if( json >= 1 ){
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 1000);
    });
}

const deshabilitarBotones = (botonUno, botonTres) => {
    console.log(botonUno, botonTres)
    botonUno.setAttribute('disabled', true);
    botonTres.setAttribute('disabled', true);
}

const habilitarBotones = (botonUno, botonTres) => {
    botonUno.removeAttribute('disabled');
    botonTres.removeAttribute('disabled');
}

const getPasada = () => {
    fetch('/api/getPasada')
        .then(function (res) {
            if (res.ok) {
                return res.json();
            } else {
                throw new Error('Error en la llamada AJAX');
            }
        })
        .then(function (json) {
            let pasada = json.pasada;
            console.log(pasada);
        })
        .catch(function (err) {
            console.log(err);
        });
};

// botonReseteo.addEventListener('touchstart', function(){
//     divPuntaje.innerHTML = localStorage.getItem('puntaje')
// })
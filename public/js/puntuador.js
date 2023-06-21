const divPuntaje = document.querySelector('.puntaje')
// const botonReseteo = document.querySelector('.boton-reseteo')

const traerPasada = document.getElementById('traer-pasada');



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

/* function traerBotones() {
    return new Promise((resolve, reject) => {
        document.addEventListener('DOMContentLoaded', function () {
            const botones = {
                'botonEnviar': document.getElementById('boton-enviar'),
                'botonUno': document.getElementById('boton-uno'),
                'botonTres': document.getElementById('boton-tres'),
            };
            resolve(botones);
        });
    });
}

traerPasada.addEventListener('click', async () => {
    try {
        let botones = await traerBotones();
        console.log(botones);
        await esperarJueces(getPasada(), botones.botonUno, botones.botonTres);
        await esperarTimer(pasadaId.value);
        enviar(pasadaId.value);
    } catch (err) {
        console.error(err);
    }

    // 
    let botones = traerBotones();
    console.log(botones);
    esperarJueces( getPasada(), botones.botonUno, botones.botonTres )
      .then( cantJueces => {
        esperarTimer(pasadaId.value).then( resp => {
            enviar(pasadaId.value);
        }).catch( err => {
            console.error(err);
        })
      });
}); */

function traerBotones() {
    return new Promise((resolve, reject) => {
        const checkElements = () => {
            const botonEnviar = document.getElementById('botonEnviar');
            const botonUno = document.getElementById('botonUno');
            const botonTres = document.getElementById('botonTres');

            if (botonEnviar && botonUno && botonTres) {
                const botones = {
                    'botonEnviar': botonEnviar,
                    'botonUno': botonUno,
                    'botonTres': botonTres,
                };
                resolve(botones);
            }
        };

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            checkElements();
        } else {
            document.addEventListener('DOMContentLoaded', checkElements);
        }

        const observer = new MutationObserver(checkElements);
        observer.observe(document.body, { childList: true, subtree: true });
    });
}

traerPasada.addEventListener('click', async () => {
    try {
        let botones = await traerBotones();
        console.log(botones);
        await esperarJueces(getPasada(), botones.botonUno, botones.botonTres);
        await esperarTimer(pasadaId.value);
        enviar(pasadaId.value);
    } catch (err) {
        console.error(err);
    }
});

const esperarJueces = (idPasada, botonUno, botonTres) => {
    deshabilitarBotones(botonUno, botonTres);
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let response;
                let url = `/api/cantJuecesn/${idPasada}`;
                response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                console.log(json);
                if (json >= 3) {
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) { // Add the error parameter here
                clearInterval(interval);
                reject(error);
            }
        }, 1000);
    });
}

const esperarTimer = (idPasada, botonUno, botonTres) => {
    deshabilitarBotones(botonUno, botonTres);
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let url = `/api/esperarTimer/${idPasada}`;
                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                if (json == 1) {
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
        let interval = setInterval(async function () {
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
                if (json >= 1) {
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
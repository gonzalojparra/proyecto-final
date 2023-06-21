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
        getPasada()
            .then(async (idPasada) => {
                esperarJueces(idPasada).then(cantJueces => {
                    esperarTimer(idPasada).then(resp => {
                        enviar(idPasada);
                    })
                });
                /* await esperarTimer(idPasada); */
                //await enviar(idPasada);
            })
            .catch((error) => {
                console.error(error);
            });
    } catch (err) {
        console.error(err);
    }
});

const esperarJueces = (idPasada) => {
    deshabilitarBotones();
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
                console.log(idPasada, json);
                if (json >= 3) {
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 3000);
    });
}

const esperarTimer = (idPasada) => {
    deshabilitarBotones();
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let url = `/api/esperarTimern/${idPasada}`;
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
                    habilitarBotones();
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 3000);
    });
}

const enviar = (idPasada) => {
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let response;
                let url = `/api/enviarn/${idPasada}`;
                response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });

                if (!response.ok) {
                    throw new Error('Error de network');
                }

                const text = await response.text();
                let json;

                try {
                    json = JSON.parse(text);
                } catch (error) {
                    throw new Error('Data del json invalido');
                }

                if (json >= 1) {
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 3000);
    });
}

const deshabilitarBotones = () => {
    const buttons = document.querySelectorAll('input[type="button"]');
    buttons.forEach((button) => {
        button.disabled = true;
    });
};

const habilitarBotones = () => {
    const buttons = document.querySelectorAll('input[type="button"]');
    buttons.forEach((button) => {
        button.disabled = false;
    });
}

const getPasada = () => {
    return new Promise((resolve, reject) => {
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
                resolve(pasada);
            })
            .catch(function (err) {
                console.log(err);
                reject(err);
            });
    });
};

// botonReseteo.addEventListener('touchstart', function(){
//     divPuntaje.innerHTML = localStorage.getItem('puntaje')
// })
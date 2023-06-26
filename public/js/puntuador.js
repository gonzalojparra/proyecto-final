const divPuntaje = document.querySelector('.puntaje')
// const botonReseteo = document.querySelector('.boton-reseteo')
const traerPasada = document.getElementById('traer-pasada');
const puntaje = 10;

// Inicio de puntuador
traerPasada.addEventListener('click', async () => {
    try {
        let botones = await traerBotones();
        // console.log(botones);
        getPasada() // Obtengo la pasada seleccionada desde el timer
            .then(async (idPasada) => {
                esperarJueces(idPasada).then(cantJueces => { // Se consulta la cantidad de jueces en la puntuacion
                    //console.log(`Cantidad de jueces: ${cantJueces}`)
                    esperarTimer(idPasada).then(resp => { // Se espera a que se habilite el timer
                        //console.log(`Esperar timer: ${resp.resp}`);
                        /* enviar(idPasada).then( resp => console.log(`Enviar: ${resp.resp}`) );  */
                    })
                });
                //await esperarTimer(idPasada);
                //await enviar(idPasada);
            })
            .catch((error) => {
                console.error(error);
            });
    } catch (err) {
        console.error(err);
    }
});

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
};

const esperarJueces = (idPasada) => {
    deshabilitarBotones();
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let response;
                let url = `/api/cantJueces/${idPasada}`;
                response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                //console.log(idPasada, json);
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
};

const esperarTimer = (idPasada) => {
    deshabilitarBotones();
    deshabilitarEnviar();
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                console.log(`Esperando timer: ${idPasada}`);
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
                if (json.resp) {
                    console.log(json.resp);
                    clearInterval(interval);
                    habilitarBotonesPuntuar();
                    deshabilitarEnviar();
                    resolve(json);
                    esperarTimerPausao(idPasada)
                        .then(resp => console.log(`Esperar timer pausao: ${resp.resp}`))
                        .then(resp => enviar(idPasada))
                        .catch(error => console.error(error));
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 3000);
    });
};

const esperarTimerPausao = (idPasada) => {
    habilitarBotonesPuntuar();
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                console.log(`Esperando timer: ${idPasada}`);
                let url = `/api/esperarTimerPausao/${idPasada}`;
                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ idPasada }),
                });
                const json = await response.json();
                console.log(json);
                deshabilitarEnviar();
                if (json.resp) {
                    console.log(json.resp);
                    clearInterval(interval);
                    deshabilitarBotones();
                    habilitarEnviar();
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 3000);
    });
};

const enviar = (idPasada) => {
    return new Promise((resolve, reject) => {
        let interval = setInterval(async function () {
            try {
                let response;
                let url = `/api/enviar/${idPasada}`;
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

                if (json.resp) {
                    clearInterval(interval);
                    resolve(json);
                }
            } catch (error) {
                clearInterval(interval);
                reject(error);
            }
        }, 5000);
    });
};

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
                resolve(pasada);
            })
            .catch(function (err) {
                console.log(err);
                reject(err);
            });
    });
};

const deshabilitarBotones = () => {
    const buttonRestaUno = document.querySelector('#botonUno');
    const buttonRestaTres = document.querySelector('#botonTres');
    buttonRestaTres.disabled = true;
    buttonRestaUno.disabled = true;
};

const habilitarBotonesPuntuar = () => {
    const buttonRestaUno = document.querySelector('#botonUno');
    const buttonRestaTres = document.querySelector('#botonTres');
    buttonRestaTres.disabled = false;
    buttonRestaUno.disabled = false;
};

const deshabilitarEnviar = () => {
    const buttonEnviar = document.querySelector('#botonEnviar');
    buttonEnviar.disabled = true;
}

const habilitarEnviar = () => {
    const buttonEnviar = document.querySelector('#botonEnviar');
    buttonEnviar.disabled = false;
}
const divPuntaje = document.querySelector('.puntaje')
// const botonReseteo = document.querySelector('.boton-reseteo')
const botonEnviar = document.querySelector('.boton-envio')
const botonUno = document.querySelector('#uno')
const botonTres = document.querySelector('#tres')

const pasadaId = document.querySelector('.pasada');

const puntaje = 10;
localStorage.setItem('puntaje', puntaje)
localStorage.setItem('puntajeActual', puntaje)

window.addEventListener('load', function(){
    divPuntaje.innerHTML = 10
    console.log(puntaje)
})

botonUno.addEventListener('touchstart', function(){
    puntajeActual = localStorage.getItem('puntajeActual');
    if(puntajeActual>=0.1){
        puntajeActual = puntajeActual - 0.1
        localStorage.setItem('puntajeActual', puntajeActual)
        divPuntaje.innerHTML = puntajeActual.toFixed(2)
    }
})

botonTres.addEventListener('touchstart', function(){
    puntajeActual = localStorage.getItem('puntajeActual');
    if(puntajeActual>=0.3){
        puntajeActual = puntajeActual - 0.3
        localStorage.setItem('puntajeActual', puntajeActual)
        divPuntaje.innerHTML = puntajeActual.toFixed(2)
    }
})

document.addEventListener('DOMContentLoaded', () => {
    esperarJueces()
      .then( cantJueces => {
        esperarTimer(pasadaId.value).then( resp => {
            enviar(pasadaId.value);
        }).catch( err => {
            console.error(err);
        })
      });
});

const esperarJueces = () => {
    deshabilitarBotones();
    return new Promise( (resolve, reject) => {
        let interval = setInterval( async function () {
            try {
                let response;
                response = await fetch('/api/cantJueces', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({ pasada }),
                });
                const json = await response.json();
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

const esperarTimer = (idPasada) => {
    deshabilitarBotones();
    return new Promise( (resolve, reject) => {
        let interval = setInterval( async function () {
            try {
                const response = await fetch('/api/esperarTimer', {
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

const deshabilitarBotones = () => {
    botonUno.setAttribute('disabled', true);
    botonTres.setAttribute('disabled', true);
}

const habilitarBotones = () => {
    botonUno.removeAttribute('disabled');
    botonTres.removeAttribute('disabled');
}

// botonReseteo.addEventListener('touchstart', function(){
//     divPuntaje.innerHTML = localStorage.getItem('puntaje')
// })
const divPuntaje = document.querySelector('.puntaje')
const botonReseteo = document.querySelector('.boton-reseteo')
const botonUno = document.querySelector('#uno')
const botonTres = document.querySelector('#tres')

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

botonReseteo.addEventListener('touchstart', function(){
    divPuntaje.innerHTML = localStorage.getItem('puntaje')
})
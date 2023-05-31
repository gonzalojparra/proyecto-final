

//acá recupero todos los input del formulario
const inputNombre = document.querySelector('#nombreUsuario')
const inputApellido = document.querySelector('#apellidoUsuario')
const inputEscuela = document.querySelector('#escuelaUsuario')
const inputEmail = document.querySelector('#emailUsuario')
const inputContrasenia = document.querySelector('#contrasenia')
const inputContraseniaConfirmada = document.querySelector('#contraseniaConfirmada')
const botonSubmit = document.querySelector('#botonSubmit')

const formulario = document.querySelector('#formularioRegistro')

const checkRolCompetidor = document.querySelector('#competidor')
const checkRolJuez = document.querySelector('#juez')
const divChecks = document.querySelector('#checks')

//validaciones del formulario de inscripción
const formInscripcion = document.querySelector('#formularioInscripcion')
const divGal = document.querySelector('#cinturonNegro')
const inputDU = document.querySelector('#duCompetidor')
const inputEdad = document.querySelector('#fechaNacCompetidor')
const inputCategoria = document.querySelector('#categoriaCompetidor')
const inputGraduacion = document.querySelector('#graduacionCompetidor')
const inputGal = document.querySelector('#galCompetidor')


//acá recupero todos los divs donde irán los mensajes de feedback

const nombreFeedback = document.querySelector('#nombreFeedback')
const apellidoFeedback = document.querySelector('#apellidoFeedback')
const escuelaFeedback = document.querySelector('#escuelaFeedback')
const emailFeedback = document.querySelector('#emailFeedback')
const contraseniaFeedback = document.querySelector('#contraseniaFeedback')
const contraseniaConfirmadaFeedback = document.querySelector('#contraseniaConfirmadaFeedback')
const checksFeedback = document.querySelector('#checksFeedback')

const duFeedback = document.querySelector('#duFeedback')
const edadFeedback = document.querySelector('#edadFeedback')
const categoriaFeedback = document.querySelector('#categoriaFeedback')
const graduacionFeedback = document.querySelector('#graduacionFeedback')
const galFeedback = document.querySelector('#galFeedback')


let nombreValido = false;
let apellidoValido = false;
let emailValido = false;
let contraseniasValidas = false;
let formularioValido = false;

window.addEventListener('load', function () {
  formInscripcion.style.display = 'none'
  divGal.style.display = 'none'
  console.log(inputCategoria)
  // console.log('js anda')
  // botonSubmit.disabled = true 
  // fetch("{{route('auth.showTeams')}}")
  // .then(response => response.json())
  // .then(data => {
  //    console.log(data)
  // })
  // .catch(error => console.error(error));
  // console.log(generarArrayEscuelas())
})

// function generarArrayEscuelas() {
//   var escuelasObtenidas;
//   $.ajax({
//     url: 'http://localhost:8000/obtenerEscuelas',
//     dataType: 'json',
//     async: false, // Hacer la solicitud AJAX de manera síncrona
//     success: function (response) {
//       console.log(response)
//       escuelasObtenidas = response;
//     }
//   });
//   return escuelasObtenidas;
// } 

formulario.addEventListener('click', function () {
  formularioValido = validarFormulario()
  if (!formularioValido) {
    botonSubmit.disabled = true;
  } else {
    console.log('entra al else')
    botonSubmit.disabled = false;
  }
})

//FORMULARIO INSCRIPCION
//Documento
//Edad
//Graduación (traer de la bd)
//Categoría (traer de la bd)


//los blur no me los saquen, que son los que hacen que se verifique en seguida si es válido el campo

inputNombre.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputNombre)
  if (campoCompleto) {
    nombreValido = validarString(inputNombre)
    if (nombreValido) {
      nombreFeedback.innerHTML = ' &nbsp;'
    } else {
      nombreFeedback.style.color = 'red'
      nombreFeedback.innerHTML = 'Ha ingresado números y/o demasiados caracteres'
    }
  } else {
    nombreFeedback.style.color = 'red'
    nombreFeedback.innerHTML = 'Complete este campo'
  }
})

inputApellido.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputApellido)
  if (campoCompleto) {
    apellidoValido = validarString(inputApellido)
    if (apellidoValido) {
      apellidoFeedback.innerHTML = ' &nbsp;'
    } else {
      apellidoFeedback.style.color = 'red'
      apellidoFeedback.innerHTML = 'Ha ingresado números y/o demasiados caracteres'
    }
  } else {
    apellidoFeedback.style.color = 'red'
    apellidoFeedback.innerHTML = 'Complete este campo'
  }
})

inputEscuela.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputEscuela)
  if (campoCompleto) {
    escuelaValida = validarString(inputEscuela)
    if (escuelaValida) {
      escuelaFeedback.innerHTML = ' &nbsp;'
    } else {
      escuelaFeedback.style.color = 'red'
      escuelaFeedback.innerHTML = 'Ha ingresado números y/o demasiados caracteres'
    }
  } else {
    escuelaFeedback.style.color = 'red'
    escuelaFeedback.innerHTML = 'Complete este campo'
  }
})

inputEmail.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputEmail)
  if (campoCompleto) {
    emailValido = validarEmail(inputEmail)
    if (emailValido) {
      emailFeedback.innerHTML = ' &nbsp;'
    } else {
      emailFeedback.style.color = 'red'
      emailFeedback.innerHTML = 'El email ingresado no es válido'
    }
  } else {
    emailFeedback.style.color = 'red'
    emailFeedback.innerHTML = 'Complete este campo'
  }
})

inputContrasenia.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputContrasenia)
  if (campoCompleto) {
    if (validarLongitud(inputContrasenia, 'contrasenia')) {
      //esto validarlo cuando se envíe el formulario
      contraseniasValidas = contraseniasIguales(inputContrasenia, inputContraseniaConfirmada);
      if (contraseniasValidas) {
        contraseniaFeedback.innerHTML = ' &nbsp;'
        contraseniaConfirmadaFeedback.innerHTML = ' &nbsp;'
      } else {
        contraseniaFeedback.style.color = 'red'
        contraseniaFeedback.innerHTML = 'Las contraseñas no son iguales'
      }
    } else {
      contraseniaFeedback.style.color = 'red'
      contraseniaFeedback.innerHTML = 'La contraseña debe tener un mínimo de 8 caracteres'
    }
  } else {
    contraseniaFeedback.style.color = 'red'
    contraseniaFeedback.innerHTML = 'Complete este campo'
  }
})

inputContraseniaConfirmada.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputContraseniaConfirmada)
  if (campoCompleto) {
    if (validarLongitud(inputContraseniaConfirmada, 'contrasenia')) {
      contraseniasValidas = contraseniasIguales(inputContrasenia, inputContraseniaConfirmada);
      if (contraseniasValidas) {
        contraseniaFeedback.innerHTML = ' &nbsp;'
        contraseniaConfirmadaFeedback.innerHTML = ' &nbsp;'
      } else {
        contraseniaConfirmadaFeedback.style.color = 'red'
        contraseniaConfirmadaFeedback.innerHTML = 'Las contraseñas no son iguales'
      }
    } else {
      contraseniaConfirmadaFeedback.style.color = 'red'
      contraseniaConfirmadaFeedback.innerHTML = 'La contraseña debe tener un mínimo de 8 caracteres'
    }
  } else {
    contraseniaConfirmadaFeedback.style.color = 'red'
    contraseniaConfirmadaFeedback.innerHTML = 'Complete este campo'
  }
})

divChecks.addEventListener('click', function () {
  checksValidos = validarChecks(checkRolCompetidor, checkRolJuez)
  if (checksValidos) {
    checksFeedback.innerHTML = ' &nbsp;'
  } else {
    checksFeedback.style.color = 'red'
    checksFeedback.innerHTML = 'Seleccione una opción'
  }
})

inputDU.addEventListener('blur', function () {
  duValido = validarCampo(inputDU)
})

inputEdad.addEventListener('blur', function () {
  edadValida = validarCampo(inputEdad)
  if (edadValida){
    validarEdad()
  }
})

inputCategoria.addEventListener('blur', function () {
  // categoriaValida = validarCampo(inputCategoria)
})

inputGraduacion.addEventListener('click', function () {
  // graduacionValida = validarCampo(inputGraduacion)
  showGal = cinturonNegro(inputGraduacion);
  if (showGal){
    divGal.style.display = 'inline'
  } else {
    divGal.style.display = 'none'
  }
})

inputGal.addEventListener('blur', function () {
  galValido = validarCampo(inputGal)
  if(galValido){
    galValido = validarGal()
  }

})

function validarFormulario() {
  formularioValido = false;
  if (nombreValido) {
    console.log('2 nombre es valido')
    if (apellidoValido) {
      console.log('3 apellido es valido')
      if (emailValido) {
        console.log('4 email es valido')
        if (contraseniasValidas) {
          console.log('5 contrasenias son validas')
          checksValidos = validarChecks(checkRolCompetidor, checkRolJuez)
          if (checksValidos) {
            checksFeedback.innerHTML = ' &nbsp;'
            formularioValido = true;
          } else {
            checksFeedback.style.color = 'red'
            checksFeedback.innerHTML = 'Seleccione una opción'
          }
        }
      }
    }
  }
  return formularioValido
}

//funcion que comprueba que el campo no esté vacío
function validarCampo(input) {
  if (input.value === "") {
    input.style.borderColor = 'red';
    input.innerHTML = 'Complete este campo'
    return false;
  } else {
    input.style.borderColor = 'green';
    return true
  }
}

function validarChecks(checkRolCompetidor, checkRolJuez) {
  checkValidado = false;
  if (checkRolCompetidor.checked) {
    checkValidado = true;
    formInscripcion.style.display = 'inline'
  } else if (checkRolJuez.checked) {
    checkValidado = true;
    formInscripcion.style.display = 'none'
  }
  return checkValidado;
}

function validarSelect(select) {
  if (select.value != '') {

  }
}

function validarGal() {
  const regexGal = /^[A-Z]{3}\d{7}$/;
  if (!regexGal.test(inputGal.value)) {
    inputGal.style.borderColor = "red";
    galFeedback.style.color = 'red'
    galFeedback.innerHTML = 'Ingrese 3 letras mayúsculas y 7 números'
    return false;
  } else {
    inputGal.style.borderColor = "green";
    galFeedback.innerHTML = '&nbsp;'
    return true;
  }

}


function validarEdad(fecha) {
  const fechaNac = new Date(fecha); //se crea la clase de fecha con el valor pasado por parametro 
  const anioNac = fechaNac.getFullYear(); //se obtiene el año de la fecha pasada por parametro
  const fechaActual = new Date(); //se obtiene la clase date para saber el año actual
  const anioActual = fechaActual.getFullYear(); // devuelve el año actual  
  const edad = anioActual - anioNac;
  if (edad < 6) {
    edadInput.style.borderColor = "red";
    edadFeedback.style.color = 'red';
    edadFeedback.innerHTML ='Debe tener al menos 6 años de edad'
    return false;
  } else if (edad > 6) {
    edadInput.style.borderColor = "green";
    edadFeedback.innerHTML ='&nbsp'
    return true;
  }
}

function cinturonNegro(select) {
  let showGal = false
  switch (select.value) {
    case '1er DAN':
      showGal = true;
      break;
    case '2do DAN':
      showGal = true;
      break;
    case '3er DAN':
      showGal = true;
      break;
    case '4to DAN':
      showGal = true;
      break;
    case '5to DAN':
      showGal = true;
      break;
    case '6to DAN':
      showGal = true;
      break;
    case '7mo DAN':
      showGal = true;
      break;
    case '8vo DAN':
      showGal = true;
      break;
    case '9no DAN':
      showGal = true;
      break;
  }
  return showGal;
}

function validarLongitud(input, type) {
  longitudValidada = false
  if (type === 'contrasenia') {
    if (input.value.length >= 8) {
      input.style.borderColor = "green";
      longitudValidada = true
    }
    else {
      input.style.borderColor = "red";
      console.log('entra al else')
    }
  } else {
    if (input.value.length > 100) {
      input.style.borderColor = "red";
    }
    else {
      input.style.borderColor = "green";
      longitudValidada = true
    }
  }
  return longitudValidada
}

function contraseniasIguales(contrasenia, contraseniaRepetida) {
  // if (validarCampo(contrasenia) && validarCampo(contraseniaRepetida)) {
  if (contrasenia.value === contraseniaRepetida.value) {
    console.log('entra al if')
    contrasenia.style.borderColor = "green";
    contraseniaRepetida.style.borderColor = "green";
    return true
  } else {
    console.log('entra al else')
    contrasenia.style.borderColor = "red";
    contraseniaRepetida.style.borderColor = "red";
    return false
  }
  // } else {

  // }
}


//funcion que valida que el valor ingresado sea string
function validarString(input) {
  stringValidado = false
  string = input.value
  if (isNaN(string)) {
    stringValidado = validarLongitud(input, 'otro')
  } else {
    input.style.borderColor = "red";
  }
  return stringValidado
}

//función que comprueba que el mail tenga un @ entre strings
function validarEmail(email) {
  const regexEmail = /^\S+@\S+\.\S+$/;
  if (!regexEmail.test(email.value)) {
    email.style.borderColor = "red";
    return false;
  } else {
    email.style.borderColor = "green";
    return true;
  }
}

//acá intenté asegurarme de que todos los valores sean true
// function formularioValido(){
// formValido = false;
// if (usuarioValido){
//   if(nombreValido){
//     if(apellidoValido){
//       if(emailValido){
//         formValido = true;
//       }
//     }
//   }
// }
// return formValido
// }


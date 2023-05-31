

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
const divChecks = document.querySelector('#rolChecks')

//validaciones del formulario de inscripción
const formInscripcion = document.querySelector('#formularioInscripcion')
const divGal = document.querySelector('#cinturonNegro')
const inputDU = document.querySelector('#duCompetidor')
const inputEdad = document.querySelector('#fechaNacCompetidor')
const inputCategoria = document.querySelector('#categoriaCompetidor')
const inputGraduacion = document.querySelector('#graduacionCompetidor')
const inputGal = document.querySelector('#galCompetidor')
const checkFemenino = document.querySelector('#femenino')
const checkMasculino = document.querySelector('#masculino')
const divGenero = document.querySelector('#generoChecks')
//acá recupero todos los divs donde irán los mensajes de feedback

const nombreFeedback = document.querySelector('#nombreFeedback')
const apellidoFeedback = document.querySelector('#apellidoFeedback')
const escuelaFeedback = document.querySelector('#escuelaFeedback')
const emailFeedback = document.querySelector('#emailFeedback')
const contraseniaFeedback = document.querySelector('#contraseniaFeedback')
const contraseniaConfirmadaFeedback = document.querySelector('#contraseniaConfirmadaFeedback')
const checksFeedback = document.querySelector('#rolChecksFeedback')


const duFeedback = document.querySelector('#duFeedback')
const edadFeedback = document.querySelector('#edadFeedback')
const categoriaFeedback = document.querySelector('#categoriaFeedback')
const graduacionFeedback = document.querySelector('#graduacionFeedback')
const galFeedback = document.querySelector('#galFeedback')
const generoFeedback = document.querySelector('#generoChecksFeedback')

let nombreValidado = false;
let apellidoValidado = false;
let emailValidado = false;
let contraseniasValidas = false;
let formularioValido = false;
let checkRolValido = false
let escuelaValidada = false

let selectedRol = ''

let duValidado = false
let edadValidada = false
let generoValidado = false
let categoriaValidada = false
let graduacionValidada = false
let tipoGraduacion = ''

let galValidado = false

window.addEventListener('load', function () {
  formInscripcion.style.display = 'none'
  divGal.style.display = 'none'
  console.log(inputCategoria)
})

formulario.addEventListener('click', function () {
  formularioValido = validarFormulario()
  if (!formularioValido) {
    botonSubmit.disabled = true;
  } else {
    botonSubmit.disabled = false;
  }
})


//los blur no me los saquen, que son los que hacen que se verifique en seguida si es válido el campo

inputNombre.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputNombre)
  if (campoCompleto) {
    nombreValido = validarString(inputNombre)
    if (nombreValido) {
      nombreValidado = true
      nombreFeedback.innerHTML = ' &nbsp;'
    } else {
      nombreFeedback.style.color = 'red'
      nombreFeedback.style.fontSize = '12px'
      nombreFeedback.innerHTML = 'Ha ingresado números y/o demasiados caracteres'
    }
  } else {
    nombreFeedback.style.color = 'red'
    nombreFeedback.style.fontSize = '12px'
    nombreFeedback.innerHTML = 'Complete este campo'
  }
})

inputApellido.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputApellido)
  if (campoCompleto) {
    apellidoValido = validarString(inputApellido)
    if (apellidoValido) {
      apellidoValidado = true
      apellidoFeedback.innerHTML = ' &nbsp;'
    } else {
      apellidoFeedback.style.color = 'red'
      apellidoFeedback.style.fontSize = '12px'
      apellidoFeedback.innerHTML = 'Ha ingresado números y/o demasiados caracteres'
    }
  } else {
    apellidoFeedback.style.color = 'red'
    apellidoFeedback.style.fontSize = '12px'
    apellidoFeedback.innerHTML = 'Complete este campo'
  }
})

inputEscuela.addEventListener('click', function () {

 validarEscuela(inputEscuela) 


})

inputEmail.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputEmail)
  if (campoCompleto) {
    emailValido = validarEmail(inputEmail)
    if (emailValido) {
      emailFeedback.innerHTML = ' &nbsp;'
      emailValidado = true
    } else {
      emailFeedback.style.color = 'red'
      emailFeedback.style.fontSize = '12px'
      emailFeedback.innerHTML = 'El email ingresado no es válido'
    }
  } else {
    emailFeedback.style.color = 'red'
    emailFeedback.style.fontSize = '12px'
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
        contraseniaFeedback.style.fontSize = '12px'
        contraseniaFeedback.innerHTML = 'Las contraseñas no son iguales'
      }
    } else {
      contraseniaFeedback.style.color = 'red'
      contraseniaFeedback.style.fontSize = '12px'
      contraseniaFeedback.innerHTML = 'La contraseña debe tener un mínimo de 8 caracteres'
    }
  } else {
    contraseniaFeedback.style.color = 'red'
    contraseniaFeedback.style.fontSize = '12px'
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
        contraseniaConfirmadaFeedback.style.fontSize = '12px'
        contraseniaConfirmadaFeedback.innerHTML = 'Las contraseñas no son iguales'
      }
    } else {
      contraseniaConfirmadaFeedback.style.color = 'red'
      contraseniaConfirmadaFeedback.style.fontSize = '12px'
      contraseniaConfirmadaFeedback.innerHTML = 'La contraseña debe tener un mínimo de 8 caracteres'
    }
  } else {
    contraseniaConfirmadaFeedback.style.color = 'red'
    contraseniaConfirmadaFeedback.style.fontSize = '12px'
    contraseniaConfirmadaFeedback.innerHTML = 'Complete este campo'
  }
})

divChecks.addEventListener('click', function () {
  checksValidos = validarChecksRol(checkRolCompetidor, checkRolJuez)
  if (checksValidos) {
    checksFeedback.innerHTML = ' &nbsp;'
  } else {
    checksFeedback.style.color = 'red'
    checksFeedback.style.fontSize = '12px'
    checksFeedback.innerHTML = 'Seleccione una opción'
  }
})


inputDU.addEventListener('blur', function () {
  campoCompleto = validarCampo(inputDU)
  if (campoCompleto) {
    // duValido = validarDu(inputDU)
    if (isNaN(inputDU.value)) {
      inputDU.style.borderColor = 'red';
      duFeedback.style.color = 'red'
      duFeedback.style.fontSize = '12px'
      duFeedback.innerHTML = 'El du ingresado no es válido'
    } else {
      if ( inputDU.value.length === 8){
        inputDU.style.borderColor = 'green';
        duFeedback.innerHTML = ' &nbsp;'

      } else {
        inputDU.style.borderColor = 'red';
        duFeedback.style.color = 'red'
        duFeedback.style.fontSize = '12px'
        duFeedback.innerHTML = 'El du ingresado no es válido'
      }
    }
  } else {
    duFeedback.style.color = 'red'
    duFeedback.style.fontSize = '12px'
    duFeedback.innerHTML = 'Complete este campo'
  }

})


inputEdad.addEventListener('blur', function () {
  edadValida = validarCampo(inputEdad)
  if (edadValida) {
    if (validarEdad(inputEdad.value)) {
      inputEdad.style.borderColor = "green";
    } else {
      inputEdad.style.borderColor = "red";
    }
  } else {
    fechaNacFeedback.style.color = 'red'
    fechaNacFeedback.style.fontSize = '12px'
    fechaNacFeedback.innerHTML = 'Complete este campo'
  }
})

divGenero.addEventListener('click', function () {
  checksValidos = validarChecksGenero(checkMasculino, checkFemenino)
  if (checksValidos) {
    generoFeedback.innerHTML = ' &nbsp;'
  } else {
    generoFeedback.style.color = 'red'
    generoFeedback.style.fontSize = '12px'
    generoFeedback.innerHTML = 'Seleccione una opción'
  }
})

inputCategoria.addEventListener('click', function () {
  if (validarSelect(inputCategoria)) {
    categoriaFeedback.style.color = 'red'
    categoriaFeedback.style.fontSize = '12px'
    categoriaFeedback.innerHTML = 'La categoria debe ser seleccionada'
  } else {
    categoriaFeedback.innerHTML = ' &nbsp;'
  }
})

inputGraduacion.addEventListener('click', function () {
  console.log(inputGraduacion.value)
  if (validarSelect(inputGraduacion)) {
    categoriaFeedback.style.color = 'red'
    categoriaFeedback.style.fontSize = '12px'
    categoriaFeedback.innerHTML = 'La categoria debe ser seleccionada'
  } else {
    categoriaFeedback.innerHTML = ' &nbsp;'
    if (cinturonNegro(inputGraduacion)) {
      divGal.style.display = 'inline'
    } else {
      divGal.style.display = 'none'
    }
  }
})

//me lo muestra aunque no sea de la categoria que necesita gal 
inputGal.addEventListener('blur', function () {
  console.log(validarCampo(inputGal))
  if (validarCampo(inputGal)) {
    galValido = validarGal(inputGal)
  } else {
    galFeedback.style.color = 'red';
    galFeedback.innerHTML = 'Complete este campo'
  }


})

//hacer una variable con un array de los valores
function validarFormulario() {
  formularioValido = false;
  if (nombreValidado) {
    if (apellidoValidado) {
      if (emailValidado) {
        if (contraseniasValidas) {
          if (checkRolValido) {
            if (selectedRol === 'competidor') {
              if (duValidado) {
                if (edadValidada) {
                  if (generoValidado) {
                    if (categoriaValidada) {
                      if (graduacionValidada) {
                        if (tipoGraduacion === 'elite') {
                          if (galValidado) {
                            formularioValido = true
                          }
                        } else {
                          formularioValido = true
                        }
                      }
                    }
                  }
                }
              }
            } else {
              formularioValido = true;
            }
          }
        }
      }
    }
  }
  return formularioValido
}

//funcion que comprueba que el campo no esté vacío
function validarCampo(input) {
  if (input.value === null) {
    input.style.borderColor = 'red';
    input.innerHTML = 'Complete este campo'
    return false;
  } else {
    input.style.borderColor = 'green';
    return true
  }
}

function validarChecksRol(checkRolCompetidor, checkRolJuez) {
  if (checkRolCompetidor.checked) {
    checkRolValido = true
    formInscripcion.style.display = 'inline'
    selectedRol = checkRolCompetidor.value
  } else if (checkRolJuez.checked) {
    checkRolValido = true
    formInscripcion.style.display = 'none'
    selectedRol.checkRolJuez.value
  }
  return checkValidado;
}

function validarChecksGenero(checkMasculino, checkFemenino) {
  checkValidado = false;
  if (checkMasculino.checked) {
    checkValidado = true;
  } else if (checkFemenino.checked) {
    checkValidado = true;
  }
  return checkValidado;
}

function validarSelect(select) {
  if (select.value != '') {
    return false;
  } else {
    return true;
  }
}

function validarEscuela(){
  if (inputEscuela.value === 'escuela'){
    escuelaValidada = false
    escuelaFeedback.style.color = 'red'
    escuelaFeedback.style.fontSize = '12px'
    escuelaFeedback.innerHTML = 'Debe elegir una escuela'
  } else {
    escuelaValidada = true
    escuelaFeedback.innerHTML = ' &nbsp;'
  }
}

function validarGal() {
  const regexGal = /^[A-Z]{3}\d{7}$/;
  if (!regexGal.test(inputGal.value.toUpperCase())) {
    inputGal.style.borderColor = "red";
    galFeedback.style.color = 'red'
    galFeedback.style.fontSize = '12px'
    galFeedback.innerHTML = 'Ingrese 3 letras y 7 números'
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
    // edadInput.style.borderColor = "red";
    fechaNacFeedback.style.color = 'red';
    fechaNacFeedback.style.fontSize = '12px';
    fechaNacFeedback.innerHTML = 'Debe tener al menos 6 años de edad'
    return false;
  } else if (edad > 6) {
    // edadInput.style.borderColor = "green";
    fechaNacFeedback.innerHTML = '&nbsp'
    return true;
  }
}

function cinturonNegro(select) {
  let showGal = false
  switch (select.value) {
    case '1 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '2 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '3 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '4 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '5 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '6 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '7 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '8 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    case '9 DAN, Negro':
      tipoGraduacion = 'elite'
      showGal = true;
      break;
    default:
      tipoGraduacion = ''
      showGal = false
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
    contrasenia.style.fontSize = "12px";
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


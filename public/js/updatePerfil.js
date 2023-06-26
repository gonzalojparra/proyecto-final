const inputNombre = document.querySelector('#name')
const inputApellido = document.querySelector('#apellido')
const inputEmail = document.querySelector('#email')
const inputDU = document.querySelector('#du')
const inputEdad = document.querySelector('#fecha_nac')
const inputGal = document.querySelector('#galCompetidor')


let botonPerfil = document.getElementById("botonPerfil");
let form = document.getElementById("formUpdate");
let show = document.getElementById("showDatos");

botonPerfil.addEventListener('click', () => {
    form.style.display = 'block';
    show.style.display = 'none';
});

//funcion que comprueba que el campo no esté vacío
function validarCampo(input) {
    if (input.value === "") {
      input.style.borderColor = 'red';
      input.style.boxShadow = '2px 2px 2px rgba(0, 0, 0, 0.2)'
      return false;
    } else {
        input.style.borderColor = 'green';
        input.style.boxShadow = '2px 2px 2px rgba(0, 0, 0, 0.2)'
      return true
    }
  }
  
//funcion que valida que el valor ingresado sea string
function validarString(input) {
    stringValidado = false
    string = input.value
    if (isNaN(string)) {
      stringValidado = validarLongitud(input, 'otro')
    }
    else {
      input.style.borderColor = "red";
      input.style.boxShadow = '2px 2px 2px rgba(0, 0, 0, 0.2)'
    }
    return stringValidado
  }  

//funcion que valida la longitud de los inputs 
function validarLongitud(input, type) {
    longitudValidada = false
      if (input.value.length > 100) {
        input.style.borderColor = "red";
        input.style.boxShadow = '2px 2px 2px rgba(0, 0, 0, 0.2)'
      }
      else {
        input.style.borderColor = "green";
        input.style.boxShadow = '2px 2px 2px rgba(0, 0, 0, 0.2)'
        longitudValidada = true
      }
    return longitudValidada
  }

 //funcion que valida que un email sea valido 
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

//funcion que valida que un competidor sea mayor de 6 años 
  function validarEdad(fecha) {
    const fechaNac = new Date(fecha); //se crea la clase de fecha con el valor pasado por parametro 
    const anioNac = fechaNac.getFullYear(); //se obtiene el año de la fecha pasada por parametro
    const fechaActual = new Date(); //se obtiene la clase date para saber el año actual
    const anioActual = fechaActual.getFullYear(); // devuelve el año actual  
    const edad = anioActual - anioNac;
    if (edad < 12) {
      // edadInput.style.borderColor = "red";
      fechaNacFeedback.style.color = 'red';
      fechaNacFeedback.style.fontSize = '12px';
      fechaNacFeedback.innerHTML = 'Debe tener al menos 12 años de edad'
      return false;
    } else if (edad >= 12) {
      // edadInput.style.borderColor = "green";
      fechaNacFeedback.innerHTML = '&nbsp'
      return true;
    }
  }

  //funcion que valida el gal de un competidor 
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

//validacion del nombre
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
  
//validacion del apellido
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


//validacion del email 
inputEmail.addEventListener('blur', function () {
    campoCompleto = validarCampo(inputEmail)
    if (campoCompleto) {
      emailValido = validarEmail(inputEmail)
      if (emailValido){
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

//validacion del du
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
  
//valida que el competidor sea mayor de 6 años
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

 //validacion del gal
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
// function validarFormulario() {
//   formularioValido = false;
//   if (nombreValidado) {
//     if (apellidoValidado) {
//       if (emailValidado) {
//         if (contraseniasValidas) {
//           if (checkRolValido) {
//             if (selectedRol === 'competidor') {
//               if (duValidado) {
//                 if (edadValidada) {
//                   if (generoValidado) {
//                     if (categoriaValidada) {
//                       if (graduacionValidada) {
//                         if (tipoGraduacion === 'elite') {
//                           if (galValidado) {
//                             formularioValido = true
//                           }
//                         } else {
//                           formularioValido = true
//                         }
//                       }
//                     }
//                   }
//                 }
//               }
//             } else {
//               formularioValido = true;
//             }
//           }
//         }
//       }
//     }
//   }
//   return formularioValido
// }
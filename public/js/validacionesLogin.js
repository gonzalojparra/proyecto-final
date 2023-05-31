//validacion del formulario login 

//acá recupero todos los input del formulario
const inputEmail = document.querySelector('#email')
const inputContrasenia= document.querySelector('#password')


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
  

//funcion que valida el input de email antes de ser enviado 
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
  

// funcion que valida el input de contraseña antes de ser enviado
  inputContrasenia.addEventListener('blur', function () {
    campoCompleto = validarCampo(inputContrasenia)
    if (campoCompleto) {
        contraseniaFeedback.innerHTML = ' &nbsp;'
       
    }else{
        contraseniaFeedback.style.color = 'red'
        contraseniaFeedback.innerHTML = 'Complete este campo'
    }
    
  })



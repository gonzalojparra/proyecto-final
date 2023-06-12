const modal = document.getElementById('myModal');
const openModalButton = document.getElementById('openModal');
const closeModalButton = document.getElementById('closeModal');
const confirmModalButton = document.getElementById('confirmModal');
const modalEscuela = document.getElementById('modalEscuela');
const actualizacionEscuelaButton = document.getElementById('actualizarEscuela');
const actualizarGraduacionButton = document.getElementById('actualizarGraduacion');
const confirmModalEscuelaButton = document.getElementById('confirmModalEscuela')
const closeModalEscuelaButton = document.getElementById('closeModalEscuela');
const modalGraduacion = document.getElementById('modalGraduacion');
const actualizacionGraduacionButton = document.getElementById('actualizarGraduacionBtn');
const confirmModalGraduacionButton = document.getElementById('confirmModalGraduacion');
const closeModalGraduacionButton = document.getElementById('closeModalGraduacion');

window.addEventListener('load', () =>{
    
})

openModalButton.addEventListener('click', () => {
    modal.classList.remove('hidden');
});

closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');
});

confirmModalButton.addEventListener('click', () => {
    // Realizar acciones al confirmar el modal, como enviar el formulario
    document.getElementById('inscripcion').submit();
});

actualizacionEscuelaButton.addEventListener('click', () => {
    modalEscuela.classList.remove('hidden');
    modal.classList.add('hidden');
})

closeModalEscuelaButton.addEventListener('click', () => {
    modalEscuela.classList.add('hidden');
});

confirmModalEscuelaButton.addEventListener('click', function(event) {
    event.preventDefault(); // Evitar el recargado de la página

    const nuevaEscuela = document.getElementById('escuela');
    // Obtener los valores de los campos
    var informacionActual = document.getElementById('actualEscuela').value;
    var informacionNueva = nuevaEscuela.options[nuevaEscuela.selectedIndex].value;

    // Crear objeto de datos
    var datos = {
        informacion_actual: informacionActual,
        informacion_nueva: informacionNueva
    };

    // Realizar la petición AJAX
    fetch('competidores/actualizar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(datos)
        })
        .then(function(response) {
            if (response.ok) {
                return response.json(); // Convertir la respuesta a JSON
            } else {
                throw new Error('Error en la petición');
            }
        })
        .then(function(data) {
            console.log('hecho');
        })
        .catch(function(error) {
            console.log(error);
        });
});



        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        if (btnDisabled) {
            btnDisabled.addEventListener('click', () => {

                mensajeSpan.classList.remove('hidden');
                setTimeout(function() {
                    // mensajeSpan.classList.add('hidden');
                    mensajeSpan.classList.add('hidden');
                }, 3000);
            })
        }

        actualizacionGraduacionButton.addEventListener('click', () => {
            modalGraduacion.classList.remove('hidden');
        })

        closeModalGraduacionButton.addEventListener('click', () => {
            modalGraduacion.classList.add('hidden');
        });

        actualizacionEscuelaButton.addEventListener('click', () => {
            modalEscuela.classList.remove('hidden');
        })

        closeModalEscuelaButton.addEventListener('click', () => {
            modalEscuela.classList.add('hidden');
        });



        confirmModalEscuelaButton.addEventListener('click', function(event) {
            // Obtener los valores de los campos
            const nuevaEscuela = document.getElementById('escuela');
            let selectedValue = nuevaEscuela.value;

            // Crear objeto de datos
            var datos = {
                informacion_nueva: selectedValue
            };

            console.log(datos);
            // Realizar la petición AJAX
            fetch('competidores/actualizar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(datos)
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json(); // Convertir la respuesta a JSON
                    } else {
                        throw new Error('Error en la petición');
                    }
                })
                .then(function(data) {
                    console.log('hecho');
                })
                .catch(function(error) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = error;
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);
                });
        });

        confirmModalGraduacionButton.addEventListener('click', function(event) {

            // Obtener los valores de los campos
            const nuevaGraduacion = document.getElementById('graduacionNueva');
            let selectedValue = nuevaGraduacion.value;

            // Crear objeto de datos
            var datos = {
                informacion_nueva: selectedValue
            };

            console.log(datos);
            // Realizar la petición AJAX
            fetch('competidores/actualizarGraduacion', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(datos)
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.json(); // Convertir la respuesta a JSON
                    } else {
                        throw new Error('Error en la petición');
                    }
                })
                .then(function(data) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = 'Pedido de actualizacion exitoso';

                    setTimeout(function() {
                        modalEscuela.classList.add('hidden');
                    }, 5000);
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);

                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .catch(function(error) {
                    mensajes.classList.remove('hidden');
                    mensajes.textContent = error;
                    setTimeout(function() {
                        mensajes.classList.add('hidden');
                    }, 5000);
                });
        });

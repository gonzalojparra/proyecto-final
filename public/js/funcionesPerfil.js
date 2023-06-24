window.addEventListener("load", () => {
    accionTabs();
});

const accionTabs = () => {
    let tabs = document.getElementById('tabs')
    let lis = tabs.querySelectorAll('li');
    let evento;
    
    lis.forEach((li) => {
        li.addEventListener("click", (e) => {
            eliminarMarcador(tabs);
            e.target.classList.add('border-b-2');       
            switch (e.target.getAttribute('name')) {
                case '0':
                    evento = "verPerfil";
                    break;
                case '1':
                    console.log('hola');
                    evento = "verInscripcion";
                    break;
                case '2':
                    evento = "verCompetencias";
                    break;
                default:
                    evento = "verPerfil";
                    break;
            }
            Livewire.emit(evento);
        });
    });
};

const eliminarMarcador = (elemet) => {
    let clases = elemet.querySelectorAll('.border-b-2');
    clases.forEach(clase => {
        clase.classList.remove('border-b-2');
    })
}
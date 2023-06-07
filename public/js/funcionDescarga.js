window.addEventListener("load", function () {
    Livewire.on("mostrarArchivo", $tipo => {
        let tamanoPantalla = window.innerWidth;
        if (tamanoPantalla < 700) {
            Livewire.emit("descagaNomas", $tipo);
        } else {
            Livewire.emit("mostraNomas", $tipo);
        }
    });
});

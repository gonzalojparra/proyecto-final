window.addEventListener("load", () => {
    document
        .getElementById("botonHistorial")
        .addEventListener("click", function () {
            Livewire.emit("abrirHistorial");
        });
    document
        .getElementById("botonInscripciones")
        .addEventListener("click", function () {
            Livewire.emit("abrirInscripciones");
        });
});

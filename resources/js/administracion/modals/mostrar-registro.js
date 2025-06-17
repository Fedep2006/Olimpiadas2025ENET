setTimeout(function () {
    // Crear un objeto para almacenar las instancias de los modales
    const modales = {};

    // Iterar a través de los IDs del 0 al 9
    for (let id = 0; id <= 9; id++) {
        // Buscar el modal con el data-id-modal correspondiente
        const modalElement = document.querySelector(`[data-id-modal="${id}"]`);

        // Si el modal existe, crear la instancia
        if (modalElement) {
            modales[id] = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true,
            });

            // Buscar el botón correspondiente
            const buttonElement = document.querySelector(
                `[data-id-button="${id}"]`
            );

            // Si el botón existe, agregar el event listener
            if (buttonElement) {
                buttonElement.addEventListener("click", function (e) {
                    e.preventDefault();
                    modales[id].show();
                });
            }
        }
    }
}, 100);

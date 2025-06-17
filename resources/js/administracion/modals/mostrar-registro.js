setTimeout(function () {
    document.addEventListener("click", function (e) {
        // Verificar si el elemento clickeado tiene data-id-button
        if (e.target.matches("[data-id-button]")) {
            e.preventDefault();

            const id = e.target.getAttribute("data-id-button");
            const modalElement = document.querySelector(
                `[data-id-modal="${id}"]`
            );

            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement, {
                    backdrop: true,
                    keyboard: true,
                });
                modal.show();
            }
        }
    });
}, 100);

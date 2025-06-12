import { updateTable, showToast } from "../utils";

setTimeout(function () {
    const confirmarEliminacionModal = new bootstrap.Modal(
        document.getElementById("confirmarEliminacionModal"),
        {
            backdrop: true,
            keyboard: true,
        }
    );

    // Handle delete button click
    let registroId = null;
    document.addEventListener("click", function (e) {
        const deleteBtn = e.target.closest(".action-btn.delete");
        if (deleteBtn) {
            confirmarEliminacionModal.show();
            registroId = deleteBtn.dataset.registroId;
        }
    });

    // Handle delete confirmation
    document
        .getElementById("confirmarEliminacion")
        .addEventListener("click", async function () {
            if (!registroId) return;

            try {
                const token = document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute("content");
                if (!token) throw new Error("Token CSRF no encontrado");

                const response = await fetch(`/usuarios/${registroId}`, {
                    method: "DELETE",
                    headers: {
                        Accept: "application/json",
                        "X-CSRF-TOKEN": token,
                        "X-Requested-With": "XMLHttpRequest",
                    },
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(
                        result.message || "Error al eliminar el usuario"
                    );
                }

                showToast(result.message);
                confirmarEliminacionModal.hide();

                // Refresh the user list
                const currentUrl = new URL(window.location.href);
                const searchParams = new URLSearchParams(currentUrl.search);

                fetch(`/usuarios?${searchParams.toString()}`, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        updateTable(data);
                    })
                    .catch((error) => {
                        console.error("Error al actualizar la lista:", error);
                        showToast(
                            "Error al actualizar la lista de usuarios",
                            "error"
                        );
                    });
            } catch (error) {
                console.error("Error completo:", error);
                showToast(
                    error.message || "Error al procesar la solicitud",
                    "error"
                );
            }
        });
}, 100);

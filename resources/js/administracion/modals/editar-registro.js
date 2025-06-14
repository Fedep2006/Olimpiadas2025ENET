import { updateTable, showToast } from "../utils";

setTimeout(function () {
    // Initialize modals
    const editarRegistroModal = new bootstrap.Modal(
        document.getElementById("editarRegistroModal"),
        {
            backdrop: true,
            keyboard: true,
        }
    );

    const pathname = window.location.pathname;

    // Handle edit button click
    document.addEventListener("click", function (e) {
        const editBtn = e.target.closest(".action-btn.edit");
        if (editBtn) {
            // Si el dataset es un string JSON, parsea:
            let registro = editBtn.dataset.registro;
            if (typeof registro === "string") {
                try {
                    registro = JSON.parse(registro);
                } catch (e) {
                    console.error("Error al parsear registro:", e);
                    return;
                }
            }
            Object.keys(registro)
                .sort()
                .forEach((key) => {
                    const input = document.getElementById(
                        "edit" + key.charAt(0).toUpperCase() + key.slice(1)
                    );
                    if (input) {
                        input.value = registro[key];
                    }
                });

            editarRegistroModal.show();
        }
    });

    // Handle update user
    document
        .getElementById("actualizarRegistro")
        .addEventListener("click", async function () {
            const form = document.getElementById("editarRegistroForm");
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                const registroId = data.registro_id;
                console.log(data);

                try {
                    const token = document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content");
                    if (!token) throw new Error("Token CSRF no encontrado");

                    const response = await fetch(pathname + `/${registroId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-CSRF-TOKEN": token,
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        body: JSON.stringify(data),
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        if (response.status === 422) {
                            const errors = result.errors;
                            const errorMessages = Object.values(errors).flat();
                            showToast(errorMessages.join("<br>"), "error");
                        } else {
                            throw new Error(
                                result.message ||
                                    "Error en la respuesta del servidor"
                            );
                        }
                        return;
                    }

                    showToast(result.message);
                    editarRegistroModal.hide();

                    fetch(pathname, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            updateTable(data);
                        })
                        .catch((error) => {
                            console.error(
                                "Error al actualizar la lista:",
                                error
                            );
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
            } else {
                form.reportValidity();
            }
        });
}, 100);

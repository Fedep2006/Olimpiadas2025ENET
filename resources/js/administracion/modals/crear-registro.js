import { updateTable, showToast } from "../utils";
import {
    initDynamicInputs,
    addDynamicInputs,
    removeInputGroup,
    clearDynamicInputs,
} from "./crear-inputs.js";

setTimeout(function () {
    const nuevoRegistroModal = new bootstrap.Modal(
        document.getElementById("nuevoRegistroModal"),
        {
            backdrop: true,
            keyboard: true,
        }
    );

    const pathname = window.location.pathname;
    document
        .querySelector(".btn-admin.orange")
        .addEventListener("click", function (e) {
            e.preventDefault();
            nuevoRegistroModal.show();
            initDynamicInputs({
                addButtonId: "addInputsBtn",
                modalId: "nuevoRegistroModal",
            });
        });
    document
        .getElementById("guardarRegistro")
        .addEventListener("click", async function () {
            const form = document.getElementById("nuevoRegistroForm");
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                try {
                    const token = document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content");

                    if (!token) {
                        throw new Error("Token CSRF no encontrado");
                    }
                    console.log(pathname);
                    const response = await fetch(pathname + "/create", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-CSRF-TOKEN": token,
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        credentials: "same-origin",
                        body: JSON.stringify(data),
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        console.log("error");
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
                    nuevoRegistroModal.hide();
                    form.reset();

                    const searchParams = new URLSearchParams(
                        window.location.search
                    );

                    fetch(pathname + `?${searchParams}`, {
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
                            showToast("Error al actualizar la lista", "error");
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

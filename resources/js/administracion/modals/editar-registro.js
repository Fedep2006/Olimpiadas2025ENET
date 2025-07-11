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

    document.addEventListener("click", function (e) {
        const editBtn = e.target.closest(".action-btn.edit");
        if (editBtn) {
            function esFechaValida(texto) {
                return texto && !isNaN(Date.parse(texto));
            }

            // Función para aplanar objetos anidados
            function aplanarObjeto(obj, prefijo = "") {
                let resultado = {};

                for (let key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        const valor = obj[key];
                        const nuevaKey = prefijo ? `${prefijo}_${key}` : key;

                        // Si el valor es un objeto (pero no null, array o Date)
                        if (
                            valor &&
                            typeof valor === "object" &&
                            !Array.isArray(valor) &&
                            !(valor instanceof Date)
                        ) {
                            // Recursivamente aplanar el objeto anidado
                            Object.assign(
                                resultado,
                                aplanarObjeto(valor, nuevaKey)
                            );
                        } else {
                            // Agregar el valor directamente
                            resultado[nuevaKey] = valor;
                        }
                    }
                }

                return resultado;
            }

            // Función para convertir snake_case a camelCase para IDs
            function toCamelCase(str) {
                return str.replace(/_([a-z])/g, function (match, letter) {
                    return letter.toUpperCase();
                });
            }

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

            console.log("Registro original:", registro);

            // Aplanar el objeto para manejar propiedades anidadas
            const registroAplanado = aplanarObjeto(registro);
            console.log("Registro aplanado:", registroAplanado);

            Object.keys(registroAplanado)
                .sort()
                .forEach((key) => {
                    // Convertir la key a camelCase para el ID del input
                    const keyForId = toCamelCase(key);
                    const input = document.getElementById(
                        "edit" +
                            keyForId.charAt(0).toUpperCase() +
                            keyForId.slice(1)
                    );

                    // Validar que el input existe
                    if (!input) {
                        return; // Salta a la siguiente iteración
                    }

                    console.log(
                        `Procesando ${key} -> ID: edit${
                            keyForId.charAt(0).toUpperCase() + keyForId.slice(1)
                        }:`,
                        registroAplanado[key]
                    );

                    switch (input.type) {
                        case "date":
                            if (esFechaValida(registroAplanado[key])) {
                                let fecha = new Date(registroAplanado[key]);
                                input.value = fecha.toISOString().split("T")[0];
                            }
                            break;
                        case "datetime-local":
                            if (esFechaValida(registroAplanado[key])) {
                                let fechaLocal = new Date(
                                    registroAplanado[key]
                                );
                                input.value = fechaLocal
                                    .toISOString()
                                    .slice(0, 16);
                            }
                            break;
                        case "number":
                            input.value = parseInt(registroAplanado[key]) || "";
                            break;
                        case "checkbox":
                            input.value = 1;
                            if (input.value == registroAplanado[key]) {
                                input.checked = true;
                            } else {
                                input.checked = false;
                            }
                            break;
                        default:
                            input.value = registroAplanado[key] || "";
                            break;
                    }
                });

            editarRegistroModal.show();
        }
    });

    document
        .getElementById("actualizarRegistro")
        .addEventListener("click", async function () {
            const form = document.getElementById("editarRegistroForm");
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                const { registro_id: registroId, ...dataReady } = data;

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
                        body: JSON.stringify(dataReady),
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

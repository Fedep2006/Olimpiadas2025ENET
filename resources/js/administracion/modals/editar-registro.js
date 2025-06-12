import { showToast, updateTable } from "./modals.js";

setTimeout(function () {
    // Initialize modals
    const editarRegistroModal = new bootstrap.Modal(
        document.getElementById("editarRegistroModal"),
        {
            backdrop: true,
            keyboard: true,
        }
    );

    // Function to show toast notification
    function showToast(message, type = "success") {
        const toastContainer = document.querySelector(".toast-container");
        const toast = document.createElement("div");
        toast.className = `toast ${type} show`;
        toast.innerHTML = `
                        <div class="toast-header">
                            <strong class="me-auto">${
                                type === "success" ? "Éxito" : "Error"
                            }</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    `;
        toastContainer.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    function updateTable(data) {
        document.getElementById("usersTableBody").innerHTML = data.view;
        document.querySelector(".pagination-container").innerHTML =
            data.pagination;
        document.querySelector(".pagination-info").innerHTML =
            data.paginationInfo;
    }

    // Handle edit button click
    document.addEventListener("click", function (e) {
        const editBtn = e.target.closest(".action-btn.edit");
        if (editBtn) {
            const registroId = editBtn.dataset.registroId;
            const registroRow = editBtn.closest("tr");
            const registroName =
                registroRow.querySelector(".user-info h6").textContent;
            const registroEmail =
                registroRow.querySelector("td:nth-child(2)").textContent;

            document.getElementById("editRegistroId").value = registroId;
            document.getElementById("editName").value = registroName;
            document.getElementById("editEmail").value = registroEmail;

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

                try {
                    const token = document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content");
                    if (!token) throw new Error("Token CSRF no encontrado");

                    const response = await fetch(`/usuarios/${registroId}`, {
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

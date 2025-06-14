// Function to show toast notification
export function showToast(message, type = "success") {
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

// Function to update the table with new data
export function updateTable(data) {
    document.getElementById("tBody").innerHTML = data.view;
    document.querySelector(".pagination-container").innerHTML = data.pagination;
    document.querySelector(".pagination-info").innerHTML = data.paginationInfo;
}

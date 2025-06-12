import { updateTable, showToast } from "./utils";

setTimeout(function () {
    // Handle pagination clicks
    document.addEventListener("click", function (e) {
        const paginationLink = e.target.closest(".pagination a");
        if (paginationLink) {
            e.preventDefault();
            e.stopPropagation();

            const url = paginationLink.href;

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    updateTable(data);
                    window.history.pushState({}, "", url);
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showToast("Error al cargar la página", "error");
                });
        }
    });
}, 100);
